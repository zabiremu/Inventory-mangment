@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Supplier</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Suppliers</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Suppliers</h3>
                    <div class="ms-auto">
                        <a href="{{ route('print-supplier-data') }}" class="btn btn-pill btn-primary">Print Supplier Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">SL</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-20p border-bottom-0">Mobile Number</th>
                                    <th class="wd-15p border-bottom-0">Email</th>
                                    <th class="wd-10p border-bottom-0">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Supplier as $key => $Supplier)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $Supplier->name }}</td>
                                        <td>{{ $Supplier->mobile_no }}</td>
                                        <td>{{ $Supplier->email }}</td>
                                        <td>{{ $Supplier->address }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
