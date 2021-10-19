<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MKU FOOD</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/upload/logo_mku_shortcut_icon.svg') }}" />
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/nice-select.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/sweet.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/main-color03-green.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom_account/event_hover_account.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_sidebar_content.css') }}">
</head>

<body class="biolife-body">

    <header id="header" class="header-area style-01 layout-03">
        {{-- HEADER TOP --}}
        @include('client.layout.header_top.header_top')
    </header>
    @yield('header_content')
    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            @yield('content_body')

        </div>
    </div>


    <!-- FOOTER -->
    @include('client.layout.footer.footer')


    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/jquery.countdown.min.js') }}"></script>
    {{-- <script src="{{ asset('public/font_end/assets/js/jquery.nice-select.min.js') }}"></script> --}}
    <script src="{{ asset('public/font_end/assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/biolife.framework.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/functions.js') }}"></script>
    <script src="{{ asset('public/font_end/custom/sweet.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('public/font_end/custom/custom.js') }}"></script>
    <script src="{{ asset('public/font_end/custom/update_cart_ajax.js') }}"></script>
    <script src="{{ asset('public/font_end/custom/ajax_address_customer.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/upperFirstKey.js') }}"></script>
    <script src="{{ asset('public/back_end/src/scripts/checkName.js') }}"></script>

</body>

</html>
