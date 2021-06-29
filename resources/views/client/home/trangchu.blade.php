@extends('client.layout_client')
{{-- SLIDER --}}
@section('slider_view_client')
    @include('client.layout.body.slider')
@endsection
{{-- TAB SHOW PRODUCT --}}
@section('product_tap_view_client')
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
                <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile eq-height-contain" data-slick='{"rows":1 ,"arrows":true,"dots":false,"infinite":true,"speed":400,"slidesMargin":10,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":15}}]}'>
                    @foreach ($all_product as $product)
                        <li class="product-item">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product" style="height: 270px; width: 270px">
                                        <img src="{{ asset('public/upload/'.$product->product_image) }}" style="height: 270px; width: 270px" alt="Vegetables" width="270" height="270" class="product-thumnail">
                                    </a>
                                    <a  href="{{ URL::to('product_detail/'.$product->product_id) }}" class="lookup get_val_quickview btn_call_quickview" data-id="{{$product->product_id}}"><i class="biolife-icon icon-search"></i></a>
                                </div>
                                <div class="info">
                                    <b class="categories">
                                        @foreach ($all_category as $cate)
                                            @if ($cate->cate_id ==$product->category_id)
                                                {{ $cate->cate_name }}
                                            @endif
                                        @endforeach
                                    </b>
                                    <h4 class="product-title"><a href="{{ URL::to('product_detail/'.$product->product_id) }}" class="">{{ $product->product_name }}</a></h4>
                                    <div class="price ">
                                        <ins>
                                            <span class="price-amount"><span class="currencySymbol">
                                                @foreach ($all_price as $price)
                                                    @if ($price->product_id == $product->product_id)
                                                        {{ number_format($price->price, 0, ',', '.') }} <sub>vnđ</sub>
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
                                            <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            {{-- add cart --}}
                                            <button href="#" class="btn add-to-cart-btn btn-block btn-sm add_cart_one" data-id="{{ $product->product_id }}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>
                                            <input type="hidden" class="val_qty_{{ $product->product_id }}" value="1">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            {{-- end add cart --}}
                                            <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
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
