<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Noa – Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Noa – Bootstrap 5 Admin & Dashboard Template</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" />

</head>

<body class="ltr login-img">

    <!-- GLOABAL LOADER -->
    <div id="global-loader">
        <img src="{{ asset('backend/assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOABAL LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div>
            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto text-center">
                <a href="#" class="text-center">
                    <img src="{{ asset('backend/assets/images/brand/logo.png') }}"
                </a>
            </div>
            <div class="container-login100">
                <div class="wrap-login100 p-0">
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.email') }}" class="login100-form validate-form">
                            @csrf
                            <span>
                                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                            </span>
                            <x-auth-session-status class="text-success my-4" :status="session('status')" />
                            <div class="wrap-input100 validate-input mt-4">
                                <input class="input100" type="email" name="email" placeholder="Email" required
                                    autofocus>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                </span>
                                @error('email')
                                    <span class="text-danger mt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn btn-primary">
                                    Email Password Reset Link
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center my-3">
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->


    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('backend/assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>

    <!-- STICKY JS -->
    <script src="{{ asset('backend/assets/js/sticky.js') }}"></script>

    <!-- COLOR THEME JS -->
    <script src="{{ asset('backend/assets/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

</body>

</html>
