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
                                <img src="{{ asset('public/upload/avatar74.png') }}" alt="" class="user-img">
                                <span class="user-name">Phan Hoài Kha</span>
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
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="background-color: rgb(245, 245, 245); height:500px; display: flex;">
                        <div class="content__user">
                            <div class="content__user-heading">
                                <span class="user-heading-title">Thông tin cá nhân</span>
                            </div>
                            <form>
                                <div class="content__user-profile">
                                    <div class="user-profile">
                                        <div class="user-profile-name">
                                            <span >Tên đăng nhập</span>
                                            <label>Phan Hoài Kha</label>
                                        </div>
                                        <div class="user-profile-fullname">
                                            <span>Họ và Tên</span>
                                            <input class="custom-input-user" type="text" name="fname" value="Phan Hoài Kha">
                                        </div>
                                        <div class="user-profile-email">
                                            <span>Email</span>
                                            <input class="custom-input-user" type="text" name="fname" value="khaphan@gmail.com" readonly>
                                        </div>
                                        <div class="user-profile-phone">
                                            <span>Số điện thoại</span>
                                            <input class="custom-input-user" type="text" name="fname" value="0911635153">
                                        </div>
                                        <div class="user-profile-gender">
                                            <span>Giới tính</span>
                                            <div class="radio-gender">
                                                <input type="radio" name="fav_language" value="1">
                                                <label for="html">Nam</label><br>
                                            </div>
                                            <div class="radio-gender">
                                                <input type="radio" name="fav_language" value="2">
                                                <label for="css">Nữ</label><br>
                                            </div>
                                            <div class="radio-gender">
                                                <input type="radio" name="fav_language" value="3">
                                                <label for="javascript">Khác</label> 
                                            </div>
                                        </div>
                                        <div class="user-profile-phone">
                                            <span>Ngày sinh</span>
                                            <input class="custom-input-user" type="date" name="fname" value="11/14/2000">
                                        </div>
                                        <button type="submit" class="btn-update-user">Lưu</button>
                                    </div>
                                    <div class="user-upload-img">
                                        <div id="content_image_upload op-0">
                                            <img src="{{ asset('public/upload/default_image64.png') }}" class="op-0 img-upload" alt="hình ảnh" id="image_upload">
                                        </div>
                                        <div class="input-upload-img">
                                            <input type="file" name="cate_image" id="file_upload"
                                                onchange="return uploadhinh()" class="custom-file-input">
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