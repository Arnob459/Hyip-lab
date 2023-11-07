<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from pixner.net/hyipland/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2023 12:09:15 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $gnl->site_name }} - {{$page_title?? ''}}</title>

    <link rel="stylesheet" href="{{ asset('assets/frontend/bootstrap5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/fontawesome-5.15.4/css/all.min.css') }}">
    <script src="{{ asset('assets/admin/extensions/jquery/jquery.min.js') }}"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="shortcut icon" href="{{asset('assets/images/logo/'. $gnl->favicon )}}" type="image/x-icon">
</head>

<body>
    <div class="main--body">
        <!--========== Preloader ==========-->
        <div class="loader">
            <div class="loader-inner">
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
            </div>
        </div>
        <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
        <div class="overlay"></div>
        <!--========== Preloader ==========-->


        @yield('content')

        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/modernizr-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
        {{-- <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script> --}}
        <script src="{{ asset('assets/frontend/bootstrap5/js/bootstrap.min.js') }}"></script>

        <script src="{{ asset('assets/frontend/js/magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/odometer.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/viewport.jquery.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/nice-select.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/owl.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/paroller.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/chart.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/circle-progress.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
</body>


<!-- Mirrored from pixner.net/hyipland/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2023 12:10:42 GMT -->
</html>
