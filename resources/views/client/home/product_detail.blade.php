@extends('client.layout_client')
@section('content_body')
<link rel="stylesheet" href="{{ asset('public/font_end/custom/custom.css') }}">
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{ URL::to('/') }}" class="permal-link">Trang chủ</a></li>
                <li class="nav-item"><span class="current-page">Chi tiết sản phẩm</span></li>
            </ul>
        </nav>
    </div>
    <div class="page-contain single-product">
        <div class="container">
            <!-- Main content -->
            <div id="main-content" class="main-content">

                <!-- summary info -->
                <div class="sumary-product single-layout">
                    <div class="media">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card">
                                    <div class="carousel card-block">
                                        <img class="card-img-top" src="{{ asset('public/upload/' . $product->product_image) }}"
                                                style="height: 428px; width: 428px" />
                                        @foreach ($all_image as $image)
                                            <img class="card-img-top" src="{{ asset('public/upload/' . $image->image) }}"
                                                style="height: 428px; width: 428px" />
                                        @endforeach
                                    </div>
                                </div>
                                <div class="carousel-nav card-block slide_image_detail_product">
                                    <img style="width: 89px; height: 89px;" class="card-img-top"
                                            src="{{ asset('public/upload/' . $product->product_image) }}" />
                                    @foreach ($all_image as $image)
                                        <img style="width: 89px; height: 89px;" class="card-img-top"
                                            src="{{ asset('public/upload/' . $image->image) }}" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-attribute">
                        <h3 class="title">{{ $product->product_name }}</h3>
                        <div class="rating">
                            <p class="star-rating"><span class="width-80percent"></span></p>
                            <span class="review-count">(04 Reviews)</span>
                            <span class="qa-text">Q&amp;A</span>
                            <b class="category">danh mục: {{ $cate->cate_name }}</b>
                        </div>
                        <span class="sku">Kho :
                            @foreach ($product_storage as $prod_qty)
                                @if ($product->product_id == $prod_qty->product_id)
                                    {{ $prod_qty->total_quantity_product }}
                                @endif
                            @endforeach
                        </span>
                        <p class="excerpt">{!! $product->product_sort_desc !!}</p>
                        <div class="price">
                            <ins><span class="price-amount"><span
                                        class="currencySymbol">{{ number_format($price->price, 0, ',', '.') }}</span>vnđ</span></ins>
                        </div>
                        <div class="shipping-info">
                            <p class="shipping-day">3-Ngày Trả Hàng</p>
                            <p class="for-today">Đặt ngay hôm nay</p>
                        </div>
                    </div>
                    <div class="action-form">
                        <div class="quantity-box">
                            <span class="title">Số lượng:</span>
                            <div class="qty-input">
                                <input type="number" class="val_quantity val_qty_{{ $product->product_id }}" value="1" data-max_value="20" data-min_value="1"
                                    data-step="1">
                                <a href="#" class="qty-btn btn-up btn_up_add_cart"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                <a href="#" class="qty-btn btn-down btn_down_add_cart"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="buttons">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                @if (Session::get('customer_id'))
                                    <a href="#" class="btn add-to-cart-btn btn-block btn-sm add_cart_many" data-id="{{ $product->product_id }}">thêm vào giỏ hàng</a>
                                @else
                                    <a href="{{ URL::to('login_client') }}" class="btn add-to-cart-btn btn-block btn-sm">thêm vào giỏ hàng</a>
                                @endif

                            </div>
                        </div>
                        <div class="row buttons">
                            <p class="pull-row">
                                <a href="#" class="btn wishlist-btn">wishlist</a>
                                <a href="#" class="btn compare-btn">compare</a>
                            </p>
                        </div>
                        <div class="social-media">
                            <ul class="social-list">
                                <li><a href="#" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="#" class="social-link"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="#" class="social-link"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="#" class="social-link"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="#" class="social-link"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="acepted-payment-methods">
                            <ul class="payment-methods">
                                <li><img src="{{ asset('public/font_end/assets/images/card1.jpg') }}" alt="" width="51"
                                        height="36"></li>
                                <li><img src="{{ asset('public/font_end/assets/images/card2.jpg') }}" alt="" width="51"
                                        height="36"></li>
                                <li><img src="{{ asset('public/font_end/assets/images/card3.jpg') }}" alt="" width="51"
                                        height="36"></li>
                                <li><img src="{{ asset('public/font_end/assets/images/card4.jpg') }}" alt="" width="51"
                                        height="36"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tab info -->
                <div class="product-tabs single-layout biolife-tab-contain">
                    <div class="tab-head">
                        <ul class="tabs">
                            <li class="tab-element active"><a href="#tab_1st" class="tab-link">Mô Tả Sản Phẩm</a>
                            </li>
                            <li class="tab-element"><a href="#tab_4th" class="tab-link">Đánh Giá Sản Phẩm <sup>(3)</sup></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="tab_1st" class="tab-contain desc-tab active">
                            <p class="desc">{!! $product->product_desc !!}</p>
                        </div>
                        <div id="tab_4th" class="tab-contain review-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                        <div class="rating-info">
                                            <p class="index"><strong class="rating">4.4</strong>out of 5</p>
                                            <div class="rating">
                                                <p class="star-rating"><span class="width-80percent"></span></p>
                                            </div>
                                            <p class="see-all">See all 68 reviews</p>
                                            <ul class="options">
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">5stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-90percent"></span></span>
                                                        </span>
                                                        <span class="number">90</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">4stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-30percent"></span></span>
                                                        </span>
                                                        <span class="number">30</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">3stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-40percent"></span></span>
                                                        </span>
                                                        <span class="number">40</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">2stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-20percent"></span></span>
                                                        </span>
                                                        <span class="number">20</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">1star</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-10percent"></span></span>
                                                        </span>
                                                        <span class="number">10</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                        <div class="review-form-wrapper">
                                            <span class="title">Submit your review</span>
                                            <form action="#" name="frm-review" method="post">
                                                <div class="comment-form-rating">
                                                    <label>1. Your rating of this products:</label>
                                                    <p class="stars">
                                                        <span>
                                                            <a class="btn-rating" data-value="star-1" href="#"><i
                                                                    class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="star-2" href="#"><i
                                                                    class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="star-3" href="#"><i
                                                                    class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="star-4" href="#"><i
                                                                    class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="star-5" href="#"><i
                                                                    class="fa fa-star-o" aria-hidden="true"></i></a>
                                                        </span>
                                                    </p>
                                                </div>
                                                <p class="form-row wide-half">
                                                    <input type="text" name="name" value="" placeholder="Your name">
                                                </p>
                                                <p class="form-row wide-half">
                                                    <input type="email" name="email" value="" placeholder="Email address">
                                                </p>
                                                <p class="form-row">
                                                    <textarea name="comment" id="txt-comment" cols="30" rows="10"
                                                        placeholder="Write your review here..."></textarea>
                                                </p>
                                                <p class="form-row">
                                                    <button type="submit" name="submit">submit review</button>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="comments">
                                    <ol class="commentlist">
                                        <li class="review">
                                            <div class="comment-container">
                                                <div class="row">
                                                    <div class="comment-content col-lg-8 col-md-9 col-sm-8 col-xs-12">
                                                        <p class="comment-in"><span class="post-name">Quality is our way of
                                                                life</span><span class="post-date">01/04/2018</span></p>
                                                        <div class="rating">
                                                            <p class="star-rating"><span class="width-80percent"></span></p>
                                                        </div>
                                                        <p class="author">by: <b>Shop organic</b></p>
                                                        <p class="comment-text">There are few things in life that please
                                                            people more than the succulence of quality fresh fruit and
                                                            vegetables. At Fresh Fruits we work to deliver the world’s
                                                            freshest, choicest, and juiciest produce to discerning customers
                                                            across the UAE and GCC.</p>
                                                    </div>
                                                    <div
                                                        class="comment-review-form col-lg-3 col-lg-offset-1 col-md-3 col-sm-4 col-xs-12">
                                                        <span class="title">Was this review helpful?</span>
                                                        <ul class="actions">
                                                            <li><a href="#" class="btn-act like" data-type="like"><i
                                                                        class="fa fa-thumbs-up" aria-hidden="true"></i>Yes
                                                                    (100)</a></li>
                                                            <li><a href="#" class="btn-act hate" data-type="dislike"><i
                                                                        class="fa fa-thumbs-down" aria-hidden="true"></i>No
                                                                    (20)</a></li>
                                                            <li><a href="#" class="btn-act report" data-type="dislike"><i
                                                                        class="fa fa-flag" aria-hidden="true"></i>Report</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                    <div class="biolife-panigations-block version-2">
                                        <ul class="panigation-contain">
                                            <li><span class="current-page">1</span></li>
                                            <li><a href="#" class="link-page">2</a></li>
                                            <li><a href="#" class="link-page">3</a></li>
                                            <li><span class="sep">....</span></li>
                                            <li><a href="#" class="link-page">20</a></li>
                                            <li><a href="#" class="link-page next"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="result-count">
                                            <p class="txt-count"><b>1-5</b> of <b>126</b> reviews</p>
                                            <a href="#" class="link-to">See all<i class="fa fa-caret-right"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- realative product --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('public/font_end/assets/js/jquery.nice-select.min.js') }}"></script>
@endsection
