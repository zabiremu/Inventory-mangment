@extends('admin.layouts.app')

@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">All Product</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Apps</li>
                <li class="breadcrumb-item"><a href="{{ route('all.invoice') }}">All Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Stock</li>
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
                            <h3 class="card-title mb-0">Ostin Shopping Mall</h3>
                        </div>
                        <br>
                        <div class="float-start mt-3">
                            <h6 class="">Start Date: {{ date('D-m-Y') }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover mb-0 text-nowrap border-bottom">
                            <tbody>
                                <tr class=" ">
                                    <th class="wd-15p border-bottom-0">SL</th>
                                    <th class="wd-10p border-bottom-0">Product Name</th>
                                    <th class="wd-15p border-bottom-0">Supplier Name</th>
                                    <th class="wd-20p border-bottom-0">Unit Name</th>
                                    <th class="wd-15p border-bottom-0">Category Name</th>
                                    <th class="wd-25p border-bottom-0">Stock</th>
                                </tr>
                                    @foreach ($product as $key => $data)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td>
                                            {{ $data->name }}
                                        </td>
                                        <td>
                                            {{ $data->supplier->name }}
                                        </td>
                                        <td class="text-center">{{ $data->unit->name }}</td>
                                        <td class="text-end">{{ $data->category->name }}</td>
                                        <td class="text-end">{{ $data->quantity  }}</td>
                                    @endforeach
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
