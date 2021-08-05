@extends('client.layout_client')
{{-- SLIDER --}}
@section('slider_view_client')
    @include('client.layout.body.slider')
@endsection
{{-- TAB SHOW PRODUCT --}}
@section('product_tap_view_client')
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/mini_detail_product.css') }}">
    <style>
        .btn:focus,
        .btn:active:focus,
        .btn.active:focus,
        .btn.focus,
        .btn:active.focus,
        .btn.active.focus {
            outline: none;
        }
    </style>
    <div class="product-tab z-index-20 sm-margin-top-193px xs-margin-top-30px">
        <div class="container">
            <div class="biolife-title-box">
                <span class="subtitle">All the best item for You</span>
                <h3 class="main-title">Danh sách sản phẩm</h3>
            </div>
            <div class="biolife-tab biolife-tab-contain sm-margin-top-34px">
                <div class="tab-head tab-head__icon-top-layout icon-top-layout">
                    {{-- <ul class="tabs md-margin-bottom-35-im xs-margin-bottom-40-im">
                    <li class="tab-element active">
                        <a href="#tab01_1st" class="tab-link"><span class="biolife-icon icon-lemon"></span>Oranges</a>
                    </li>
                    <li class="tab-element" >
                        <a href="#tab01_2nd" class="tab-link"><span class="biolife-icon icon-grape2"></span>Grapes</a>
                    </li>
                </ul> --}}
                </div>
                <div class="tab-content">
                    <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile eq-height-contain"
                        data-slick='{"rows":1 ,"arrows":true,"dots":false,"infinite":true,"speed":400,"slidesMargin":10,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":15}}]}'>
                        @foreach ($all_product_join as $product)
                            <li class="product-item">
                                <div class="contain-product layout-default" style="position: relative">
                                    <div class="product-thumb">
                                        <a href="{{ URL::to('product_detail/' . $product->product_id) }}"
                                            class="link-to-product" style="height: 270px; width: 270px">
                                            <img src="{{ asset('public/upload/' . $product->product_image) }}"
                                                style="height: 270px; width: 270px" alt="Vegetables" width="270"
                                                height="270" class="product-thumnail">
                                        </a>
                                        <span href="#" class="lookup get_val_quickview btn_call_quickview_detail btn_open_modal"
                                            data-id="{{ $product->product_id }}"><i
                                                class="biolife-icon icon-search"></i></a>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    </div>
                                    <div class="info">
                                        <b class="categories">
                                            {{ $product->cate_name }}
                                        </b>
                                        <h4 class="product-title"><a
                                                href="{{ URL::to('product_detail/' . $product->product_id) }}"
                                                class="">{{ $product->product_name }}</a>
                                        </h4>
                                        {{-- <div class="price ">
                                            @php
                                                $now = Carbon\Carbon::now();
                                            @endphp
                                            @if ($product->discount_id == null)
                                                <ins>
                                                    <span class="price-amount"><span class="currencySymbol">
                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                    </span>
                                                </ins>
                                            @else
                                                @foreach ($all_discount as $discount)
                                                    @if ($product->discount_id == $discount->discount_id)
                                                        @if ($discount->start_date_2 != "")
                                                            @if ($now >= $discount->start_date_2 && $now <= $discount->end_date_2)
                                                                @if ($discount->condition_discount_2 ==1)
                                                                    @php
                                                                        $price_discount = ($product->price * $discount->amount_discount_2) / 100;
                                                                        $price_now = $product->price - $price_discount;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $price_now = $product->price - $discount->amount_discount_2;
                                                                    @endphp
                                                                @endif
                                                                <ins>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($price_now, 0, ',', '.') }}đ
                                                                    </span>
                                                                </ins>
                                                                <del>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                                    </span>
                                                                </del>
                                                            @elseif($now >= $discount->start_date_1 && $now <= $discount->end_date_1)
                                                                @if ($discount->condition_discount_1 ==1)
                                                                    @php
                                                                        $price_discount = ($product->price * $discount->amount_discount_1) / 100;
                                                                        $price_now = $product->price - $price_discount;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $price_now = $product->price - $discount->amount_discount_1;
                                                                    @endphp
                                                                @endif
                                                                <ins>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($price_now, 0, ',', '.') }}đ
                                                                    </span>
                                                                </ins>
                                                                <del>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                                    </span>
                                                                </del>
                                                            @else
                                                                <ins>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                                    </span>
                                                                </ins>
                                                            @endif
                                                        @else
                                                            @if($now >= $discount->start_date_1 && $now <= $discount->end_date_1)
                                                                @if ($discount->condition_discount_1 ==1)
                                                                    @php
                                                                        $price_discount = ($product->price * $discount->amount_discount_1) / 100;
                                                                        $price_now = $product->price - $price_discount;
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $price_now = $product->price - $discount->amount_discount_1;
                                                                    @endphp
                                                                @endif
                                                                <ins>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($price_now, 0, ',', '.') }}đ
                                                                    </span>
                                                                </ins>
                                                                <del>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                                    </span>
                                                                </del>
                                                            @else
                                                                <ins>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                                    </span>
                                                                </ins>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div> --}}
                                        <div class="price ">
                                            @php
                                                $price_discount = App\Http\Controllers\HomeClientController::check_price_discount($product->product_id);
                                            @endphp
                                            @if ($price_discount->percent_discount == 0)
                                                <ins>
                                                    <span class="price-amount"><span class="currencySymbol">
                                                        {{ number_format($price_discount->price_now, 0, ',', '.') }}đ
                                                    </span>
                                                </ins>
                                            @else
                                                <ins>
                                                    <span class="price-amount"><span class="currencySymbol">
                                                        {{ number_format($price_discount->price_now, 0, ',', '.') }}₫
                                                    </span>
                                                </ins>
                                                <del>
                                                    <span class="price-amount"><span class="currencySymbol">
                                                        {{ number_format($price_discount->price_old, 0, ',', '.') }}₫
                                                    </span>
                                                </del>
                                            @endif
                                        </div>

                                        <div class="slide-down-box">
                                            <p class="message">
                                                {{ $product->total_quantity_product }} sản phẩm có sẵn
                                            </p>
                                            <div class="buttons">
                                                <a href="#" class="btn wishlist-btn"><i class="fa fa-heart"
                                                        aria-hidden="true"></i></a>
                                                @if (Session::get('customer_id'))
                                                    <button href="#"
                                                        class="btn add-to-cart-btn btn-block btn-sm add_cart_one"
                                                        data-id="{{ $product->product_id }}"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</button>
                                                @else
                                                    <a href="{{ URL::to('login_client') }}"
                                                        class="btn add-to-cart-btn btn-block btn-sm"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                @endif
                                                {{-- add cart --}}

                                                <input type="hidden" class="val_qty_{{ $product->product_id }}"
                                                    value="1">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                {{-- end add cart --}}
                                                <a href="#" class="btn compare-btn"><i class="fa fa-random"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($price_discount->percent_discount != 0)
                                        <div class="content_discount_product">
                                            <div class="content_sub_discount bg_discount">
                                                <div class="content_title_discount">
                                                    <span class="percent">{{ $price_discount->percent_discount }}%</span>
                                                    <span class="txt_giam">giảm</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal Add Address Trans -->
    <div class="modal_mini_detail modal">
        <!-- Modal content -->
        <div class="modal-content container">
            <div class="modal-header-mini_prod">
                <span class="close close_modal">&times;</span>
            </div>
            <div class="modal_body_mini_prod content_mini_detail">

            </div>
        </div>
    </div>

    <script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/font_end/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/font_end/custom/mini_detail_product.js') }}"></script>
@endsection
@section('content_body')
    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div id="main-content" class="main-content col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="block-item recently-products-cat md-margin-bottom-39">
                    <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":30}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}' >
                        @foreach ($all_product as $product)
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{ asset('public/upload/' . $product->product_image) }}"
                                                    style="height: 158px; width: 158px" alt="Vegetables" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">
                                                @foreach ($all_category as $cate)
                                                    @if ($cate->cate_id == $product->category_id)
                                                        {{ $cate->cate_name }}
                                                    @endif
                                                @endforeach
                                            </b>
                                            <h6 class="product-title" style="height: 50px; margin: 0 1px; font-size: 16px; line-height: 20px"><a href="#" class="pr-name">{{ $product->product_name }} like like like</a></h6>
                                            <div class="price">
                                                <del><span class="price-amount">95.00 vnđ</span></del><br>
                                                <ins><span class="price-amount">
                                                    @foreach ($all_price as $price)
                                                        @if ($price->product_id == $product->product_id)
                                                            {{ number_format($price->price, 0, ',', '.') }}
                                                            <sub>vnđ</sub>
                                                        @endif
                                                    @endforeach
                                                </span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
