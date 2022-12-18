@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Supplier</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Supplier</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Supplier</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-supplier', $supplierData->id) }}" method="post">
                        @csrf
                        <div class="d-flex flex-column">

                            <div class="form-group">
                                <label for="name">Supplier Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Your Name" required  value="{{ $supplierData->name }}">
                                @error('name')
                                    <span class="text-danger my-3">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="supplier_mb">Supplier Mobile</label>
                                <input type="number" class="form-control" id="supplier_mb" name="supplier_mb"
                                    placeholder="Enter Your mobile number" required value="{{ $supplierData->mobile_no }}">
                                @error('supplier_mb')
                                    <span class="text-danger my-3">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Supplier Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Your Email" required value="{{ $supplierData->email }}">
                                @error('email')
                                    <span class="text-danger my-3">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="address">Supplier Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Your Address" required value="{{ $supplierData->address }}">
                                @error('address')
                                    <span class="text-danger my-3">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="btn ripple btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- Col End-->
    </div>
 @endsection
