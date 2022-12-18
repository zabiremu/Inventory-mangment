<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('supplier', 'unit', 'category')
            ->latest()
            ->get();
        return view('admin.product.view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::latest()->get();
        $Unit = Unit::latest()->get();
        $Category = Category::latest()->get();
        return view('admin.product.create', compact('supplier', 'Unit', 'Category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::insert([
            'name' => $request->name,
            'unit_id' => $request->Unit,
            'category_id' => $request->Category,
            'supplier_id' => $request->Supplier,
            'quantity' => '0',
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Successfully Product Uploaded',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('all.products')
            ->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $supplier = Supplier::latest()->get();
        $Unit = Unit::latest()->get();
        $Category = Category::latest()->get();
        return view('admin.product.edit', compact('supplier', 'Unit', 'Category','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Product::findOrFail($id)->update([
            'name' => $request->name,
            'unit_id' => $request->Unit,
            'category_id' => $request->Category,
            'supplier_id' => $request->Supplier,
            'quantity' => '0',
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Successfully Product Updated',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('all.products')
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => "Successfully Product deleted",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('all.products')
            ->with($notification);
    }
}
