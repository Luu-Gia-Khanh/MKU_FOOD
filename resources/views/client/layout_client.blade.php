<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MKU FOOD</title>
    <link href="https://fonts.googleapis.com/css?family=Console:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/font_end/assets/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/sweet.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/main-color.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/main-color03-green.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/custom.css') }}">
</head>
<body class="biolife-body">
    <!-- Preloader -->
    {{-- @include('client.layout.header_middle.preload') --}}
    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">
        {{-- HEADER TOP --}}
        @include('client.layout.header_top.header_top')
        {{-- HEADER MIDDLE --}}
        <div class="header-middle biolife-sticky-object ">
            <div class="container">
                <div class="row">
                    {{-- LOGO --}}
                    <div class="col-lg-3 col-md-2 col-md-6 col-xs-6">
                        <a href="home-03-green.html" class="biolife-logo"><img src="assets/images/organic-3-green.png" alt="biolife logo" width="135" height="36"></a>
                    </div>
                    {{-- NAV PAGES --}}
                    @include('client.layout.header_middle.nav_pages')
                    <div class="col-lg-3 col-md-3 col-md-6 col-xs-6">
                        <div class="biolife-cart-info">
                            {{-- RESPONSIVE SEARCH MOBILE --}}
                            @include('client.layout.header_middle.search_responsive')
                            {{-- WISH LISH --}}
                            @include('client.layout.header_middle.wishlish')
                            {{-- MINI CART --}}
                            @include('client.layout.header_middle.mini_cart')
                            {{-- RESPONSIVE FOR MOBILE --}}
                            <div class="mobile-menu-toggle">
                                <a class="btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom hidden-sm hidden-xs">
            <div class="container">
                <div class="row">
                    {{--  NAV MENU  --}}
                    @include('client.layout.header_bottom.nav_menu')
                    <div class="col-lg-9 col-md-8 padding-top-2px">
                        {{-- SEARCH  --}}
                        @include('client.layout.header_bottom.search')
                        {{-- INFO PHONE --}}
                        @include('client.layout.header_bottom.info_phone')
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <!--Block 01: Main Slide-->
            @yield('slider_view_client')

            <!--Block 02: Banners-->
            @yield('banner_view_client')

            <!--Block 03: Product Tabs-->
           @yield('product_tap_view_client')

            <!--Block 04: Banner Promotion 01-->
            @yield('promotion_view_client')

            <!--Block 05: Banner promotion 02-->
            @yield('promotion2_view_client')

            <!--Block 06: Products-->
            @yield('top_rate_product_view_client')

            <!--Block 07: Brands-->
            @yield('brands_view_client')

            <!--Block 08: Blog Posts-->
            @yield('blog_view_client')

            @yield('content_body')

        </div>
    </div>

    <!-- FOOTER -->
    @include('client.layout.footer.footer')

    {{-- quickview --}}
    {{-- @include('client.layout.body.quickview_popup'); --}}

    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>


    <script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/biolife.framework.js') }}"></script>
    <script src="{{ asset('public/font_end/assets/js/functions.js') }}"></script>
    <script src="{{ asset('public/font_end/custom/sweet.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('public/font_end/custom/custom.js') }}"></script>
    <script src="{{ asset('public/font_end/custom/update_cart_ajax.js') }}"></script>
</body>

</html>
