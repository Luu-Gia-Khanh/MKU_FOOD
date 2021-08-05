@extends('client.layout_client')
@section('content_body')
    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">Thực Phẩm</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{ URL::to('/') }}" class="permal-link">Trang chủ</a></li>
                <li class="nav-item"><span class="current-page">Cửa hàng</span></li>
            </ul>
        </nav>
    </div>
<div class="page-contain category-page left-sidebar">
    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">

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

                <div class="product-category grid-style">

                    <div id="top-functions-area" class="top-functions-area" >
                        <div class="flt-item to-left group-on-mobile">
                            <span class="flt-title">Refine</span>
                            <a href="#" class="icon-for-mobile">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                            <div class="wrap-selectors">
                                <form action="#" name="frm-refine" method="get">
                                    <span class="title-for-mobile">Refine Products By</span>
                                    <div data-title="Price:" class="selector-item">
                                        <select name="price" class="selector">
                                            <option value="all">Price</option>
                                            <option value="class-1st">Less than 5$</option>
                                            <option value="class-2nd">$5-10$</option>
                                            <option value="class-3rd">$10-20$</option>
                                            <option value="class-4th">$20-45$</option>
                                            <option value="class-5th">$45-100$</option>
                                            <option value="class-6th">$100-150$</option>
                                            <option value="class-7th">More than 150$</option>
                                        </select>
                                    </div>
                                    <div data-title="Brand:" class="selector-item">
                                        <select name="brad" class="selector">
                                            <option value="all">Top brands</option>
                                            <option value="br2">Brand first</option>
                                            <option value="br3">Brand second</option>
                                            <option value="br4">Brand third</option>
                                            <option value="br5">Brand fourth</option>
                                            <option value="br6">Brand fiveth</option>
                                        </select>
                                    </div>
                                    <div data-title="Avalability:" class="selector-item">
                                        <select name="ability" class="selector">
                                            <option value="all">Availability</option>
                                            <option value="vl2">Availability 1</option>
                                            <option value="vl3">Availability 2</option>
                                            <option value="vl4">Availability 3</option>
                                            <option value="vl5">Availability 4</option>
                                            <option value="vl6">Availability 5</option>
                                        </select>
                                    </div>
                                    <p class="btn-for-mobile"><button type="submit" class="btn-submit">Go</button></p>
                                </form>
                            </div>
                        </div>
                        <div class="flt-item to-right">
                            <span class="flt-title">Sort</span>
                            <div class="wrap-selectors">
                                <div class="selector-item orderby-selector">
                                    <select name="orderby" class="orderby" aria-label="Shop order">
                                        <option value="menu_order" selected="selected">Default sorting</option>
                                        <option value="popularity">popularity</option>
                                        <option value="rating">average rating</option>
                                        <option value="date">newness</option>
                                        <option value="price">price: low to high</option>
                                        <option value="price-desc">price: high to low</option>
                                    </select>
                                </div>
                                <div class="selector-item viewmode-selector">
                                    <a href="category-grid-left-sidebar.html" class="viewmode grid-mode active"><i class="biolife-icon icon-grid"></i></a>
                                    <a href="category-list-left-sidebar.html" class="viewmode detail-mode"><i class="biolife-icon icon-list"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <ul class="products-list">
                            @foreach ($all_product as $product)
                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="{{ URL::to('product_detail/' . $product->product_id) }}"
                                                class="link-to-product" style="height: 270px; width: 270px">
                                                <img src="{{ asset('public/upload/' . $product->product_image) }}"
                                                    style="height: 270px; width: 270px" alt="Vegetables" class="product-thumnail">
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

                    <div class="biolife-panigations-block">
                        <ul class="panigation-contain">
                            <li><span class="current-page">1</span></li>
                            <li><a href="#" class="link-page">2</a></li>
                            <li><a href="#" class="link-page">3</a></li>
                            <li><span class="sep">....</span></li>
                            <li><a href="#" class="link-page">20</a></li>
                            <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                </div>

            </div>
            <!-- Sidebar -->
            <aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="biolife-mobile-panels">
                    <span class="biolife-current-panel-title">Sidebar</span>
                    <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
                </div>
                <div class="sidebar-contain">
                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Departements</h4>
                        <div class="wgt-content">
                            <ul class="cat-list">
                                <li class="cat-list-item"><a href="#" class="cat-link">Organic Food</a></li>
                                <li class="cat-list-item"><a href="#" class="cat-link">Fresh Fruit</a></li>
                                <li class="cat-list-item"><a href="#" class="cat-link">Dried Fruits</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Shipping & Pickup</h4>
                        <div class="wgt-content">
                            <ul class="cat-list">
                                <li class="cat-list-item"><a href="#" class="cat-link">Show all</a></li>
                                <li class="cat-list-item"><a href="#" class="cat-link">2- Day shipping</a></li>
                                <li class="cat-list-item"><a href="#" class="cat-link">Shop to Home</a></li>
                                <li class="cat-list-item"><a href="#" class="cat-link">Free Pickup</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget price-filter biolife-filter">
                        <h4 class="wgt-title">Price</h4>
                        <div class="wgt-content">
                            <div class="frm-contain">
                                <form action="#" name="price-filter" id="price-filter" method="get">
                                    <p class="f-item">
                                        <label for="pr-from">$</label>
                                        <input class="input-number" type="number" id="pr-from" value="" name="price-from">
                                    </p>
                                    <p class="f-item">
                                        <label for="pr-to">to $</label>
                                        <input class="input-number" type="number" id="pr-to" value="" name="price-from">
                                    </p>
                                    <p class="f-item"><button class="btn-submit" type="submit">go</button></p>
                                </form>
                            </div>
                            <ul class="check-list bold single">
                                <li class="check-list-item"><a href="#" class="check-link">$0 - $5</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">$5 - $10</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">$15 - $20</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Brand</h4>
                        <div class="wgt-content">
                            <ul class="check-list multiple">
                                <li class="check-list-item"><a href="#" class="check-link">Great Value Organic</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">Plum Organic</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">Shop to Home</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Color</h4>
                        <div class="wgt-content">
                            <ul class="color-list">
                                <li class="color-item"><a href="#" class="c-link"><span class="symbol img-color"></span>Multi</a></li>
                                <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-01"></span>Red</a></li>
                                <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-02"></span>Orrange</a></li>
                                <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-03"></span>Other</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Popular Size</h4>
                        <div class="wgt-content">
                            <ul class="check-list bold multiple">
                                <li class="check-list-item"><a href="#" class="check-link">8oz</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">15oz</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">6oz</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">30oz</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Number of Pieces</h4>
                        <div class="wgt-content">
                            <ul class="check-list bold">
                                <li class="check-list-item"><a href="#" class="check-link">1 to 9</a></li>
                                <li class="check-list-item"><a href="#" class="check-link">10 to 15</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Recently Viewed</h4>
                        <div class="wgt-content">
                            <ul class="products">
                                <li class="pr-item">
                                    <div class="contain-product style-widget">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-13.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pr-item">
                                    <div class="contain-product style-widget">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-14.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="pr-item">
                                    <div class="contain-product style-widget">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product" tabindex="0">
                                                <img src="assets/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">Product Tags</h4>
                        <div class="wgt-content">
                            <ul class="tag-cloud">
                                <li class="tag-item"><a href="#" class="tag-link">Fresh Fruit</a></li>
                                <li class="tag-item"><a href="#" class="tag-link">Natural Food</a></li>
                                <li class="tag-item"><a href="#" class="tag-link">Hot</a></li>
                                <li class="tag-item"><a href="#" class="tag-link">Organics</a></li>
                                <li class="tag-item"><a href="#" class="tag-link">Dried Organic</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>
@endsection
