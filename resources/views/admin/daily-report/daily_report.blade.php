@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Daily Invocie Report</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daily Invocie Report</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('report') }}" method="post">
                    <div class="row">
                        @csrf
                        <div class="col-lg-4 ms-4 mt-4">
                            <div class="form-group">
                                <label class="card-title" for="date"> Start Date</label>
                                <input type="date" name="sDate" id="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4 ms-3 mt-4">
                            <div class="form-group">
                                <label class="card-title" for="eDate"> End Date</label>
                                <input type="date" name="eDate" id="eDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4 ms-4 mt-4">
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Row -->

    @push('script')
    @endpush
@endsection
