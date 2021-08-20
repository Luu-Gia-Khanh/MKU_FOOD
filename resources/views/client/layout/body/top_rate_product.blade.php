<div class="Product-box sm-margin-top-30px" style="padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-6">
                @if (count($all_product_discount_today) > 0)
                    <div class="advance-product-box">
                        <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                            <h3 class="title" style="font-size: 22px;">Khuyến Mãi Sắp Hết</h3>
                        </div>
                        <ul class="products biolife-carousel nav-top-right nav-none-on-mobile" data-slick='{"arrows":true, "dots":false, "infinite":false, "speed":400, "slidesMargin":30, "slidesToShow":1}'>
                            @foreach ($all_product_discount_today as $product)
                                @php
                                    $check_already_wish = App\Http\Controllers\WishListController::checkProductWishLish($product->product_id);
                                    $price_discount = App\Http\Controllers\HomeClientController::check_price_discount($product->product_id);
                                @endphp
                                @if ($price_discount->percent_discount != 0)
                                    <li class="product-item">
                                        <div class="contain-product deal-layout contain-product__deal-layout">
                                            <div class="product-thumb">
                                                <a href="{{ URL::to('product_detail/'.$product->product_id) }}" class="link-to-product">
                                                    <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="dd" width="330" height="330" style="width: 330px; height: 330px;" class="product-thumnail">
                                                </a>
                                                <div class="labels" style="top:20px; left:20px;">
                                                    @if ($price_discount->percent_discount != 0)
                                                        <span class="sale-label">-{{ $price_discount->percent_discount }}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="biolife-countdown" data-datetime="{{ $price_discount->date_end_discount }}"></div>
                                                <b class="categories">{{ $product->cate_name }}</b>
                                                <h4 class="product-title"><a href="{{ URL::to('product_detail/'.$product->product_id) }}" class="pr-name">{{ $product->product_name }}</a></h4>
                                                <div class="price ">
                                                    @if ($price_discount->percent_discount == 0)
                                                        <ins><span class="price-amount">
                                                            <span class="currencySymbol">{{ number_format($price_discount->price_now, 0, ',', '.') }}₫</span>
                                                        </ins>
                                                    @else
                                                        <ins><span class="price-amount">
                                                            <span class="currencySymbol">{{ number_format($price_discount->price_now, 0, ',', '.') }}₫</span>
                                                        </ins>
                                                        <del><span class="price-amount"><span class="currencySymbol">{{ number_format($price_discount->price_old, 0, ',', '.') }}₫</span></del>
                                                    @endif
                                                </div>
                                                <div class="slide-down-box">
                                                    {{-- add cart --}}
                                                    <input type="hidden" class="val_qty_{{ $product->product_id }}"
                                                        value="1">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    {{-- end add cart --}}
                                                    <div class="buttons">
                                                        {{-- wish list --}}
                                                    @if (Session::get('customer_id'))
                                                    <a class="btn wishlist-btn btn_add_wish_lish" style="cursor: pointer;"
                                                        data-id="{{ $product->product_id }}">
                                                        @if ($check_already_wish->check_already == 1)
                                                            <i class="fa fa-heart" aria-hidden="true" style="color: #7faf51"></i>
                                                        @else
                                                            <i class="fa fa-heart icon_wish_list_{{ $product->product_id }}" aria-hidden="true"></i>
                                                        @endif
                                                    </a>
                                                @else
                                                    <a href="{{ URL::to('login_client') }}"class="btn wishlist-btn" >
                                                        @if ($check_already_wish->check_already == 1)
                                                            <i class="fa fa-heart" aria-hidden="true" style="color: #7faf51"></i>
                                                        @else
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                        @endif
                                                    </a>
                                                @endif
                                                {{-- end wishlist --}}

                                                        {{-- add cart --}}
                                                        @if (Session::get('customer_id'))
                                                            <button class="btn add-to-cart-btn add_cart_one"
                                                            data-id="{{ $product->product_id }}">thêm vào giỏ hàng</button>
                                                        @else
                                                            <a href="{{ URL::to('login_client') }}"
                                                                class="btn add-to-cart-btn btn-block btn-sm">
                                                                thêm vào giỏ hàng
                                                            </a>
                                                        @endif
                                                        <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @else
                    <img src="{{ asset('public/upload/image_exchange_no_discount_today.png') }}" alt="">
                @endif
            </div>
            <div class="col-lg-8 col-md-7 col-sm-6">
                @if (count($all_product_top_rating) > 0)
                    <div class="advance-product-box">
                        <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                            <h3 class="title" style="font-size: 22px;">Top Rating</h3>
                        </div>
                        <ul class="products biolife-carousel nav-center-03 nav-none-on-mobile row-space-29px" data-slick='{"rows":2,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":2,"responsive":[{"breakpoint":1200,"settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":992, "settings":{ "rows":2, "slidesToShow": 1}},{"breakpoint":768, "settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":500, "settings":{ "rows":2, "slidesToShow": 1}}]}'>
                            @foreach ($all_product_top_rating as $product)
                                @php
                                    $price_discount = App\Http\Controllers\HomeClientController::check_price_discount($product->product_id);
                                    $info_rating_saled = App\Http\Controllers\HomeClientController::info_rating_saled($product->product_id);
                                @endphp
                                <li class="product-item" style="background-color: #fff; position: relative">
                                    <div class="contain-product right-info-layout contain-product__right-info-layout" >
                                        <div class="product-thumb">
                                            <a href="{{ URL::to('product_detail/'.$product->product_id) }}" class="link-to-product">
                                                <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="dd" style="width: 170px; height: 170px" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">{{ $product->cate_name }}</b>
                                            <h4 class="product-title"><a href="{{ URL::to('product_detail/'.$product->product_id) }}" class="pr-name">{{ $product->product_name }}</a></h4>
                                            <div class="price ">
                                                @if ($price_discount->percent_discount == 0)
                                                    <ins><span class="price-amount"><span class="currencySymbol">{{ number_format($price_discount->price_now, 0, ',', '.') }}₫</span></ins>
                                                @else
                                                    <ins><span class="price-amount"><span class="currencySymbol">{{ number_format($price_discount->price_now, 0, ',', '.') }}₫</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">{{ number_format($price_discount->price_old, 0, ',', '.') }}₫</span></del>
                                                @endif
                                            </div>
                                            <div class="rating">
                                                <p class="star-rating"><span class="width-80percent" style="width:{{ $info_rating_saled->avg_rating *20 }}%"></span></p>
                                                <span class="review-count">({{ $info_rating_saled->count_all_rating }} Đánh giá)</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($price_discount->percent_discount > 0)
                                        <div class="content_discount_product" style="top: 8px; right: 202px;">
                                            <div class="content_sub_discount bg_discount">
                                                <div class="content_title_discount">
                                                    <span class="percent">{{ $price_discount->percent_discount }}%</span>
                                                    <span class="txt_giam">giảm</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="biolife-banner style-01 biolife-banner__style-01 sm-margin-top-30px xs-margin-top-80px">
                            <div class="banner-contain">
                                <a href="#" class="bn-link"></a>
                                <div class="text-content">
                                    <span class="first-line">Tươi Mới Mỗi Ngày</span>
                                    <b class="second-line">Natural</b>
                                    <i class="third-line">MKU Food</i>
                                    <span class="fourth-line">Premium Quality</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else

                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('public/font_end/custom_ui/js/count_down.js') }}"></script>
{{-- <script type="text/javascript">
    var product_id = " echo $product->product_id;";
    var countDownDate = new Date(document.getElementById('val_count_down_'+product_id).value).getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("days_"+product_id).innerHTML = days;
        document.getElementById("hours_"+product_id).innerHTML = hours;
        document.getElementById("minutes_"+product_id).innerHTML = minutes;
        document.getElementById("seconds_"+product_id).innerHTML = seconds;
    }, 1000);
</script> --}}

