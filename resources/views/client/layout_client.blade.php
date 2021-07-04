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
    <link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/icon-font.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/main-color.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/font_end/assets/css/main-color03-green.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/font_end/custom_account/event_hover_account.css') }}">
    {{--  --}}
    <link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_sidebar_content.css') }}">
    {{--  --}}
    {{-- checkout custom
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/checkout_custom.css') }}"> --}}
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

    {{-- Modal delete cart --}}
    <div class="modal fade" id="delete_cart_item">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thông Báo</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Bạn muốn xóa sản phẩm này ra khỏi giỏ hàng
                    <form action="{{ URL::to('remove_item_cart') }}" method="post" name="form_delete_item_cart">
                        @csrf
                        <input type="hidden" name="cart_id" class="delete_item_cart">
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success btn_confirm_delete_item_cart">Xóa</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="add_address_account">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm Địa chỉ</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ URL::to('process_add_address') }}" method="post" name="add_transport">
                        @csrf
                        <label>Họ Và Tên</label>
                        <input class="form-control upper_val" type="text" name="trans_fullname"
                            value="{{ old('trans_fullname') }}" onblur="return upberFirstKey()"
                            placeholder="Nhập Họ Và Tên">
                        <label>Số Điện Thoại</label>
                        <input class="form-control upper_val" type="text" name="trans_phone"
                        value="{{ old('trans_phone') }}" onblur="return upberFirstKey()"
                        placeholder="Nhập Số Điện Thoại">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success btn_add_address">Thêm</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="update_address_account">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sửa Địa Chỉ</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ URL::to('process_update_address') }}" method="post" name="update_transport">
                        @csrf
                       <label>Họ Và Tên</label>
                       <input type="hidden" class="form-control trans_id" name="trans_id">
                        <input class="form-control upper_val fullname_address_update" type="text" name="trans_fullname"
                        onblur="return upberFirstKey()" value=""
                        placeholder="Nhập Họ Và Tên">

                        <label>Số Điện Thoại</label>
                        <input class="form-control upper_val phone_address_update" type="text" name="trans_phone"
                         onblur="return upberFirstKey()" value=""
                        placeholder="Nhập Số Điện Thoại">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success btn_update_address">Sửa</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL DELETE ADDRESS --}}
    <div class="modal fade" id="delete_address_account">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thông Báo</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Bạn có thực sự muốn xóa địa chỉ này không?
                    <form action="{{ URL::to('process_delete_address') }}" method="post" name="form_delete_address">
                        @csrf
                        <input type="hidden" name="trans_id" class="delete_address">
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success btn_delete_address">Xóa</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



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
    <script src="{{ asset('public/font_end/custom_account/custom.js') }}"></script>
    {{-- check out custom
    <script src="{{ asset('public/font_end/custom/checkout_custom.js') }}"></script> --}}


    {{--  --}}
    <script src="{{ asset('public/back_end/src/scripts/upload_image.js') }}"></script>
</body>

</html>
