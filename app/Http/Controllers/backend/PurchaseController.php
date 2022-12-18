<?php

namespace App\Http\Controllers\backend;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function allPurchase()
    {
        $data = Purchase::with('product','supplier','unit','category')->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.purchases.view', compact('data'));
    }
    public function addPurchase()
    {
        $supplier = Supplier::latest()->get();
        $unit = Unit::latest()->get();
        $category = Category::latest()->get();
        $products = Product::latest()->get();
        return view('admin.purchases.addPurchase', compact('supplier', 'unit', 'category', 'products'));
    }

    public function addSupplier(Request $request, $id)
    {
        $product = Product::with('category')
            ->select('category_id')
            ->where('supplier_id', $id)
            ->groupBy('category_id')
            ->get();
        if (count($product) > 0) {
            return response()->json($product);
        } else {
            return response()->json([
                'noCategory' => 'No Category',
            ]);
        }
    }

    public function addProduct(Request $request, $id)
    {
        $supplier = $request->supplier;
        $product = Product::where('category_id', $id)
            ->where('supplier_id', $supplier)
            ->select('id', 'name')
            ->get();
        if (count($product) > 0) {
            return response()->json($product);
        } else {
            return response()->json([
                'noProduct' => 'No Product',
            ]);
        }
    }

    public function pruchaseProduct(Request $request)
    {
        $category_id = $request->Category;

        // dd($request->all());
        if ($category_id != null) {
            $cat = count($request->Category);
            for($i = 0; $i < $cat; $i++){
                $data = new Purchase();
                $data->supplier_id = $request->supplier[$i];
                $data->date = date('Y-m-d', strtotime($request->date[$i]));
                $data->category_id = $request->Category[$i];
                $data->product_id = $request->product[$i];
                $data->purchase_no = $request->purchase_no[$i];
                $data->unit_price = $request->unit_price[$i];
                $data->buying_qty = $request->buying_qty[$i];
                $data->description = $request->description[$i];
                $data->buying_price = $request->buying_price[$i];
                $data->created_by = Auth::user()->id;
                $data->status = '0';
                $data->save();
            }
            $notification = [
                'message' => 'Successfully Purchase Product',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('all.purchase')
                ->with($notification);
        }else {
            $notification = [
                'message' => 'Please select Category',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('add.Purchase')
                ->with($notification);
        }
    }

    public function deletePruchase($id)
    {
        $delete = Purchase::find($id);
        $delete->delete();
        $notification = [
            'message' => 'Successfully Delete Purchase Product',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('all.purchase')
            ->with($notification);
    }

    public function approvePurchase()
    {
        $data = Purchase::with('product','supplier','unit','category')->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.purchases.approve', compact('data'));
    }

    public function approve($id)
    {
        $purchase = Purchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $qty = $purchase->buying_qty + $product->quantity;
        $product->quantity = $qty;
        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => 1,
            ]);
            $notification = [
                'message' => 'Successfully Approved Product',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('all.purchase')
                ->with($notification);
        }
    }
}
