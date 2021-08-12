<div class="header-top bg-main hidden-xs">
    <div class="container">
        <div class="top-bar left">
            <ul class="horizontal-menu">
                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Organic@company.com</a></li>
                <li><a href="#">Free Shipping for all Order of $99</a></li>
            </ul>
        </div>
        <div class="top-bar right" style="display: flex;">
            <ul class="social-list" style=" align-items: center; display: flex;">
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            </ul>
            <ul class="horizontal-menu">
                {{-- <li class="horz-menu-item lang">
                    <select name="language">
                        <option value="fr">French (EUR)</option>
                        <option value="en" selected>English (USD)</option>
                        <option value="ger">Germany (GBP)</option>
                        <option value="jp">Japan (JPY)</option>
                    </select>
                </li> --}}
                {{-- <li>
                    @if(Session::get('customer_id'))
                        <a href="#"><i class="biolife-icon icon-login"></i> {{ Session::get('username') }}</a>
                    @else
                        <a href="{{ URL::to('login_client') }}" class="login-link"><i class="biolife-icon icon-login"></i>Đăng nhập/</a>
                        <a href="{{ URL::to('register_client') }}" class="login-link">Đăng ký</a>
                    @endif
                </li> --}}
                @if (Session::get('customer_id'))
                    <li class="header__navbar-user">
                        <img src="{{ asset('public/upload/'.Session::get('customer_avt')) }}" alt="" class="header__navbar-user-img">
                        <span class="header__navbar-user-name">{{ Session::get('username') }}</span>
                        <ul class="header__navbar-user-menu" style="z-index: 100;">
                            <li class="header__navbar-user-item">
                                <a href="{{ URL::to('user/account') }}">Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="{{ URL::to('user/order') }}">Đơn hàng</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="{{ URL::to('logout_client') }}">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ URL::to('login_client') }}" class="login-link"><i class="biolife-icon icon-login"></i>Đăng nhập/</a>
                        <a href="{{ URL::to('register_client') }}" class="login-link">Đăng ký</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
