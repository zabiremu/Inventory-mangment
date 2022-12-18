@extends('admin.layouts.app')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Change Password</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-lg-8 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Update Password</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Please update your password</p>
                    <form action="{{ route('update.admin.password',$userData->id) }}" method="post">
                        @csrf
                        <div class="d-flex flex-column">

                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Your Current Password" type="password"
                                    required="" name="current_password" autocomplete="current-password">
                                @error('current_password')
                                    <span class="text-danger my-3">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Your New Password" type="password" required=""
                                    name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="text-danger my-3">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Your Confirm Password" type="password"
                                    required="" name="password_confirmation" autocomplete="new-password">
                                @error('password_confirmation')
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
