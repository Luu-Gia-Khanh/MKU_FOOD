<div class="header-top bg-main hidden-xs">
    <div class="container">
        <div class="top-bar left">
            <ul class="horizontal-menu">
                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Organic@company.com</a></li>
                <li><a href="#">Free Shipping for all Order of $99</a></li>
            </ul>
        </div>
        <div class="top-bar right">
            <ul class="social-list">
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            </ul>
            <ul class="horizontal-menu">
                <li class="horz-menu-item lang">
                    <select name="language">
                        <option value="fr">French (EUR)</option>
                        <option value="en" selected>English (USD)</option>
                        <option value="ger">Germany (GBP)</option>
                        <option value="jp">Japan (JPY)</option>
                    </select>
                </li>
                <li>
                    @if(Session::get('customer_id'))
                        <a href="#"><i class="biolife-icon icon-login"></i> {{ Session::get('username') }}</a>
                    @else
                        <a href="{{ URL::to('login_client') }}" class="login-link"><i class="biolife-icon icon-login"></i>Đăng nhập/</a>
                        <a href="{{ URL::to('register_client') }}" class="login-link">Đăng ký</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
