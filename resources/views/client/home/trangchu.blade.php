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
                        @foreach ($all_product as $product)
                            <li class="product-item">
                                <div class="contain-product layout-default">
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
                                            @foreach ($all_category as $cate)
                                                @if ($cate->cate_id == $product->category_id)
                                                    {{ $cate->cate_name }}
                                                @endif
                                            @endforeach
                                        </b>
                                        <h4 class="product-title"><a
                                                href="{{ URL::to('product_detail/' . $product->product_id) }}"
                                                class="">{{ $product->product_name }}</a></h4>
                                        <div class="price ">
                                            <ins>
                                                <span class="price-amount"><span class="currencySymbol">
                                                        @foreach ($all_price as $price)
                                                            @if ($price->product_id == $product->product_id)
                                                                {{ number_format($price->price, 0, ',', '.') }}
                                                                <sub>vnđ</sub>
                                                            @endif
                                                        @endforeach
                                                    </span>
                                            </ins>
                                            {{-- <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del> --}}
                                        </div>
                                        <div class="slide-down-box">
                                            <p class="message">
                                                @foreach ($product_storage as $prod_qty)
                                                    @if ($prod_qty->product_id == $product->product_id)
                                                        Kho: {{ $prod_qty->total_quantity_product }}
                                                    @endif
                                                @endforeach
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
                {{-- <div class="content-image">
                    <img src="{{ asset('public/upload/8up-10240.jpg') }}" alt="" style="width: 361px; height: 361px;">
                </div>
                <div class="content_info_product">
                    <h4 class="title">
                        <div class="product_id"></div>


                        <a href="#" class="pr-name name_product">National Fresh Fruit</a>
                    </h4>
                    <div class="price price-contain">
                        <ins><span class="price-amount"><span class="currencySymbol price_prod">£</span>85.00</span></ins>
                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                    </div>
                    <p class="excerpt sort_desc_product">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel maximus lacus. Duis ut mauris eget justo dictum tempus sed vel tellus.</p>
                    <div class="from-cart">
                        <div class="qty-input">
                            <input class="qty_prod" type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                            <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up up" aria-hidden="true"></i></a>
                            <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down down" aria-hidden="true"></i></a>
                        </div>
                        <div class="buttons">
                            <a href="#" class="btn add-to-cart-btn btn-bold btn_add_cart">add to cart</a>
                        </div>
                    </div>
                    <div class="product-meta">
                        <div class="product-atts">
                            <div class="product-atts-item show_category">
                                <b class="meta-title">Danh mục sản phẩm:</b>
                                <label for="">hehe</label>
                            </div>
                            <div class="show_qty_storage">
                                <b class="meta-title">Trong Kho:</b>
                                <label for="">hehe</label>
                            </div>
                        </div>
                        <div class="biolife-social inline add-title">
                            <span class="fr-title">Chia sẻ:</span>
                            <ul class="socials">
                                <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/font_end/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/font_end/custom/mini_detail_product.js') }}"></script>
@endsection
