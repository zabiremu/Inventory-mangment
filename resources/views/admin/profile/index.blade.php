@extends('admin.layouts.app')

@section('content')
    {{-- script start --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- script end --}}
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Profile</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="row">

        <div class="col-md-12 col-xl-4">
            <div class="card pb-4">
                <div class="card-header ">
                    <h3 class="card-title ">Admin Profile</h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-bs-toggle="card-collapse"><i
                                class="fe fe-chevron-up"></i></a>
                    </div>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $userData->image != null ? asset($userData->image) : asset('uploads/No-Image-Placeholder.svg.png') }}" alt="" width="110" style="border-radius: 20px;">
                    <h4 class="h4 mb-0 mt-3">{{ $userData->name }}</h4>
                </div>

            </div>
        </div><!-- COL END -->

        <div class="col-lg-8 col-md-">
            <div class="card custom-card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Update Information</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Please update your profile Information</p>
                    <form action="{{ route('profile.store', $userData->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter your username" type="text"
                                    value="{{ $userData->userName }}" name="userName">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter your name" type="text"
                                    value="{{ $userData->name }}" required="" name="name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Your Email" type="email"
                                    value="{{ $userData->email }}" required="" name="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <img id="show_image"
                                    src="{{ $userData->image != null ? url($userData->image) : asset('uploads/No-Image-Placeholder.svg.png') }}"
                                    alt="" width="110" style="border-radius: 50%">

                            </div>
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" required=""><span class="text-13">I agree terms and
                                        conditions</span>
                                </label>
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
