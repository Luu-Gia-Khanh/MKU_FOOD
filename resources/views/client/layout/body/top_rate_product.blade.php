<div class="Product-box sm-margin-top-30px" style="padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-6">
                <div class="advance-product-box">
                    <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                        <h3 class="title" style="font-size: 24px;">Khuyến Mãi Hôm Nay</h3>
                    </div>
                    <ul class="products biolife-carousel nav-top-right nav-none-on-mobile" data-slick='{"arrows":true, "dots":false, "infinite":false, "speed":400, "slidesMargin":30, "slidesToShow":1}'>
                        @foreach ($all_product_join as $product)
                            @php
                                $price_discount = App\Http\Controllers\HomeClientController::check_price_discount($product->product_id);
                            @endphp
                            @if ($price_discount->percent_discount != 0)
                                <li class="product-item">
                                    <div class="contain-product deal-layout contain-product__deal-layout">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="assets/images/home-03/product_deal-02_330x330.jpg" alt="dd" width="330" height="330" class="product-thumnail">
                                            </a>
                                            <div class="labels">
                                                <span class="sale-label">-50%</span>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <div class="biolife-countdown" data-datetime="{{ $price_discount->date_end_discount }}"></div>
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price ">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn">add to cart</a>
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
            </div>
            <div class="col-lg-8 col-md-7 col-sm-6">
                <div class="advance-product-box">
                    <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                        <h3 class="title" style="font-size: 24px;">Sản Phẩm Được Nhiều Đánh Giá</h3>
                    </div>
                    <ul class="products biolife-carousel nav-center-03 nav-none-on-mobile row-space-29px" data-slick='{"rows":2,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":2,"responsive":[{"breakpoint":1200,"settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":992, "settings":{ "rows":2, "slidesToShow": 1}},{"breakpoint":768, "settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":500, "settings":{ "rows":2, "slidesToShow": 1}}]}'>
                        <li class="product-item" style="background-color: #fff; position: relative">
                            <div class="contain-product right-info-layout contain-product__right-info-layout" >
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="{{ asset('public/upload/8up-102410.jpg') }}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Vegetables</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">Pumpkins Fairytale</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="rating">
                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                        <span class="review-count">(05 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="content_discount_product" style="top: 8px; right: 202px;">
                                <div class="content_sub_discount bg_discount">
                                    <div class="content_title_discount">
                                        <span class="percent">{{ $price_discount->percent_discount }}%</span>
                                        <span class="txt_giam">giảm</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item" style="background-color: #fff;">
                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="{{ asset('public/upload/8up-102410.jpg') }}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Vegetables</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">Pumpkins Fairytale</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="rating">
                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                        <span class="review-count">(05 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item" style="background-color: #fff;">
                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="{{ asset('public/upload/8up-102410.jpg') }}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Vegetables</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">Pumpkins Fairytale</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="rating">
                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                        <span class="review-count">(05 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item" style="background-color: #fff;">
                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="{{ asset('public/upload/8up-102410.jpg') }}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Vegetables</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">Pumpkins Fairytale</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="rating">
                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                        <span class="review-count">(05 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item" style="background-color: #fff;">
                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="{{ asset('public/upload/8up-102410.jpg') }}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Vegetables</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">Pumpkins Fairytale</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="rating">
                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                        <span class="review-count">(05 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item" style="background-color: #fff;">
                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="{{ asset('public/upload/8up-102410.jpg') }}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Vegetables</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">Pumpkins Fairytale</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="rating">
                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                        <span class="review-count">(05 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="product-item" style="background-color: #fff;">
                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                <div class="product-thumb">
                                    <a href="#" class="link-to-product">
                                        <img src="{{ asset('public/upload/8up-102410.jpg') }}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">Vegetables</b>
                                    <h4 class="product-title"><a href="#" class="pr-name">Pumpkins Fairytale</a></h4>
                                    <div class="price ">
                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                    </div>
                                    <div class="rating">
                                        <p class="star-rating"><span class="width-80percent"></span></p>
                                        <span class="review-count">(05 Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="biolife-banner style-01 biolife-banner__style-01 sm-margin-top-30px xs-margin-top-80px">
                        <div class="banner-contain">
                            <a href="#" class="bn-link"></a>
                            <div class="text-content">
                                <span class="first-line">Daily Fresh</span>
                                <b class="second-line">Natural</b>
                                <i class="third-line">Fresh Food</i>
                                <span class="fourth-line">Premium Quality</span>
                            </div>
                        </div>
                    </div>
                </div>
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

