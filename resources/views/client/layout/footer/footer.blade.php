<footer id="footer" class="footer layout-03">
    <div class="footer-content background-footer-03" style="background: white">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-md-5 col-sm-6 md-margin-top-5px sm-margin-top-50px xs-margin-top-40px">
                    <section class="footer-item">
                        <h3 class="section-title">Liên Hệ Chúng Tôi</h3>
                        <div class="contact-info-block footer-layout xs-padding-top-10px">
                            <ul class="contact-lines">
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-location"></i>
                                        <b class="desc">Quốc Lộ 1A, Huyện Long Hồ, Phú Quới, Long Hồ, Vĩnh Long</b>
                                    </p>
                                </li>
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-phone"></i>
                                        <b class="desc">Phone: 0270 3831 155</b>
                                    </p>
                                </li>
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-letter"></i>
                                        <b class="desc">Email: mkufood@mku.edu.vn</b>
                                    </p>
                                </li>
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-clock"></i>
                                        <b class="desc">Làm Việc 24/7</b>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="biolife-social inline">
                            <ul class="socials">
                                <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </section>
                </div>
                <div class="col-lg-1" >
                    <div class="line_footer" style="width: 1px; background-color:#0a0a0a; height: 250px">

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 md-margin-top-5px sm-margin-top-50px xs-margin-top-40px">
                    <section class="footer-item">
                        <div class="section-title">
                            <section class="footer-item">
                                <a href="{{ URL::to('/') }}" class="logo footer-logo">
                                    <img src="{{ asset('public/upload/logo_mku_10.svg') }}" alt="logo" width="135" height="36">
                                </a>
                            </section>
                        </div>
                        <div class="row" style="padding-left: 50px">
                            <div class="wrap-custom-menu vertical-menu-2">
                                <ul class="menu">
                                    <li><a href="#">&#187 Trang Chủ</a></li>
                                    <li><a href="#">&#187 Cửa Hàng</a></li>
                                    <li><a href="#">&#187 Liên Hệ</a></li>
                                    <li><a href="#">&#187 Chính Sách Và Điều Khoảng</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="row">
                                <div class="payment-methods">
                                    <ul>
                                        <li><a href="#" class="payment-link"><img src="{{ asset('public/font_end/assets/images/card1.jpg') }}" width="51" height="36" alt=""></a></li>
                                        <li><a href="#" class="payment-link"><img src="{{ asset('public/font_end/assets/images/card2.jpg') }}" width="51" height="36" alt=""></a></li>
                                        <li><a href="#" class="payment-link"><img src="{{ asset('public/font_end/assets/images/card3.jpg') }}" width="51" height="36" alt=""></a></li>
                                        <li><a href="#" class="payment-link"><img src="{{ asset('public/font_end/assets/images/card4.jpg') }}" width="51" height="36" alt=""></a></li>
                                        <li><a href="#" class="payment-link"><img src="{{ asset('public/font_end/assets/images/card5.jpg') }}" width="51" height="36" alt=""></a></li>
                                    </ul>
                                </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="center"
            style="text-align: center; padding: 10px; background-color:#000000c2;
            font-size: 18px; color: white; width: 100%">
            Bản Quyền Thuộc <a href="{{ URL::to('/') }}" style="color: rgb(93, 184, 93)">MKU FOOD</a>
        </div>
    </div>
</footer>

<!--Footer For Mobile-->
<div class="mobile-footer">
    <div class="mobile-footer-inner">
        <div class="mobile-block block-menu-main">
            <a class="menu-bar menu-toggle btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
                <span class="text">Menu</span>
            </a>
        </div>
        <div class="mobile-block block-sidebar">
            <a class="menu-bar filter-toggle btn-toggle" data-object="open-mobile-filter" href="javascript:void(0)">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="text">Sidebar</span>
            </a>
        </div>
        <div class="mobile-block block-minicart">
            <a class="link-to-cart" href="#">
                <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                <span class="text">Cart</span>
            </a>
        </div>
        <div class="mobile-block block-global">
            <a class="menu-bar myaccount-toggle btn-toggle" data-object="global-panel-opened" href="javascript:void(0)">
                <span class="fa fa-globe"></span>
                <span class="text">Global</span>
            </a>
        </div>
    </div>
</div>

<div class="mobile-block-global">
    <div class="biolife-mobile-panels">
        <span class="biolife-current-panel-title">Global</span>
        <a class="biolife-close-btn" data-object="global-panel-opened" href="#">&times;</a>
    </div>
    <div class="block-global-contain">
        <div class="glb-item my-account">
            <b class="title">My Account</b>
            <ul class="list">
                <li class="list-item"><a href="#">Login/register</a></li>
                <li class="list-item"><a href="#">Wishlist <span class="index">(8)</span></a></li>
                <li class="list-item"><a href="#">Checkout</a></li>
            </ul>
        </div>
        <div class="glb-item currency">
            <b class="title">Currency</b>
            <ul class="list">
                <li class="list-item"><a href="#">€ EUR (Euro)</a></li>
                <li class="list-item"><a href="#">$ USD (Dollar)</a></li>
                <li class="list-item"><a href="#">£ GBP (Pound)</a></li>
                <li class="list-item"><a href="#">¥ JPY (Yen)</a></li>
            </ul>
        </div>
        <div class="glb-item languages">
            <b class="title">Language</b>
            <ul class="list inline">
                <li class="list-item"><a href="#"><img src="assets/images/languages/us.jpg" alt="flag" width="24" height="18"></a></li>
                <li class="list-item"><a href="#"><img src="assets/images/languages/fr.jpg" alt="flag" width="24" height="18"></a></li>
                <li class="list-item"><a href="#"><img src="assets/images/languages/ger.jpg" alt="flag" width="24" height="18"></a></li>
                <li class="list-item"><a href="#"><img src="assets/images/languages/jap.jpg" alt="flag" width="24" height="18"></a></li>
            </ul>
        </div>
    </div>
</div>



