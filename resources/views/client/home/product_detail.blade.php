@extends('client.layout_client')
@section('content_body')
@php
    $total_comment = count($all_comment_to_count);
    if ($total_comment != 0){
        $persen_rating_5 = number_format(($rating_5/$total_comment)*100,0,",",".");
        $persen_rating_4 = number_format(($rating_4/$total_comment)*100,0,",",".");
        $persen_rating_3 = number_format(($rating_3/$total_comment)*100,0,",",".");
        $persen_rating_2 = number_format(($rating_2/$total_comment)*100,0,",",".");
        $persen_rating_1 = 100-$persen_rating_5-$persen_rating_4-$persen_rating_3-$persen_rating_2;

        $avg_rating = (($rating_5*5)+($rating_4*4)+($rating_3*3)+($rating_2*2)+($rating_1*1))/$total_comment;
    }
    else{
        $persen_rating_5 = 0;
        $persen_rating_4 = 0;
        $persen_rating_3 = 0;
        $persen_rating_2 = 0;
        $persen_rating_1 = 0;
        $avg_rating = 0;
    }

@endphp
<link rel="stylesheet" href="{{ asset('public/font_end/custom/custom.css') }}">
<link rel="stylesheet" href="{{ asset('public/font_end/custom/voucher_checkout_custom.css') }}">
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
                            <p class="star-rating"><span class="width-80percent" style="width: {{ $avg_rating*20 }}%"></span></p>
                            <span class="review-count count_comment_on_detail">({{ count($all_comment_to_count) }} đánh giá)</span>
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
                        <div class="content__voucher">
                            <div class="content__voucher--label">
                                <span>Mã voucher</span>
                            </div>
                            <div class="content__voucher-list">
                                <div class="content__voucher-item">
                                    <span>Giảm 50%</span>
                                </div>
                                <div class="content__voucher-item">
                                    <span>Giảm 100k</span>
                                </div>
                                <div class="content__voucher-item">
                                    <span>Giảm 50%</span>
                                </div>
                                <div class="content__voucher-item">
                                    <span>Giảm 50%</span>
                                </div>
                                <div class="content__voucher-item">
                                    <span>Giảm 50%</span>
                                </div>
                            </div>
                            <div class="container__voucher-list">
                                <div class="container__voucher-item">
                                    <div class="container__voucher-item--left">
                                        <div class="voucher-item--left-img">
                                            <img src="{{ asset('public/upload/voucher_image.png') }}" alt="">
                                        </div>
                                        <div class="voucher__item--left-name" style="font-size: 10px;">
                                            MKU FOOD
                                        </div>
                                        <div class="_2t7jNq _3LWUvt"></div>
                                    </div>
                                    <div class="container__voucher-item--right">
                                        <div class="voucher-item--right-info">
                                            <div class="voucher-item--right-info-name">
                                                Giảm 30% rinh ngay sản phẩm
                                            </div>
                                            <div class="voucher-item--right-info-end-date">
                                                HSD: 27/07/2021
                                            </div>
                                        </div>
                                        <div class="voucher-item--right-btn">
                                            <button>Lưu</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="container__voucher-item">
                                    <div class="container__voucher-item--left">
                                        <div class="voucher-item--left-img">
                                            <img src="{{ asset('public/upload/voucher_image.png') }}" alt="">
                                        </div>
                                        <div class="voucher__item--left-name" style="font-size: 10px;">
                                            MKU FOOD
                                        </div>
                                        <div class="_2t7jNq _3LWUvt"></div>
                                    </div>
                                    <div class="container__voucher-item--right">
                                        <div class="voucher-item--right-info">
                                            <div class="voucher-item--right-info-name">
                                                Giảm 15k với sản phẩm Rau
                                            </div>
                                            <div class="voucher-item--right-info-end-date">
                                                HSD: 27/07/2021
                                            </div>
                                        </div>
                                        <div class="voucher-item--right-btn">
                                            <button>Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <a href="#" class="btn add-to-cart-btn btn-block btn-sm add_cart_many add_cart_many_detail" data-id="{{ $product->product_id }}">thêm vào giỏ hàng</a>
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
                            <li class="tab-element"><a href="#tab_4th" class="tab-link">Đánh Giá Sản Phẩm <sup class="count_comment_tab">({{ count($all_comment_to_count) }})</sup></a>
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
                                            <p class="index" style="font-size: 18px; font-weight: bold"><strong class="rating">{{ number_format($avg_rating,1,".",".") }}</strong>trên 5</p>
                                            <div class="rating">
                                                <p class="star-rating"><span class="width-80percent" style="width: {{ $avg_rating*20 }}%"></span></p>
                                            </div>
                                            <p class="see-all count_comment_rating">{{ count($all_comment_to_count) }} đánh giá</p>
                                            <ul class="options">
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">
                                                            5 <i class="fa fa-star-o" aria-hidden="true" style="color: #68645f; font-size: 16px"></i>
                                                        </span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-30percent" style="width: {{ $persen_rating_5 }}%"></span></span>
                                                        </span>
                                                        <span class="number">{{ $persen_rating_5 }}%</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">
                                                            4 <i class="fa fa-star-o" aria-hidden="true" style="color: #68645f; font-size: 16px"></i>
                                                        </span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-30percent" style="width: {{ $persen_rating_4 }}%"></span></span>
                                                        </span>
                                                        <span class="number">{{ $persen_rating_4 }}%</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">
                                                            3 <i class="fa fa-star-o" aria-hidden="true" style="color: #68645f; font-size: 16px"></i>
                                                        </span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-40percent" style="width: {{ $persen_rating_3 }}%"></span></span>
                                                        </span>
                                                        <span class="number">{{ $persen_rating_3 }}%</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">
                                                            2 <i class="fa fa-star-o" aria-hidden="true" style="color: #68645f; font-size: 16px"></i>
                                                        </span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-20percent" style="width: {{ $persen_rating_2 }}%"></span></span>
                                                        </span>
                                                        <span class="number">{{ $persen_rating_2 }}%</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">
                                                            1 <i class="fa fa-star-o" aria-hidden="true" style="color: #68645f; font-size: 16px"></i>
                                                        </span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span
                                                                    class="percent width-10percent" style="width: {{ $persen_rating_1 }}%"></span></span>
                                                        </span>
                                                        <span class="number">{{ $persen_rating_1 }}%</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                        @if (Session::get('able_rating_comment_'.$product->product_id))
                                            <div class="review-form-wrapper">
                                                <span class="title">đánh giá sản phẩm</span>
                                                    <div class="comment-form-rating">
                                                        <label>1. Bạn cảm thấy sản phẩm này như thế nào ?</label>
                                                        <p class="stars">
                                                            <span>
                                                                <a class="btn-rating choose_rating" data-value="1" href="#">
                                                                    <i class="fa fa-star-o" aria-hidden="true" style="font-size: 18px"></i>
                                                                </a>
                                                                <a class="btn-rating choose_rating" data-value="2" href="#">
                                                                    <i class="fa fa-star-o" aria-hidden="true" style="font-size: 18px"></i>
                                                                </a>
                                                                <a class="btn-rating choose_rating" data-value="3" href="#">
                                                                    <i class="fa fa-star-o" aria-hidden="true" style="font-size: 18px"></i>
                                                                </a>
                                                                <a class="btn-rating choose_rating" data-value="4" href="#">
                                                                    <i class="fa fa-star-o" aria-hidden="true" style="font-size: 18px"></i>
                                                                </a>
                                                                <a class="btn-rating choose_rating" data-value="5" href="#">
                                                                    <i class="fa fa-star-o" aria-hidden="true" style="font-size: 18px"></i>
                                                                </a>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <p class="form-row">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <textarea name="comment" class="comment_message" id="txt_comment" cols="30" rows="10"
                                                            placeholder="Viết đánh giá của bạn về sản phẩm này..."></textarea>
                                                    </p>
                                                    <p class="form-row">
                                                        <button type="submit" name="submit" class="send_comment_rating">Gửi đánh giá</button>
                                                    </p>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                    <div id="comments">
                                        <ol class="commentlist content_comment_rating">
                                            @if (count($all_comment) > 0)
                                                @foreach ($all_comment as $comment)
                                                    @foreach ($all_rating as $rating)
                                                        @if ($comment->comment_id == $rating->rating_id && $comment->customer_id == $rating->customer_id && $comment->product_id == $rating->product_id && $comment->created_at == $rating->created_at)
                                                            <li class="review">
                                                                <div class="comment-container">
                                                                    <div class="row">
                                                                        <div class="comment-content col-lg-8 col-md-9 col-sm-8 col-xs-12">
                                                                            <div class="content_info_customer">
                                                                                    {{-- <p class="comment-in"><span class="post-name"> --}}
                                                                                    @foreach ($customers as $customer)
                                                                                        @if ($comment->customer_id == $customer->customer_id)
                                                                                            @foreach ($customer_info as $info)
                                                                                                @if ($info->customer_id == $customer->customer_id)
                                                                                                    <img src="{{ asset('public/upload/'.$info->customer_avt) }}" style="width: 60px; height: 60px; border-radius: 50%" alt="">
                                                                                                @endif
                                                                                            @endforeach

                                                                                            <div class="content-name-rating">
                                                                                                <p class="comment-in"><span class="post-name" style="font-size: 17px">{{ $customer->username }}</span></p>
                                                                                                <div class="rating">
                                                                                                    <p class="star-rating">
                                                                                                        @php
                                                                                                            $convert_persen = 0;
                                                                                                        @endphp
                                                                                                        @if ($rating->rating_level == 1)
                                                                                                            @php
                                                                                                                $convert_persen = 20;
                                                                                                            @endphp
                                                                                                        @elseif($rating->rating_level == 2)
                                                                                                            @php
                                                                                                                $convert_persen = 40;
                                                                                                            @endphp
                                                                                                        @elseif($rating->rating_level == 3)
                                                                                                            @php
                                                                                                                $convert_persen = 60;
                                                                                                            @endphp
                                                                                                        @elseif($rating->rating_level == 4)
                                                                                                            @php
                                                                                                                $convert_persen = 80;
                                                                                                            @endphp
                                                                                                        @elseif($rating->rating_level == 5)
                                                                                                            @php
                                                                                                                $convert_persen = 100;
                                                                                                            @endphp
                                                                                                        @endif
                                                                                                        <span class="width-{{ $convert_persen }}percent"></span>
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    <span class="post-date date-comment">{{ date("d/m/Y H:i a", strtotime($comment->created_at)) }}</span>
                                                                                    @if (Session::get('customer_id') == $comment->customer_id)
                                                                                        <div class="option_comment">
                                                                                            <div class="dropdown_option_comment">
                                                                                                <i class="fa fa-ellipsis-h dot"></i>
                                                                                                <div class="dropdown_content_option_comment">
                                                                                                    <a class="btn_open_modal_delete_comment btn_delete_comment" style="cursor: pointer;" data-id="{{ $comment->comment_id }}">
                                                                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> xóa
                                                                                                    </a>
                                                                                                    <a style="cursor: pointer;" class="btn_update_comment" data-id="{{ $comment->comment_id }}">
                                                                                                        <i class="fa fa-pencil" aria-hidden="true"></i> sửa
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                {{-- </p> --}}
                                                                            </div>

                                                                            <p class="author place_order" style="margin-left: 70px"><i class="fa fa-check-circle" style="color: #7faf51"></i> đã mua tại <b class="brand_mku">MKU_FOOD</b></p>
                                                                            <p class="comment-text comment_message comment_message_{{ $comment->comment_id }}" style="font-size: 15px">{{ $comment->comment_message }}</p>
                                                                            <div class="content_area_update_comment content_area_update_comment_{{ $comment->comment_id }}">

                                                                            <textarea class="area_update_comment area_update_comment_{{ $comment->comment_id }}" style="padding: 2px 5px ">{{ $comment->comment_message }}</textarea>
                                                                            <div class="content_btn_update_comment">
                                                                                <button class="btn btn-secondary btn_huy_update_comment" data-id="{{ $comment->comment_id }}">Hủy</button>
                                                                                <button class="btn btn-success btn_confirm_update_comment" data-id="{{ $comment->comment_id }}">Sửa</button>
                                                                            </div>
                                                                            </div>

                                                                        </div>
                                                                        <div
                                                                            class="comment-review-form col-lg-3 col-lg-offset-1 col-md-3 col-sm-4 col-xs-12">
                                                                            <span class="title">Đánh giá này có hữu ích?</span>
                                                                            <ul class="actions">
                                                                                @php
                                                                                    $session = Session::get('user_like_comment_'.$comment->comment_id);
                                                                                @endphp
                                                                                @if (isset($session))
                                                                                    <li><a class="btn-act like btn_useful_comment btn_useful_comment_{{ $comment->comment_id }}" style="color: #7faf51; cursor: pointer;" data-id="{{ $comment->comment_id }}">
                                                                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                                                        <span class="txt_count_comment_useful_{{ $comment->comment_id }}">Hữu ích ({{ $comment->comment_useful }})</span>
                                                                                    </a></li>
                                                                                    <input type="hidden" class="hidden_check_comment_like_{{ $comment->comment_id }}" name="" id="" value="{{ $session }}">
                                                                                @else
                                                                                    <li><a class="btn-act like btn_useful_comment btn_useful_comment_{{ $comment->comment_id }}" style="cursor: pointer;" data-id="{{ $comment->comment_id }}">
                                                                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                                                        <span class="txt_count_comment_useful_{{ $comment->comment_id }}">Hữu ích ({{ $comment->comment_useful }})</span>
                                                                                    </a></li>
                                                                                    <input type="hidden" class="hidden_check_comment_like_{{ $comment->comment_id }}" name="" id="" value="{{ $session }}">
                                                                                @endif
                                                                                {{-- <li><a href="#" class="btn-act hate" data-type="dislike"><i
                                                                                            class="fa fa-thumbs-down" aria-hidden="true"></i>No
                                                                                        (20)</a></li>
                                                                                <li><a href="#" class="btn-act report" data-type="dislike"><i
                                                                                            class="fa fa-flag" aria-hidden="true"></i>Report</a>
                                                                                </li> --}}
                                                                            </ul>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <div class="center pd-20" style="font-size: 18px;padding-top: 30px; opacity: .5;">Sản phẩm chưa có đánh giá nào</div>
                                            @endif
                                        </ol>
                                        <input type="hidden" value="{{ $product->product_id }}" class="val_product_id">
                                        <input type="hidden" value="{{ count($all_comment_to_count) }}" class="all_comment_to_count">
                                        <input type="hidden" value="5" class="val_load_add_5">
                                        @if ($check_show > 0)
                                            <div class="biolife-panigations-block version-2">
                                                <ul class="panigation-contain">
                                                {{-- <li><span class="current-page">1</span></li>
                                                <li><a href="#" class="link-page">2</a></li>
                                                <li><a href="#" class="link-page">3</a></li>
                                                <li><span class="sep">....</span></li>
                                                <li><a href="#" class="link-page">20</a></li>
                                                <li><a href="#" class="link-page next"><i class="fa fa-angle-right"
                                                            aria-hidden="true"></i></a></li> --}}
                                                    {{-- {!! $all_comment->links() !!} --}}
                                                </ul>
                                                <div class="result-count">
                                                    {{-- <p class="txt-count"><b>1-5</b> of <b>126</b> reviews</p> --}}
                                                    <a class="link-to load_more_comment" style="cursor: pointer;">Xem Thêm<i class="fa fa-caret-right"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        @else
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- realative product --}}
            </div>
        </div>
    </div>
    <!-- The Modal Add Address Trans -->
    <div class="modal_delete_comment modal">
        <!-- Modal content -->
        <div class="modal-content container">
            <div class="modal-header-cus modal-header-delete_comment">
                <span class="close close_modal_delete_comment">&times;</span>
                <h4 style="padding: 10px">Thông Báo</h4>
            </div>
            <div class="modal-body-cus" style="background: #f8f8f8">
                    <form>
                        @csrf
                        <div class="">Bạn muốn xóa đánh giá này ?</div>
                        <input type="hidden" value="" class="val_hidden_comment_to_delete">
                    </form>
            </div>
            <div class="content-modal-footer-address">
                <button class="btn btn-success btn_confirm_delete_comment" style="margin-right: 10px">Xóa</button>
                <button class="btn btn-secondary btn_back_modal_address">Hủy</button>

            </div>
        </div>
    </div>
@endsection
