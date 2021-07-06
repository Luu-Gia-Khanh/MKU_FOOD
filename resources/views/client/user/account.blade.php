<link rel="stylesheet" href="{{ asset('public/font_end/custom_account/user_sidebar_content.css') }}">
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
                                <li class="user-module-item user-module-item--active">
                                    <a href="{{ URL::to('user/account') }}" class="user-module-item--link">Hồ sơ</a>
                                </li>
                                <li class="user-module-item">
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
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="background-color: rgb(245, 245, 245); height:530px; margin-bottom: 32px;">
                        <div class="content__user">
                            <div class="content__user-heading">
                                <span class="user-heading-title">Thông tin cá nhân</span>
                            </div>
                            <form action="{{ URL::to('update_account/'.$customer->customer_id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="content__user-profile">
                                    <div class="user-profile">
                                        <div class="user-profile-name">
                                            <span >Tên đăng nhập</span>
                                            <label>{{ $customer->username }}</label>
                                        </div>
                                        <div class="user-profile-fullname">
                                            <span>Họ và Tên</span>
                                            <input class="custom-input-user upper_val" type="text" name="customer_fullname" value="{{ $customer_info->customer_fullname }}"
                                            onblur="return upberFirstKey()" style="padding: 7px 8px;">
                                        </div>
                                        @if ($errors->has('customer_fullname'))
                                            <div style="margin-left: 132px; color: #dc3545;">
                                                {{ $errors->first('customer_fullname') }}
                                            </div>
                                        @endif
                                        <div class="user-profile-email">
                                            <span>Email</span>
                                            <input class="custom-input-user" type="text" name="email" value="{{ $customer->email }}" readonly style="padding: 7px 8px;">
                                        </div>
                                        <div class="user-profile-phone">
                                            <span>Số điện thoại</span>
                                            <input class="custom-input-user" type="text" name="customer_phone" value="{{ $customer_info->customer_phone }}" style="padding: 7px 8px;">
                                        </div>
                                        @if ($errors->has('customer_phone'))
                                            <div style="margin-left: 132px; color: #dc3545;">
                                                {{ $errors->first('customer_phone') }}
                                            </div>
                                        @endif
                                        <div class="user-profile-gender">
                                            <span>Giới tính</span>
                                            <div class="radio-gender">
                                                <input class="gender_checked" type="radio" name="customer_gender"
                                                @if($customer_info->customer_gender == 'Nam')
                                                    checked="checked"
                                                @endif
                                                value="Nam">
                                                <label for="html">Nam</label><br>
                                            </div>
                                            <div class="radio-gender">
                                                <input type="radio" name="customer_gender"
                                                @if($customer_info->customer_gender == 'Nu')
                                                    checked="checked"
                                                @endif
                                                value="Nu">
                                                <label for="css">Nữ</label><br>
                                            </div>
                                            <div class="radio-gender">
                                                <input type="radio" name="customer_gender"
                                                @if($customer_info->customer_gender == 'Khac')
                                                    checked="checked"
                                                @endif
                                                value="Khac">
                                                <label for="javascript">Khác</label>
                                            </div>
                                        </div>
                                        <div class="user-profile-phone">
                                            <span>Ngày sinh</span>
                                            <input class="custom-input-user" type="date" name="customer_birthday" value="{{ $customer_info->customer_birthday }}" style="padding: 7px 8px;">
                                        </div>
                                        @if (session('check_update_birthday'))
                                            <div style="margin-left: 132px; color: #dc3545;">
                                                {{ session('check_update_birthday') }}
                                            </div>
                                        @endif
                                        <button type="submit" class="btn-update-user">Lưu</button>
                                    </div>
                                    <div class="user-upload-img">
                                        <div id="content_image_upload">
                                            <img src="{{ asset('public/upload/'.$customer_info->customer_avt) }}" class="img-upload" alt="hình ảnh" id="image_upload">
                                        </div>
                                        <div class="input-upload-img">
                                            <input type="file" name="customer_avt" id="file_upload"
                                                onchange="return uploadhinh()" class="custom-file-input" style="width: 220px;">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
