<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_sidebar_content.css') }}">
<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_address_account.css') }}">
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
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">

                    <!--sidebar-->
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <nav class="user">
                            <div class="user-heading">
                                <img src="{{ asset('public/upload/'.$customer_info->customer_avt) }}" alt="" class="user-img">
                                <span class="user-name">{{ $customer->username }}</span>
                            </div>
                            <ul class="user-list-module">
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/account') }}" class="user-module-item--link">Hồ sơ</a>
                                </li>
                                <li class="user-module-item user-module-item--active">
                                    <a href="{{ URL::to('user/address') }}" class="user-module-item--link">Địa chỉ</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/resetpassword') }}" class="user-module-item--link">Đổi mật khẩu</a>
                                </li>
                                <li class="user-module-item">
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
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="background-color: rgb(245, 245, 245); height:auto; margin-bottom: 32px;">
                        <div class="card-box-mb-30" style="margin-top: 8px">
                            @if($errors->any())
                                <div class="alert alert-danger alert-blog">{{ $errors->first() }}</div>
                            @endif
                        </div>
                        <div class="content__user-address">
                            <div class="content__user-address-heading">
                                <span class="user-heading-address-title">Địa chỉ của tôi</span>
                                <button class="btn-add-address lookup" data-toggle="modal"
                                data-target="#add_address_account"><span class="icon-copy ti-plus"></span> Thêm địa chỉ</button>
                            </div>

                            @foreach ($all_address as $address)
                                
                            
                            <div class="address-card">
                                <div class="address-dislay__left">
                                    <div class="address-display__field-container">
                                        <div class="address-display__field-label">Họ và Tên</div>
                                        <div class="address-display__field-content">
                                            <span class="address-display__name-text">
                                                {{ $address->trans_fullname }}
                                            </span>
                                            @if ($address->trans_status == 1)
                                                <div class="address-default">Mặc Định</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="address-display__field-container">
                                        <div class="address-display__field-label">Số điện thoại</div>
                                        <div class="address-display__field-content">
                                            {{ $address->trans_phone }}
                                        </div>
                                    </div>

                                    <div class="address-display__field-container">
                                        <div class="address-display__field-label">Địa chỉ</div>
                                        <div class="address-display__field-content">
                                            <span>{{ $address->trans_address }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="address-display__button">
                                    <div class="address-display__button-group">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <span  class="address-btn-action update_address" data-id = {{ $address->trans_id }} data-toggle="modal"
                                        data-target="#update_address_account">Sửa</span>
                                        @if ($address->trans_status == 0)
                                            <span class="address-btn-action delete_address" data-id = {{ $address->trans_id }} data-toggle="modal"
                                                data-target="#delete_address_account">Xóa</span>
                                        @endif
                                    </div>
                                    <div class="address-display__button-group">
                                        @if($address->trans_status == 1)
                                            <button class="address-btn-action-primary--disable">Thiết Lập Mặc Định</button>
                                        @else
                                            <form action="{{ URL::to('process_mode_default') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="trans_id" value="{{ $address->trans_id }}">
                                                <button type="submit" class="address-btn-action-primary" style="color: black;">Thiết Lập Mặc Định</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
