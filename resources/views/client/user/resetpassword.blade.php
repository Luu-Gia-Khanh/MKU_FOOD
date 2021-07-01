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
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/account') }}" class="user-module-item--link">Hồ sơ</a>
                                </li>
                                <li class="user-module-item">
                                    <a href="{{ URL::to('user/address') }}" class="user-module-item--link">Địa chỉ</a>
                                </li>
                                <li class="user-module-item user-module-item--active">
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
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="background-color: rgb(245, 245, 245);">
                        <div class="content__user">
                            <div class="content__user-heading">
                                <span class="user-heading-title">Đổi mật khẩu</span>
                            </div>
                            <form action="">
                                <div class="content__user-resetpassword">
                                    <div class="user-password">
                                        <span>Mật khẩu hiện tại</span>
                                        <input class="custom-input-user" type="password" name="fname" value="">
                                    </div>
                                    <div class="forget-password">
                                        <a href="#">Quên mật khẩu?</a>
                                    </div>
                                    <div class="user-password">
                                        <span>Mật khẩu mới</span>
                                        <input class="custom-input-user" type="password" name="fname" value="" readonly>
                                    </div>
                                    <div class="user-password">
                                        <span>Xác nhận mật khẩu</span>
                                        <input class="custom-input-user" type="password" name="fname" value="">
                                    </div>
                                    <button type="submit" class="btn-update-user">Xác Nhận</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection