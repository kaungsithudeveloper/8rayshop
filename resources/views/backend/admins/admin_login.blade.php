<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="My Frame">
    <meta name="author" content="Kaung Si Thu">
    <meta name="keywords" content="my-frame">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('backend/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>My Dashboard – Admin Login</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ url('backend/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ url('backend/css/style.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ url('backend/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ url('backend/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('backend/colors/color1.css') }}" />

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ url('backend/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <!-- Logo -->
                    <div class="text-center">
                        <a href="index.html">
                            <img src="{{ url('backend/images/brand/logo-white.png') }}" class="header-brand-img" alt="">
                        </a>
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form method="POST" action="{{ url('login') }}" id="myForm" class="login100-form validate-form">
                            @csrf
                            <span class="login100-form-title pb-5">
                                Admin Login
                            </span>

                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(Session::has('error_message'))

                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </symbol>
                                </svg>

                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        {{ Session::get('error_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>

                            @endif 

                            <!-- End Error Messages -->

                            <div class="panel panel-primary">
                                <div class="panel-body tabs-menu-body p-0 pt-4">
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane active" >
                                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                                <input name="email" class="input100 border-start-1 form-control ms-0" type="email" placeholder="Email" required>
                                                <a href="" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <input name="password" class="input100 border-start-1 form-control ms-0" type="password" placeholder="Password" required>
                                                <a href="" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                            </div>

                                            <div class="text-center">
                                                <a href="#" class="text-primary ms-1">
                                                    Forgot Password?
                                                </a>
                                            </div>

                                            <div class="container-login100-form-btn">
                                                <button type="submit" class="login100-form-btn btn-primary"> 
                                                    Login 
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ url('backend/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ url('backend/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{ url('backend/js/show-password.min.js') }}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{ url('backend/js/generate-otp.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ url('backend/plugins/p-scroll/perfect-scrollbar.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ url('backend/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ url('backend/js/custom.js') }}"></script>

</body>

</html>