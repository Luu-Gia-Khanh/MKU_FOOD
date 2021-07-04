@extends('client.layout_client')
@section('content_body')
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                <li class="nav-item"><a href="#" class="permal-link">Natural Organic</a></li>
                <li class="nav-item"><span class="current-page">Fresh Fruit</span></li>
            </ul>
        </nav>
    </div>
    <div class="page-contain shopping-cart">
        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">

                <!--Top banner-->
                {{-- <div class="top-banner background-top-banner-for-shopping min-height-346px">
                    <h3 class="title">Save $50!*</h3>
                    <p class="subtitle">Save $50 when you open an account online &amp; spen $50 on your first online
                        purchase to day</p>
                    <ul class="list">
                        <li>
                            <div class="price-less">
                                <span class="desc">Purchase amount</span>
                                <span class="cost">$0.00</span>
                            </div>
                        </li>
                        <li>
                            <div class="price-less">
                                <span class="desc">Credit on billing statement</span>
                                <span class="cost">$0.00</span>
                            </div>
                        </li>
                        <li>
                            <div class="price-less sum">
                                <span class="desc">Cost affter statemen credit</span>
                                <span class="cost">$0.00</span>
                            </div>
                        </li>
                    </ul>
                    <p class="btns">
                        <a href="#" class="btn">Open Account</a>
                        <a href="#" class="btn">Learn more</a>
                    </p>
                </div> --}}

                <!--Cart Table-->
                @if (count($all_cart) > 0 || count($old_date_cart) > 0)
                    <div class="shopping-cart-container">
                        <div class="row">
                            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                <h3 class="box-title"></h3>
                                <form class="shopping-cart-form form_checkbox_cart" action="{{ URL::to('checkout') }}" method="post" name="form_show_cart">
                                    @csrf
                                    <table class="shop_table cart-form">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="container-checkbox">
                                                        <input type="checkbox" class="check_all" checked>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th>
                                                <th class="product-name">Sản Phẩm</th>
                                                <th class="product-price">Giá</th>
                                                <th class="product-quantity">Số Lượng</th>
                                                <th class="product-subtotal">Thành Tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($all_cart as $cart)
                                                    <tr class="cart_item">
                                                        <td>
                                                            <label class="container-checkbox" style="margin-left: 10px">
                                                                <input type="checkbox" class="check_item_{{ $cart->cart_id }} item_check" name="itemCart[]" value="{{ $cart->cart_id }}" checked>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td class="product-thumbnail" data-title="Product Name">
                                                            @foreach ($all_product as $product)
                                                                @if ($product->product_id == $cart->product_id)
                                                                    <a class="prd-thumb" href="#">
                                                                        <figure><img style="height: 113px; width: 113px"
                                                                                src="{{ asset('public/upload/' . $product->product_image) }}"
                                                                                alt="shipping cart"></figure>
                                                                    </a>
                                                                    <a class="prd-name"
                                                                        href="#">{{ $product->product_name }}</a>
                                                                @endif
                                                            @endforeach

                                                            <div class="action">
                                                                {{-- href="{{ URL::to('remove_item_cart/'.$cart->cart_id) }} --}}
                                                                {{-- <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> --}}
                                                                <a class="remove delete_item_cart"
                                                                    data-id="{{ $cart->cart_id }}" data-toggle="modal"
                                                                    data-target="#delete_cart_item" style="cursor: pointer;"><i class="fa fa-trash-o"
                                                                        aria-hidden="true"></i> xóa</a>
                                                            </div>
                                                        </td>
                                                        <td class="product-price" data-title="Price">
                                                            <div class="price price-contain">
                                                                <ins>
                                                                    <span class="price-amount"><span class="currencySymbol">
                                                                            @php
                                                                                $price_product = 0;
                                                                            @endphp
                                                                            @foreach ($product_price as $price)
                                                                                @if ($cart->product_id == $price->product_id)
                                                                                    {{ number_format($price->price, 0, ',', '.') }}
                                                                                    @php
                                                                                        $price_product = $price->price;
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                        </span>vnđ</span>
                                                                </ins>
                                                                {{-- <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del> --}}
                                                            </div>
                                                        </td>
                                                        <td class="product-quantity" data-title="Quantity">
                                                            <div class="quantity-box type1">
                                                                <div class="qty-input">
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}" />
                                                                    <input type="hidden"
                                                                        class="val_price_update_cart_{{ $cart->cart_id }}"
                                                                        value="{{ $price_product }}">
                                                                    <input type="text"
                                                                        class="val_quantity_update_cart_{{ $cart->cart_id }} val_update_cart_change"
                                                                        data-id="{{ $cart->cart_id }}" name=""
                                                                        value="{{ $cart->quantity }}" data-max_value="20"
                                                                        data-min_value="1" data-step="1">{{ $cart->cart_id }}
                                                                    {{-- get max val product --}}
                                                                    @foreach ($product_storage as $sto_prod)
                                                                        @if($cart->product_id == $sto_prod->product_id)
                                                                            <input type="hidden" class="max_val_{{ $cart->cart_id }}" value="{{ $sto_prod->total_quantity_product }}">
                                                                        @endif
                                                                    @endforeach
                                                                    {{-- end get max val product --}}
                                                                    <a href="#" class="qty-btn btn-up btn_up_update_cart btn_up_update_cart_{{ $cart->cart_id }}"
                                                                        data-id="{{ $cart->cart_id }}"><i
                                                                            class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                                    <a href="#" class="qty-btn btn-down btn_down_update_cart btn_down_update_cart_{{ $cart->cart_id }}"
                                                                        data-id="{{ $cart->cart_id }}"><i
                                                                            class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="product-subtotal" data-title="Total">
                                                            <div class="price price-contain">
                                                                <ins><span class="price-amount"><span
                                                                            class="currencySymbol totol_price_cart_item_update_{{ $cart->cart_id }} ">{{ number_format($price_product * $cart->quantity, 0, ',', '.') }}</span>vnđ</span></ins>
                                                                            <input type="hidden" class="get_total_price_cart_item_check_{{ $cart->cart_id }} change_get_total_price_cart_item_check" value="{{ $price_product * $cart->quantity }}">
                                                                {{-- <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del> --}}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr class="cart_item wrap-buttons">
                                                    <td class="wrap-btn-control" colspan="5">
                                                        <a class="btn back-to-shop">Back to Shop</a>
                                                        <button class="btn btn-update" style="opacity: 0;" type="submit" disabled="">update</button>
                                                        <button class="btn btn-clear" type="reset" data-toggle="modal"
                                                        data-target="#biolife-quickview-block">clear all</button>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                <div class="shpcart-subtotal-block">
                                    <div class="subtotal-line">
                                        <b class="stt-name">Tổng sản phẩm <span class="sub total_item_cart">({{ count($all_cart) }} sản phẩm)</span></b>

                                    </div>
                                    <div class="subtotal-line">
                                        <b class="stt-name">Tổng tiền</b>
                                        <span class="stt-price show_total_price_check_item_cart">{{ number_format($total_price_all_cart, 0, ',', '.') }} vnđ</span>
                                        <input type="hidden" value="{{ $total_price_all_cart }}" class="show_total_price_check_item_cart_hidden">
                                    </div>
                                    <div class="tax-fee">
                                        <p class="title">Est. Taxes &amp; Fees</p>
                                        <p class="desc">Based on 56789</p>
                                    </div>
                                    <div class="btn-checkout content_btn_check_out">
                                        <a class="btn checkout submit_form_check_out">Thanh Toán</a>
                                    </div>
                                    <div class="biolife-progress-bar">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="first-position">
                                                        <span class="index">$0</span>
                                                    </td>
                                                    <td class="mid-position">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: 25%"
                                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td class="last-position">
                                                        <span class="index">$99</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about shipping
                                        and pickup</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                <div class="line_spacing"></div>
                            </div>
                        </div>
                        @if (count($old_date_cart) > 0)
                        <div class="row">
                            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                <h3 class="box-title">Hết hàng</h3>
                                <form class="shopping-cart-form" action="#" method="post">
                                    <table class="shop_table cart-form">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Sản Phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th>Tình Trạng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($old_date_cart as $old_cart)
                                            <tr class="cart_item">
                                                <td class="product-thumbnail" data-title="Product Name">
                                                    @foreach ($all_product as $product)
                                                        @if ($product->product_id == $old_cart->product_id)
                                                            <a class="prd-thumb" href="#">
                                                                <figure><img style="height: 113px; width: 113px"
                                                                        src="{{ asset('public/upload/' . $product->product_image) }}"
                                                                        alt="shipping cart"></figure>
                                                            </a>
                                                            <a class="prd-name"
                                                                href="#">{{ $product->product_name }}</a>
                                                        @endif
                                                    @endforeach

                                                    <div class="action">
                                                        {{-- href="{{ URL::to('remove_item_cart/'.$cart->cart_id) }} --}}
                                                        {{-- <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> --}}
                                                        <a class="remove delete_item_cart"
                                                            data-id="{{ $old_cart->cart_id }}" data-toggle="modal"
                                                            data-target="#delete_cart_item"><i class="fa fa-trash-o"
                                                                aria-hidden="true"></i></a>
                                                    </div>
                                                </td>
                                                <td class="product-price" data-title="Price">
                                                    <div class="price price-contain">
                                                        <ins>
                                                            <span class="price-amount"><span class="currencySymbol">

                                                                    @foreach ($product_price as $price)
                                                                        @if ($old_cart->product_id == $price->product_id)
                                                                            {{ number_format($price->price, 0, ',', '.') }}
                                                                        @endif
                                                                    @endforeach
                                                                </span>vnđ</span>
                                                        </ins>
                                                        {{-- <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del> --}}
                                                    </div>
                                                </td>
                                                <td class="product-quantity" data-title="Quantity">
                                                    <h3><span class="badge badge-secondary">Hết hàng</span></h3>
                                                </td>
                                            </tr>
                                            @endforeach

                                            <tr class="cart_item wrap-buttons">
                                                <td class="wrap-btn-control" colspan="4">
                                                    <a class="btn back-to-shop">Back to Shop</a>
                                                    <button class="btn btn-update" type="submit" disabled="">update</button>
                                                    <button class="btn btn-clear" type="reset">clear all</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        @endif

                    </div>
                @else
                <div class="center" style="text-align: center">
                    <img src="{{ asset('public/upload/noitemcart.png') }}" alt="" width="400px" height="355px">
                </div>
                @endif


                <!--Related Product-->
                <div class="product-related-box single-layout">
                    <div class="biolife-title-box lg-margin-bottom-26px-im">
                        <span class="biolife-icon icon-organic"></span>
                        <span class="subtitle">All the best item for You</span>
                        <h3 class="main-title">Related Products</h3>
                    </div>
                    <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile slick-initialized slick-slider"
                        data-slick="{&quot;rows&quot;:1,&quot;arrows&quot;:true,&quot;dots&quot;:false,&quot;infinite&quot;:false,&quot;speed&quot;:400,&quot;slidesMargin&quot;:0,&quot;slidesToShow&quot;:5, &quot;responsive&quot;:[{&quot;breakpoint&quot;:1200, &quot;settings&quot;:{ &quot;slidesToShow&quot;: 4}},{&quot;breakpoint&quot;:992, &quot;settings&quot;:{ &quot;slidesToShow&quot;: 3, &quot;slidesMargin&quot;:20}},{&quot;breakpoint&quot;:768, &quot;settings&quot;:{ &quot;slidesToShow&quot;: 2, &quot;slidesMargin&quot;:10}}]}">
                        <span class="biolife-icon icon-left-arrow prev slick-arrow slick-disabled" aria-disabled="true"
                            style=""></span>
                        <div class="slick-list draggable">
                            <div class="slick-track"
                                style="opacity: 1; width: 1666px; transform: translate3d(0px, 0px, 0px);">
                                <li class="product-item slick-slide slick-current slick-active first-slick"
                                    data-slick-index="0" aria-hidden="false" tabindex="0"
                                    style="margin-right: 0px; width: 238px;">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-13.jpg" alt="dd" width="270" height="270"
                                                    class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National
                                                    Fresh Fruit</a></h4>
                                            <div class="price ">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn" tabindex="0"><i class="fa fa-heart"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn" tabindex="0"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn" tabindex="0"><i class="fa fa-random"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item slick-slide slick-active" data-slick-index="1" aria-hidden="false"
                                    tabindex="0" style="margin-right: 0px; width: 238px;">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-14.jpg" alt="dd" width="270" height="270"
                                                    class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National
                                                    Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn" tabindex="0"><i class="fa fa-heart"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn" tabindex="0"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn" tabindex="0"><i class="fa fa-random"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item slick-slide slick-active" data-slick-index="2" aria-hidden="false"
                                    tabindex="0" style="margin-right: 0px; width: 238px;">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-15.jpg" alt="dd" width="270" height="270"
                                                    class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National
                                                    Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn" tabindex="0"><i class="fa fa-heart"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn" tabindex="0"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn" tabindex="0"><i class="fa fa-random"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item slick-slide slick-active" data-slick-index="3" aria-hidden="false"
                                    tabindex="0" style="margin-right: 0px; width: 238px;">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-10.jpg" alt="dd" width="270" height="270"
                                                    class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National
                                                    Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn" tabindex="0"><i class="fa fa-heart"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn" tabindex="0"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn" tabindex="0"><i class="fa fa-random"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item slick-slide slick-active last-slick" data-slick-index="4"
                                    aria-hidden="false" tabindex="0" style="margin-right: 0px; width: 238px;">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-08.jpg" alt="dd" width="270" height="270"
                                                    class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National
                                                    Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn" tabindex="0"><i class="fa fa-heart"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn" tabindex="0"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn" tabindex="0"><i class="fa fa-random"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item slick-slide" data-slick-index="5" aria-hidden="true" tabindex="-1"
                                    style="margin-right: 0px; width: 238px;">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="-1">
                                                <img src="assets/images/products/p-21.jpg" alt="dd" width="270" height="270"
                                                    class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="-1">National
                                                    Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn" tabindex="-1"><i
                                                            class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn" tabindex="-1"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn" tabindex="-1"><i
                                                            class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item slick-slide" data-slick-index="6" aria-hidden="true" tabindex="-1"
                                    style="margin-right: 0px; width: 238px;">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="-1">
                                                <img src="assets/images/products/p-18.jpg" alt="dd" width="270" height="270"
                                                    class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="-1">National
                                                    Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span
                                                            class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span
                                                            class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food
                                                    safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn" tabindex="-1"><i
                                                            class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn" tabindex="-1"><i
                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                        cart</a>
                                                    <a href="#" class="btn compare-btn" tabindex="-1"><i
                                                            class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        </div>
                        <span class="biolife-icon icon-arrow-right next slick-arrow" style="" aria-disabled="false"></span>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
