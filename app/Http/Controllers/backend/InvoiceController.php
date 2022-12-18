<?php

namespace App\Http\Controllers\backend;

use App\Models\Unit;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function allInvoice()
    {
        $allData = Invoice::with('customer', 'payment')
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->where('status', '1')
            ->get();

        return view('admin.invoice.view', compact('allData'));
    }
    public function addInvoice()
    {
        $invoice = Invoice::orderBy('id', 'desc')->first();
        if ($invoice == null) {
            $reg = '0';
            $first = $reg + 1;
        } else {
            $invoice = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $first = $invoice + 1;
        }
        $category = Category::latest()->get();
        $customer = Customer::latest()->get();
        $date = date('Y-m-d');
        return view('admin.invoice.create', compact('first', 'category', 'date', 'customer'));
    }

    public function Invoice($id)
    {
        $product = Product::where('category_id', $id)
            ->select('id', 'name')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($product);
    }

    public function stock($id)
    {
        $productStock = Product::where('id', $id)
            ->select('quantity')
            ->first();
        return response()->json($productStock);
    }

    public function stoteInvoice(Request $request)
    {
        if ($request->category == null) {
            $notification = [
                'message' => 'Please select Category',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('add.invoice')
                ->with($notification);
        } elseif ($request->partial > $request->estimated_ammount) {
            $notification = [
                'message' => 'Paid Ammount is maximum the total price',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('add.invoice')
                ->with($notification);
        } else {
            $invoice = new Invoice();
            $invoice->invoice_no = $request->invoice_no;
            $invoice->customer_id = $request->customer_id;
            $invoice->date = date('Y-m-d', strtotime($request->date));
            $invoice->description = $request->description;
            $invoice->created_by = Auth::user()->id;
            $invoice->status = '0';

            DB::transaction(function () use ($request, $invoice) {
                if ($invoice->save()) {
                    $count = count($request->category);
                    for ($i = 0; $i < $count; $i++) {
                        $invoice_details = new InvoiceDetail();
                        $invoice_details->date = date('Y-m-d', strtotime($request->date));
                        $invoice_details->invoice_id = $invoice->id;
                        $invoice_details->category_id = $request->category[$i];
                        $invoice_details->product_id = $request->product_id[$i];
                        $invoice_details->selling_qty = $request->selling_qty[$i];
                        $invoice_details->unit_price = $request->unit_price[$i];
                        $invoice_details->selling_price = $request->selling_price[$i];
                        $invoice_details->status = '1';
                        $invoice_details->save();
                    }

                    if ($request->customer_id == '0') {
                        $customer = new Customer();
                        $customer->name = $request->name;
                        $customer->mobile_no = $request->mobile_no;
                        $customer->email = $request->email;
                        $customer->save();
                        $customer_id = $customer->id;
                    } else {
                        $customer_id = $request->customer_id;
                    }

                    $payment = new Payment();
                    $paymentDetails = new PaymentDetail();
                    $payment->invoice_id = $invoice->id;
                    $payment->customer_id = $customer_id;
                    $payment->paid_status = $request->paid_ammount;
                    $payment->discount_ammount = $request->Discount;
                    $payment->total_ammount = $request->estimated_ammount;
                    if ($request->paid_ammount == 'fullPaid') {
                        $payment->paid_ammount = $request->estimated_ammount;
                        $payment->due_ammount = 0;
                        $paymentDetails->customer_paid_ammount = $request->estimated_ammount;
                    } elseif ($request->paid_ammount == 'fullDue') {
                        $payment->paid_ammount = 0;
                        $payment->due_ammount = $request->estimated_ammount;
                        $paymentDetails->customer_paid_ammount = 0;
                    } elseif ($request->paid_ammount == 'partisalPaid') {
                        $payment->paid_ammount = $request->partial;
                        $payment->due_ammount = $request->estimated_ammount - $request->partial;
                        $paymentDetails->customer_paid_ammount = $request->partial;
                    }
                    $payment->save();
                    $paymentDetails->invoice_id = $invoice->id;
                    $paymentDetails->date = date('Y-m-d', strtotime($request->date));
                    $paymentDetails->save();
                }
            });

            $notification = [
                'message' => 'Invoice successfully added',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('all.invoice')
                ->with($notification);
        }
    }

    public function approveInvoice()
    {
        $allData = Invoice::with('customer', 'payment')
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->where('status', '0')
            ->get();
        return view('admin.invoice.approveInvoice', compact('allData'));
    }

    public function deleteInvoice($id)
    {
        $Invoice = Invoice::findOrFail($id);
        $invoice_details = InvoiceDetail::where('invoice_id', $id)->first();
        $Payment = Payment::where('invoice_id', $id)->first();
        $PaymentDetail = PaymentDetail::where('invoice_id', $id)->first();
        $Invoice->delete();
        $invoice_details->delete();
        $Payment->delete();
        $PaymentDetail->delete();
        $notification = [
            'message' => 'Invoice successfully deleted',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('approve.invoice')
            ->with($notification);
    }

    public function accpectInvoice($id)
    {
        $data = Invoice::findOrFail($id);
        $invoiceDetail = InvoiceDetail::with('category', 'product', 'invoice')
            ->where('invoice_id', $id)
            ->get();
        return view('admin.invoice.accpectInvoice', compact('data', 'invoiceDetail'));
    }

    public function done($id)
    {
        $invoice = InvoiceDetail::with('product')
            ->where('invoice_id', $id)
            ->first();
        if ($invoice->selling_qty > $invoice->product->quantity) {
            $notification = [
                'message' => 'Sorry you approve maximum value',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('approve.invoice')
                ->with($notification);
        } else {
            $InvoiceDetail = InvoiceDetail::with('product')
                ->where('invoice_id', $id)
                ->select('id', 'product_id', 'selling_qty')
                ->first();
            $product = Product::where('id', $InvoiceDetail->product_id)->first();
            $product->quantity - $InvoiceDetail->selling_qty;
            $product->save();
            $data = Invoice::find($id);
            $data->status = '1';
            $data->save();
            $notification = [
                'message' => 'Successfully Approved Invoice',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('approve.invoice')
                ->with($notification);
        }
    }

    public function print()
    {
        $allData = Invoice::with('customer', 'payment')
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->where('status', '1')
            ->get();
        return view('admin.invoice.Print', compact('allData'));
    }

    public function printdata($id)
    {
        $data = Invoice::findOrFail($id);
        $invoiceDetail = InvoiceDetail::with('category', 'product', 'invoice')
            ->where('invoice_id', $id)
            ->get();
        return view('admin.invoice.print_details', compact('data', 'invoiceDetail'));
    }

    public function dailyReport()
    {
        return view('admin.daily-report.daily_report');
    }

    public function report(Request $request)
    {
        $sDate = $request->sDate;
        $eDate = $request->eDate;
        $allData = InvoiceDetail::with('category', 'product', 'invoice')
            ->whereBetween('date', [$sDate, $eDate])
            ->where('status', '1')
            ->latest()
            ->get();
        return view('admin.daily-report.report-details', compact('allData','eDate','sDate'));
    }
}
