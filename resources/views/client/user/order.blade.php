<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_sidebar_content.css') }}">
@extends('client.layout_account_client')
@section('content_body')
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
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="background-color: rgb(245, 245, 245); display: flex; margin-bottom: 32px;">
                        <div class="content__user">
                            <div class="tabs">
                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab1" checked>
                                <label for="tab1" class="tabs__label">Tất cả</label>
                                <div class="tabs__content">
                                    <div class="tab__content-item">
                                        <div class="heading-item">
                                            <span class="heading-item-status">ĐÃ GIAO</span>
                                        </div>
                                        {{-- <ul class="content-item-list">
                                            <li class="content-item">
                                                <a href="#" class="content-item-link">
                                                    <img src="https://vn-test-11.slatic.net/p/fd262b92dc65ac8e0fd82b9fa1f8a913.png_200x200q90.jpg_.webp" alt="" class="content-item-img">
                                                    <div class="content-item-info">
                                                        <span class="content-item-name">Máy Lạnh Daikin Inverter FTKA35VAVMV 1.5HP (12000BTU) - Tiết kiệm điện</span>
                                                        <span class="content-item-quantity">
                                                            Số lượng x 3
                                                        </span>
                                                        <div class="content-item-price">3000.300</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul> --}}

                                        <ul class="content-item-list">
                                            <a href="#" class="content-item-link">
                                                <li class="content-item">
                                                    <img src="https://vn-test-11.slatic.net/p/fd262b92dc65ac8e0fd82b9fa1f8a913.png_200x200q90.jpg_.webp" alt="" class="content-item-img">
                                                    <div class="content-item-info">
                                                        <div class="content-item-head">
                                                            <h5 class="content-item-name">Máy Lạnh Daikin Inverter FTKA35VAVMV 1.5HP (12000BTU) - Tiết kiệm điệnt</h5>
                                                            <div class="content-item-price-wrap">
                                                                <span class="content-item-price">2.000.000đ</span>
                                                            </div>
                                                        </div>
                                                        <div class="content-item-body">
                                                            <span class="content-item-quantity">Số lượng x 3</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                            <a href="#" class="content-item-link">
                                                <li class="content-item">
                                                    <img src="https://vn-test-11.slatic.net/p/fd262b92dc65ac8e0fd82b9fa1f8a913.png_200x200q90.jpg_.webp" alt="" class="content-item-img">
                                                    <div class="content-item-info">
                                                        <div class="content-item-head">
                                                            <h5 class="content-item-name">Bộ kem đặc trị vùng mắt</h5>
                                                            <div class="content-item-price-wrap">
                                                                <span class="content-item-price">2.000.000đ</span>
                                                            </div>
                                                        </div>
                                                        <div class="content-item-body">
                                                            <span class="content-item-quantity">Số lượng x 3</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                        </ul>
                                        <footer class="content-item-footer">
                                            <span class="content-item-total">Tổng tiền: 123.000đ</span>
                                        </footer>
                                    </div>

                                    <div class="tab__content-item">
                                        <div class="heading-item">
                                            <span class="heading-item-status">ĐÃ HỦY</span>
                                        </div>
                                        <ul class="content-item-list">
                                            <a href="#" class="content-item-link">
                                                <li class="content-item">
                                                    <img src="https://vn-test-11.slatic.net/p/fd262b92dc65ac8e0fd82b9fa1f8a913.png_200x200q90.jpg_.webp" alt="" class="content-item-img">
                                                    <div class="content-item-info">
                                                        <div class="content-item-head">
                                                            <h5 class="content-item-name">Bộ kem đặc trị vùng mắt</h5>
                                                            <div class="content-item-price-wrap">
                                                                <span class="content-item-price">2.000.000đ</span>
                                                            </div>
                                                        </div>
                                                        <div class="content-item-body">
                                                            <span class="content-item-quantity">Số lượng x 3</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                            <a href="#" class="content-item-link">
                                                <li class="content-item">
                                                    <img src="https://vn-test-11.slatic.net/p/fd262b92dc65ac8e0fd82b9fa1f8a913.png_200x200q90.jpg_.webp" alt="" class="content-item-img">
                                                    <div class="content-item-info">
                                                        <div class="content-item-head">
                                                            <h5 class="content-item-name">Bộ kem đặc trị vùng mắt</h5>
                                                            <div class="content-item-price-wrap">
                                                                <span class="content-item-price">2.000.000đ</span>
                                                            </div>
                                                        </div>
                                                        <div class="content-item-body">
                                                            <span class="content-item-quantity">Số lượng x 3</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                        </ul>
                                        <footer class="content-item-footer">
                                            <span class="content-item-total">Tổng tiền: 123.000đ</span>
                                        </footer>
                                    </div>
                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab2">
                                <label for="tab2" class="tabs__label">Chờ xác nhận</label>
                                <div class="tabs__content">
                                  CONTENT for Tab #2
                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab3">
                                <label for="tab3" class="tabs__label">Đang giao</label>
                                <div class="tabs__content">
                                    <div class="tab__content-item">
                                        <div class="heading-item">
                                            <span class="heading-item-status">ĐÃ HỦY</span>
                                        </div>
                                        <ul class="content-item-list">
                                            <a href="#" class="content-item-link">
                                                <li class="content-item">
                                                    <img src="https://vn-test-11.slatic.net/p/fd262b92dc65ac8e0fd82b9fa1f8a913.png_200x200q90.jpg_.webp" alt="" class="content-item-img">
                                                    <div class="content-item-info">
                                                        <div class="content-item-head">
                                                            <h5 class="content-item-name">Bộ kem đặc trị vùng mắt</h5>
                                                            <div class="content-item-price-wrap">
                                                                <span class="content-item-price">2.000.000đ</span>
                                                            </div>
                                                        </div>
                                                        <div class="content-item-body">
                                                            <span class="content-item-quantity">Số lượng x 3</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                            <a href="#" class="content-item-link">
                                                <li class="content-item">
                                                    <img src="https://vn-test-11.slatic.net/p/fd262b92dc65ac8e0fd82b9fa1f8a913.png_200x200q90.jpg_.webp" alt="" class="content-item-img">
                                                    <div class="content-item-info">
                                                        <div class="content-item-head">
                                                            <h5 class="content-item-name">Bộ kem đặc trị vùng mắt</h5>
                                                            <div class="content-item-price-wrap">
                                                                <span class="content-item-price">2.000.000đ</span>
                                                            </div>
                                                        </div>
                                                        <div class="content-item-body">
                                                            <span class="content-item-quantity">Số lượng x 3</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                        </ul>
                                        <footer class="content-item-footer">
                                            <span class="content-item-total">Tổng tiền: 123.000đ</span>
                                        </footer>
                                    </div>
                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab4">
                                <label for="tab4" class="tabs__label">Đã giao</label>
                                <div class="tabs__content">
                                  CONTENT for Tab #4
                                </div>

                                <input type="radio" class="tabs__radio" name="tabs-example" id="tab5">
                                <label for="tab5" class="tabs__label">Đã hủy</label>
                                <div class="tabs__content">
                                  CONTENT for Tab #5
                                </div>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
