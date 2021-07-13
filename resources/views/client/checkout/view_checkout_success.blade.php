@extends('client.layout_client_check_out')
@section('header_content')
    <div class="content-header">
        <div class="container">
            <div class="content-both">
                <div class="content-logo">
                    <img class="logo-page-checkout" src="{{ asset('public/font_end/assets/images/favicon.png') }}" alt="">
                </div>
                <div class="col-spacing"></div>
                <div class="content-title-page">
                    Đặt Hàng Thành Công
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content_body')
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/check_out_success.css') }}">
    <div class="content-body">
        <div class="container pd-20 center">
            <div class="content-img">
                <img class="img-success" src="{{ asset('public/upload/checked.png') }}" alt="">
                <h4 style="font-weight: bold">Đặt hàng thành công</h4>
            </div>
            <div class="content-bill">
                <div class="content-text-bill">
                    <div class="" style="font-weight: bold; font-size: 16px">Chào Khánh,</div>
                    <div class="" style="padding-bottom: 10px">Chúc mừng bạn đã đặt hàng thành công sản phẩm của <strong>MKU_FOOD</strong></div>
                    <div class="space-between">
                        <div class="txt">Mã đơn hàng:</div>
                        <div class=""><strong>kjdsfkashdfkjbj</strong></div>
                    </div>
                    <div class="space-between">
                        <div class="txt">Phương thức thanh toán:</div>
                        <div class=""><strong>kjdsfkashdfkjbj</strong></div>
                    </div>
                    <div class="space-between">
                        <div class="txt">Thời gian dự kiến giao hàng</div>
                        <div class=""><strong>kjdsfkashdfkjbj</strong></div>
                    </div>
                    <div class="space-between">
                        <div class="txt">Tổng thanh toán</div>
                        <div class=""><strong style="color: rgb(69, 165, 31);">kjdsfkashdfkjbj</strong></div>
                    </div>
                    <div class="space-between">
                        <div class="txt">Tình trạng</div>
                        <div class=""><strong style="color: rgb(69, 165, 31);">kjdsfkashdfkjbj</strong></div>
                    </div>
                    <div class="line"></div>
                    <div class="" style="font-weight: bold">Mọi thông tin về đơn hàng sẽ được gửi tới email của bạn,
                        vui lòng kiểm tra email để biết thêm chi tiết.</div>
                    <div class="" style="font-weight: bold">Cảm ơn bạn đã tin tưởng và giao dịch tại MKU_FOOD</div>
                    <div class="" style="font-weight: bold; padding-top: 15px">Ban quản trị MKU_FOOD</div>
                    <div class="content-btn" style="display: flex; justify-content: center">
                        <button class="btn btn-secondary" style="margin: 5px">Tiếp tục mua sắm</button>
                        <button class="btn btn-secondary" style="margin: 5px">Chi tiết đơn hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
