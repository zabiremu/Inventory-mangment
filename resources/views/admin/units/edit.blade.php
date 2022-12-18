@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Units</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Units</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Units</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-units', $data->id) }}" method="post">
                        @csrf
                        <div class="d-flex flex-column">

                            <div class="form-group">
                                <label for="name">Unit Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Your Unit Name" value="{{ $data->name }}" required>
                            </div>

                            <button class="btn ripple btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- Col End-->
    </div>
@endsection
