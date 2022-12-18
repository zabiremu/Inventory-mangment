@extends('admin.layouts.app')

@section('content')
    @php
        $payment = App\Models\Payment::with('customer')
            ->where('invoice_id', $data->id)
            ->first();
    @endphp
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Invoice-Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Apps</li>
                <li class="breadcrumb-item"><a href="{{ route('all.invoice') }}">Invoices</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invoice Details</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start">
                            <h3 class="card-title mb-0">#{{ $data->invoice_no }}</h3>
                        </div>
                        <div class="float-end">
                            <h3 class="card-title">Date: {{ $data->date }}</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <p class="h3">Customer Info:</p>
                            <address>
                                Name: {{ $payment->customer->name }}<br>
                                Mobile No: {{ $payment->customer->mobile_no }}<br>
                                Email: {{ $payment->customer->email }}<br>
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover mb-0 text-nowrap border-bottom">
                            <tbody>
                                <tr class=" ">
                                    <th class="text-center">SL</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Current Stock </th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Sub Total</th>
                                </tr>
                                @php
                                    $sum = 0;
                                @endphp
                                    @foreach ($invoiceDetail as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td>
                                            {{ $data->category->name }}
                                        </td>
                                        <td>
                                            {{ $data->product->name }}
                                        </td>
                                        <td class="text-center">{{ $data->product->quantity }}</td>
                                        <td class="text-end">{{ $data->selling_qty }}</td>
                                        <td class="text-end">{{ $data->unit_price }}</td>
                                        <td class="text-end">{{ $data->selling_price }}</td>
                                        @php
                                            $sum += $data->selling_price;
                                        @endphp
                                </tr>
                                    @endforeach
                                <tr>
                                    <td colspan="6" class="fw-bold text-uppercase text-start">Total</td>
                                    <td class="fw-bold text-end h4">{{ $sum }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-info mb-1" onclick="javascript:window.print();"><i
                            class="si si-printer"></i> Print Invoice</button>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
