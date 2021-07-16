<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_sidebar_content.css') }}">
@extends('client.layout_account_client')
@section('content_body')
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
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{ URL::to('/') }}" class="permal-link">Trang chủ</a></li>
                <li class="nav-item"><a href="{{ URL::to('user/account') }}" class="permal-link">Tài khoản</a></li>
                <li class="nav-item"><span class="current-page">Đơn hàng</span></li>
            </ul>
        </nav>
    </div>
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">

                    <!--sidebar-->
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <nav class="user">
                            <div class="user-heading">
                                @if(Session::get('customer_id'))
                                <img src="{{ asset('public/upload/'.$customer_info->customer_avt) }}" alt="" class="user-img">
                                @else
                                    <img src="{{ asset('public/upload/no_image.png') }}" alt="" class="user-img">
                                @endif

                                @if(Session::get('customer_id'))
                                    <span class="user-name">{{ $customer->username }}</span>
                                @else
                                    <span class="user-name">Unknown</span>
                                @endif
                            </div>
                            <ul class="user-list-module">
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/account') }}" class="user-module-item--link">Hồ sơ</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/address') }}" class="user-module-item--link">Địa chỉ</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/resetpassword') }}" class="user-module-item--link">Đổi mật khẩu</a>
                                </li>
                                <li class="user-module-item user-module-item--active">
                                    <a href="{{ URL::to('user/order') }}" class="user-module-item--link">Đơn mua</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="#" class="user-module-item--link">Thông báo</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="#" class="user-module-item--link">Kho Voucher</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!--content-user-->
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="display: flex; margin-bottom: 32px;">
                        <div class="content__user-order">
                            <div class="tabs">
                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab1" checked>
                                <label for="tab1" class="tabs__label">Tất cả</label>
                                <div class="tabs__content">


                                    @if(count($all_order) > 0)

                                        @foreach ($all_order as $order)

                                        <div class="tab__content-item">
                                                <div class="heading-item">
                                                    @foreach ($all_order_detail_status as $status_order_detail)
                                                        @if ($status_order_detail->order_id == $order->order_id)
                                                            @foreach ($status_order as $status)
                                                                @if ($status->status_id == $status_order_detail->status_id  && $status_order_detail->status == 1)
                                                                    <span class="heading-item-status">{{ $status->status_name }}</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>

                                                <ul class="content-item-list">

                                                    @foreach ($all_order_item as $order_item)
                                                        @if ($order_item->order_id == $order->order_id)

                                                        <a href="#" class="content-item-link">
                                                            <li class="content-item">
                                                                @foreach ($all_product as $product)
                                                                    @if ($product->product_id == $order_item->product_id)
                                                                        <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" class="content-item-img">
                                                                    @endif
                                                                @endforeach
                                                                <div class="content-item-info">
                                                                    <div class="content-item-head">
                                                                        @foreach ($all_product as $product)
                                                                            @if ($order_item->product_id == $product->product_id)
                                                                                <h5 class="content-item-name">{{ $product->product_name }}</h5>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="content-item-price-wrap">
                                                                            <span class="content-item-price">{{ number_format($order_item->quantity_product * $order_item->price_product, 0,'','.') }}đ</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="content-item-body">
                                                                        <span class="content-item-quantity">Số lượng x {{ $order_item->quantity_product }}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </a>

                                                        @endif
                                                    @endforeach

                                                </ul>
                                                <footer class="content-item-footer">
                                                    <span class="content-item-total">Tổng tiền: {{ number_format($order->total_price, 0,'.',',') }}đ</span>
                                                </footer>
                                                <footer class="content-btn-footer">
                                                    <a href="{{ URL::to('user/order/'.$order->order_id) }}" class="item-btn-footer-primary">Xem chi tiết đơn hàng</a>
                                                    <a href="#" class="item-btn-footer">Xem đánh giá</a>
                                                </footer>
                                            </div>

                                        @endforeach

                                    @else

                                        <div class="tab__content-item">
                                            <div class="content-item-empty">
                                                <img src="{{ asset('public/upload/empty.png') }}" width="200" height="200" alt="">
                                                <span class="content-item-empty-text">Hiện không có đơn hàng nào đang chờ xác nhận</span>
                                            </div>
                                        </div>

                                    @endif

                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab2">
                                <label for="tab2" class="tabs__label">Chờ xác nhận</label>
                                <div class="tabs__content">

                                    @if (count($status_order_confirm) > 0)

                                        @foreach ($all_order as $order)
                                            @foreach ($status_order_confirm as $status_order_detail)
                                                @if ($status_order_detail->status_id == 1 && $status_order_detail->order_id == $order->order_id)
                                                    <div class="tab__content-item">
                                                        <div class="heading-item">
                                                                @foreach ($status_order as $status)
                                                                    @if ($status->status_id == 1)
                                                                        <span class="heading-item-status">{{ $status->status_name }}</span>
                                                                    @endif
                                                                @endforeach
                                                        </div>

                                                        <ul class="content-item-list">

                                                            @foreach ($all_order_item as $order_item)
                                                                @if ($order_item->order_id == $order->order_id)

                                                                <a href="#" class="content-item-link">
                                                                    <li class="content-item">
                                                                        @foreach ($all_product as $product)
                                                                            @if ($product->product_id == $order_item->product_id)
                                                                                <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" class="content-item-img">
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="content-item-info">
                                                                            <div class="content-item-head">
                                                                                @foreach ($all_product as $product)
                                                                                    @if ($order_item->product_id == $product->product_id)
                                                                                        <h5 class="content-item-name">{{ $product->product_name }}</h5>
                                                                                    @endif
                                                                                @endforeach

                                                                                <div class="content-item-price-wrap">
                                                                                    <span class="content-item-price">{{ number_format($order_item->quantity_product * $order_item->price_product, 0,'',',') }}đ</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="content-item-body">
                                                                                <span class="content-item-quantity">Số lượng x {{ $order_item->quantity_product }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </a>

                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                        <footer class="content-item-footer">
                                                            <span class="content-item-total">Tổng tiền: {{ number_format($order->total_price, 0,'.',',') }}đ</span>
                                                        </footer>
                                                        <footer class="content-btn-footer">
                                                            <a href="{{ URL::to('user/order/'.$order->order_id) }}" class="item-btn-footer-primary">Xem chi tiết đơn hàng</a>
                                                            <a href="#" class="item-btn-footer">Xem đánh giá</a>
                                                        </footer>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    @else
                                        <div class="tab__content-item">
                                            <div class="content-item-empty">
                                                <img src="{{ asset('public/upload/empty.png') }}" width="200" height="200" alt="">
                                                <span class="content-item-empty-text">Hiện không có đơn hàng nào đang chờ xác nhận</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab3">
                                <label for="tab3" class="tabs__label">Đã xác nhận</label>
                                <div class="tabs__content">

                                    @if (count($status_order_confirmed) > 0)

                                        @foreach ($all_order as $order)
                                            @foreach ($status_order_confirmed as $status_order_detail)
                                                @if ($status_order_detail->status_id == 2 && $status_order_detail->order_id == $order->order_id)
                                                    <div class="tab__content-item">
                                                        <div class="heading-item">
                                                                @foreach ($status_order as $status)
                                                                    @if ($status->status_id == 2)
                                                                        <span class="heading-item-status">{{ $status->status_name }}</span>
                                                                    @endif
                                                                @endforeach
                                                        </div>

                                                        <ul class="content-item-list">

                                                            @foreach ($all_order_item as $order_item)
                                                                @if ($order_item->order_id == $order->order_id)

                                                                <a href="#" class="content-item-link">
                                                                    <li class="content-item">
                                                                        @foreach ($all_product as $product)
                                                                            @if ($product->product_id == $order_item->product_id)
                                                                                <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" class="content-item-img">
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="content-item-info">
                                                                            <div class="content-item-head">
                                                                                @foreach ($all_product as $product)
                                                                                    @if ($order_item->product_id == $product->product_id)
                                                                                        <h5 class="content-item-name">{{ $product->product_name }}</h5>
                                                                                    @endif
                                                                                @endforeach

                                                                                <div class="content-item-price-wrap">
                                                                                    <span class="content-item-price">{{ number_format($order_item->quantity_product * $order_item->price_product, 0,'',',') }}đ</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="content-item-body">
                                                                                <span class="content-item-quantity">Số lượng x {{ $order_item->quantity_product }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </a>

                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                        <footer class="content-item-footer">
                                                            <span class="content-item-total">Tổng tiền: {{ number_format($order->total_price, 0,'.',',') }}đ</span>
                                                        </footer>
                                                        <footer class="content-btn-footer">
                                                            <a href="{{ URL::to('user/order/'.$order->order_id) }}" class="item-btn-footer-primary">Xem chi tiết đơn hàng</a>
                                                            <a href="#" class="item-btn-footer">Xem đánh giá</a>
                                                        </footer>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    @else
                                        <div class="tab__content-item">
                                            <div class="content-item-empty">
                                                <img src="{{ asset('public/upload/empty.png') }}" width="200" height="200" alt="">
                                                <span class="content-item-empty-text">Hiện không có đơn hàng nào đang chờ xác nhận</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab4">
                                <label for="tab4" class="tabs__label">Đang giao</label>
                                <div class="tabs__content">

                                    @if (count($status_order_delivering) > 0)

                                        @foreach ($all_order as $order)
                                            @foreach ($status_order_delivering as $status_order_detail)
                                                @if ($status_order_detail->status_id == 3 && $status_order_detail->order_id == $order->order_id)
                                                    <div class="tab__content-item">
                                                        <div class="heading-item">
                                                                @foreach ($status_order as $status)
                                                                    @if ($status->status_id == 3)
                                                                        <span class="heading-item-status">{{ $status->status_name }}</span>
                                                                    @endif
                                                                @endforeach
                                                        </div>

                                                        <ul class="content-item-list">

                                                            @foreach ($all_order_item as $order_item)
                                                                @if ($order_item->order_id == $order->order_id)

                                                                <a href="#" class="content-item-link">
                                                                    <li class="content-item">
                                                                        @foreach ($all_product as $product)
                                                                            @if ($product->product_id == $order_item->product_id)
                                                                                <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" class="content-item-img">
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="content-item-info">
                                                                            <div class="content-item-head">
                                                                                @foreach ($all_product as $product)
                                                                                    @if ($order_item->product_id == $product->product_id)
                                                                                        <h5 class="content-item-name">{{ $product->product_name }}</h5>
                                                                                    @endif
                                                                                @endforeach

                                                                                <div class="content-item-price-wrap">
                                                                                    <span class="content-item-price">{{ number_format($order_item->quantity_product * $order_item->price_product, 0,'',',') }}đ</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="content-item-body">
                                                                                <span class="content-item-quantity">Số lượng x {{ $order_item->quantity_product }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </a>

                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                        <footer class="content-item-footer">
                                                            <span class="content-item-total">Tổng tiền: {{ number_format($order->total_price, 0,'.',',') }}đ</span>
                                                        </footer>
                                                        <footer class="content-btn-footer">
                                                            <a href="{{ URL::to('user/order/'.$order->order_id) }}" class="item-btn-footer-primary">Xem chi tiết đơn hàng</a>
                                                            <a href="#" class="item-btn-footer">Xem đánh giá</a>
                                                        </footer>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    @else
                                        <div class="tab__content-item">
                                            <div class="content-item-empty">
                                                <img src="{{ asset('public/upload/empty.png') }}" width="200" height="200" alt="">
                                                <span class="content-item-empty-text">Hiện không có đơn hàng nào đang chờ xác nhận</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab5">
                                <label for="tab5" class="tabs__label">Đã giao</label>
                                <div class="tabs__content">

                                    @if (count($status_order_delivered) > 0)

                                        @foreach ($all_order as $order)
                                            @foreach ($status_order_delivered as $status_order_detail)
                                                @if ($status_order_detail->status_id == 4 && $status_order_detail->order_id == $order->order_id)
                                                    <div class="tab__content-item">
                                                        <div class="heading-item">
                                                                @foreach ($status_order as $status)
                                                                    @if ($status->status_id == 4)
                                                                        <span class="heading-item-status">{{ $status->status_name }}</span>
                                                                    @endif
                                                                @endforeach
                                                        </div>

                                                        <ul class="content-item-list">

                                                            @foreach ($all_order_item as $order_item)
                                                                @if ($order_item->order_id == $order->order_id)

                                                                <a href="#" class="content-item-link">
                                                                    <li class="content-item">
                                                                        @foreach ($all_product as $product)
                                                                            @if ($product->product_id == $order_item->product_id)
                                                                                <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" class="content-item-img">
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="content-item-info">
                                                                            <div class="content-item-head">
                                                                                @foreach ($all_product as $product)
                                                                                    @if ($order_item->product_id == $product->product_id)
                                                                                        <h5 class="content-item-name">{{ $product->product_name }}</h5>
                                                                                    @endif
                                                                                @endforeach

                                                                                <div class="content-item-price-wrap">
                                                                                    <span class="content-item-price">{{ number_format($order_item->quantity_product * $order_item->price_product, 0,'',',') }}đ</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="content-item-body">
                                                                                <span class="content-item-quantity">Số lượng x {{ $order_item->quantity_product }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </a>

                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                        <footer class="content-item-footer">
                                                            <span class="content-item-total">Tổng tiền: {{ number_format($order->total_price, 0,'.',',') }}đ</span>
                                                        </footer>
                                                        <footer class="content-btn-footer">
                                                            <a href="{{ URL::to('user/order/'.$order->order_id) }}" class="item-btn-footer-primary">Xem chi tiết đơn hàng</a>
                                                            <a href="#" class="item-btn-footer">Xem đánh giá</a>
                                                        </footer>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    @else
                                        <div class="tab__content-item">
                                            <div class="content-item-empty">
                                                <img src="{{ asset('public/upload/empty.png') }}" width="200" height="200" alt="">
                                                <span class="content-item-empty-text">Hiện không có đơn hàng nào đang chờ xác nhận</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab6">
                                <label for="tab6" class="tabs__label">Đã hủy</label>
                                <div class="tabs__content">

                                    @if (count($status_order_cancelled) > 0)

                                        @foreach ($all_order as $order)
                                            @foreach ($status_order_cancelled as $status_order_detail)
                                                @if ($status_order_detail->status_id == 5 && $status_order_detail->order_id == $order->order_id)
                                                    <div class="tab__content-item">
                                                        <div class="heading-item">
                                                                @foreach ($status_order as $status)
                                                                    @if ($status->status_id == 5)
                                                                        <span class="heading-item-status">{{ $status->status_name }}</span>
                                                                    @endif
                                                                @endforeach
                                                        </div>

                                                        <ul class="content-item-list">

                                                            @foreach ($all_order_item as $order_item)
                                                                @if ($order_item->order_id == $order->order_id)

                                                                <a href="#" class="content-item-link">
                                                                    <li class="content-item">
                                                                        @foreach ($all_product as $product)
                                                                            @if ($product->product_id == $order_item->product_id)
                                                                                <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" class="content-item-img">
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="content-item-info">
                                                                            <div class="content-item-head">
                                                                                @foreach ($all_product as $product)
                                                                                    @if ($order_item->product_id == $product->product_id)
                                                                                        <h5 class="content-item-name">{{ $product->product_name }}</h5>
                                                                                    @endif
                                                                                @endforeach

                                                                                <div class="content-item-price-wrap">
                                                                                    <span class="content-item-price">{{ number_format($order_item->quantity_product * $order_item->price_product, 0,'',',') }}đ</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="content-item-body">
                                                                                <span class="content-item-quantity">Số lượng x {{ $order_item->quantity_product }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </a>

                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                        <footer class="content-item-footer">
                                                            <span class="content-item-total">Tổng tiền: {{ number_format($order->total_price, 0,'.',',') }}đ</span>
                                                        </footer>
                                                        <footer class="content-btn-footer">
                                                            <a href="{{ URL::to('user/order/'.$order->order_id) }}" class="item-btn-footer-primary">Xem chi tiết đơn hàng</a>
                                                            <a href="#" class="item-btn-footer">Xem đánh giá</a>
                                                        </footer>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    @else
                                        <div class="tab__content-item">
                                            <div class="content-item-empty">
                                                <img src="{{ asset('public/upload/empty.png') }}" width="200" height="200" alt="">
                                                <span class="content-item-empty-text">Hiện không có đơn hàng nào đang chờ xác nhận</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
