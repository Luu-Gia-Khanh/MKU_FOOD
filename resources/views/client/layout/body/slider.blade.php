<link rel="stylesheet" href="{{ asset('public/font_end/custom_ui/css/slider.css') }}">
<div class="content-sider">
    <div class="container">
        <div class="container-slider">
            <div class="slider--box1">
                {{-- <div id="slideshow">
                    <div>
                      <img src="{{ asset('public/upload/no_image.png') }}">
                    </div>
                    <div>
                      <img src="{{ asset('public/upload/no_voucher.png') }}">
                    </div>
                    <div>
                      Pretty cool eh? This slide is proof the content can be anything.
                    </div>
                  </div> --}}

                  <div class="center">
                    <!--   <div class="loader">
                        <div class="loader-inner"></div>
                      </div> -->
                    <div class="slider">
                        <ul>
                          <li><img src="{{ asset('public/upload/bg1.jpg') }}" /></li>
                          <li><img src="{{ asset('public/upload/bg2.jpg') }}" /></li>
                          <li><img src="{{ asset('public/upload/bg1.jpg') }}" /></li>
                        </ul>
                    </div>
                </div> 
            </div>
            <div class="space"></div>
            <div class="slider--box2">
                <div class="slider--box2--kotak mb-2">
                  <img src="{{ asset('public/upload/right-top.jpg') }}" alt="">
                </div>
                <div class="slider--box2--kotak">
                  <img src="{{ asset('public/upload/right-bottom.jpg') }}" alt="">
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('public/font_end/custom_ui/css/slider_js.js') }}"></script>



