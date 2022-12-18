<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function allStock()
    {
        $product = Product::latest()->get();
        return view('admin.stock.index',compact('product'));
    }

    public function printStock()
    {
        $product = Product::latest()->get();
        return view('admin.stock.printStock',compact('product'));
    }

    public function Supplier()
    {
        $Supplier = Supplier::latest()->get();
        return view('admin.supplier-wise-stock.index',compact('Supplier'));
    }

    public function suppilerStockProint()
    {
        $Supplier = Supplier::latest()->get();
        return view('admin.supplier-wise-stock.print',compact('Supplier'));
    }

    public function productWise()
    {
        $Product = Product::latest()->get();
        return view('admin.product-wise-stock.index',compact('Product'));
    }

    public function productWisePrint()
    {
        $Product = Product::latest()->get();
        return view('admin.product-wise-stock.print-product',compact('Product'));
    }

    public function purchaseStock()
    {
        $data = Purchase::with('product','supplier','unit','category')->latest()->get();
        return view('admin.purchase-wise-stock.index',compact('data'));
    }

    public function purchaseStockPrint()
    {
        $data = Purchase::with('product','supplier','unit','category')->latest()->get();
        return view('admin.purchase-wise-stock.purcahase',compact('data'));
    }

    public function customer()
    {
        $data = Customer::latest()->get();
        return view('admin.customer-wise-report.index',compact('data'));
    }

    public function printdata()
    {
        $data = Customer::latest()->get();
        return view('admin.customer-wise-report.print',compact('data'));
    }
}
