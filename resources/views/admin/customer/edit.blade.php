@extends('admin.layouts.app')

@section('content')
    {{-- script start --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- script end --}}
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Cutomer</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Cutomer</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Cutomer</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-customer', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-column">

                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Your Name" required value="{{ $data->name }}">
                            </div>

                            <div class="form-group">
                                <label for="customer_mb">Customer Mobile</label>
                                <input type="number" class="form-control" id="customer_mb" name="customer_mb"
                                    placeholder="Enter Your mobile number" required value="{{ $data->mobile_no }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Customer Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Your Email" required value="{{ $data->email }}">
                            </div>


                            <div class="form-group">
                                <label for="address">Customer Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Your Address" required value="{{ $data->address }}">
                            </div>

                            <div class="form-group">
                                <label for="address">Customer Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="form-group">
                                <label for="address"></label>
                                <img id="show_image" src="{{ $data->image != null ? asset($data->image) : asset('uploads/No-Image-Placeholder.svg.png') }}"
                                    alt="" width="110" style="border-radius: 20px">
                            </div>

                            <button class="btn ripple btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- Col End-->
    </div>

    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0'])
                })
            })
        </script>
    @endpush
@endsection
