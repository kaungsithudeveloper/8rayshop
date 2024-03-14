<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('backend/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>My DashBoard </title>

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

    <!-- View Message CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    @stack('styles')

</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    @include('backend.layout.apploader')
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('backend.layout.appheader')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            @include('backend.layout.appsidebar')

            <!--app-content open-->
            @yield('content')
            <!--app-content close-->

        </div>

        <!-- Sidebar-right -->
        @include('backend.layout.apprsidebar')
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->
        @include('backend.layout.appmodal')
        <!-- Country-selector modal-->

        <!-- FOOTER -->
        @include('backend.layout.appfooter')
        <!-- FOOTER END -->

    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="{{ url('backend/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ url('backend/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('backend/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Sticky js -->
    <script src="{{ url('backend/js/sticky.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ url('backend/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('backend/plugins/p-scroll/pscroll.js') }}"></script>
    
    <!-- SIDEBAR JS -->
    <script src="{{ url('backend/plugins/sidebar/sidebar.js') }}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{ url('backend/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ url('backend/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ url('backend/js/custom.js') }}"></script>

    <!-- Validate JS -->
    <script src="{{ url('backend/js/validate.min.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
        }
    @endif
    </script>

    @stack('scripts')
    
</body>

</html>