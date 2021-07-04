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
                    Thanh Toán
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content_body')
    {{-- checkout custom --}}
    <link rel="stylesheet" href="{{ asset('public/font_end/custom/checkout_custom.css') }}">
    <div class="content-checkout" style="background: rgb(245, 245, 245);">
        <div class="container">
            <form action="">
                <div class="_1G9Cv7"></div>
                <div class="row">
                    <div class="cus_view place_trans">
                        <div class="">
                            <h4 class="title_place_trans"><i class="biolife-icon icon-location"></i> Địa Chỉ Nhận Hàng</h4>
                        </div>
                        <div class="address_static_show">
                            <div class="static-address hidden_address">
                                <strong style="info-trans">Khánh (+84) 368038738</strong>
                                Số 540,tổ 41,phú quới,long hồ ,việt nam, Xã Phú Quới, Huyện Long Hồ, Vĩnh Long
                                <i class="static">Mặc Định</i>
                                <button type="button" class="btn-green btn_change_address_trans" data-toggle="collapse"
                                    data-target="#change_address_trans">THAY ĐỔI</button>
                            </div>
                            <div id="change_address_trans" class="collapse">

                                <p>
                                    <input type="radio" id="id1" name="radio-group" checked>
                                    <label for="id1" class="static-address">
                                        <strong style="info-trans">Khánh (+84) 368038738</strong>
                                        Số 540,tổ 41,phú quới,long hồ ,việt nam, Xã Phú Quới, Huyện Long Hồ, Vĩnh Long
                                    </label>
                                </p>
                                <p>
                                    <input type="radio" id="id2" name="radio-group">
                                    <label for="id2" class="static-address">
                                        <strong style="info-trans">Khánh (+84) 368038738</strong>
                                        Số 540,tổ 41,phú quới,long hồ ,việt nam, Xã Phú Quới, Huyện Long Hồ, Vĩnh Long
                                    </label>
                                </p>

                                <div class="content-btn">
                                    <button type="button" class="btn-green">Hoàn Thành</button>
                                    <button type="button" class="btn-back btn_show_hidden" data-toggle="collapse"
                                        data-target="#change_address_trans">Trở Lại</button>
                                </div>

                                <div id="change_address_trans" class="collapse">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cus_view">
                        <div class="content-show-product">
                            <table class="tbl-content-product-checkout" cellspacing="0" cellpadding="0">
                                <thead>
                                    <td class="td-product">Sản phẩm</td>
                                    <td class="td-price">Đơn giá</td>
                                    <td class="td-qty">Số lượng</td>
                                    <td class="td-total_price">Thành tiền</td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    @php
                                        $total_temporary_price = 0;
                                        $total_qty = 0;
                                    @endphp
                                    @foreach ($arrCart_id as $cart_id)
                                        @foreach ($all_cart as $cart)
                                            @if ($cart_id == $cart->cart_id)
                                                @php
                                                    $price_prod;
                                                    $qty_prod;
                                                @endphp
                                                <tr>
                                                    @foreach ($all_product as $product)
                                                        @if ($product->product_id == $cart->product_id)

                                                            <td class="info-product">
                                                                <div class="content-info-product">
                                                                    <img src="{{ asset('public/upload/' . $product->product_image) }}"
                                                                        alt="" style="width:45px; height:45px">
                                                                    <label
                                                                        class="name-product">{{ $product->product_name }}</label>
                                                                    <input type="checkbox" name="cart_id[]"
                                                                        style="opacity: 0" checked>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @foreach ($product_price as $price)
                                                                    @if ($price->product_id == $product->product_id)
                                                                        {{ number_format($price->price, 0, ',', '.') }}
                                                                        vnđ
                                                                        @php
                                                                            $price_prod = $price->price;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                {{ $cart->quantity }}
                                                                @php
                                                                    $qty_prod = $cart->quantity;
                                                                    $total_qty += $cart->quantity;
                                                                @endphp

                                                            </td>
                                                            <td>
                                                                {{ number_format($price_prod * $qty_prod, 0, ',', '.') }}
                                                                vnđ
                                                                @php
                                                                    $total_temporary_price += $price_prod * $qty_prod;
                                                                @endphp
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="total-price-pay">
                            Tổng số tiền ({{ $total_qty }} sản phẩm):
                            <div class="temporary-price">{{ number_format($total_temporary_price, 0, ',', '.') }} vnđ
                            </div>
                        </div>
                    </div>
                    <div class="cus_view">
                        <div class="content-voucher">
                            <img src="{{ asset('public/upload/voucher.png') }}" alt="" style="width: 30px">
                            <h4 class="titel-voucher">MKU_FOOD Voucher</h4>
                            <button type="button" id="btn-open-model-voucher" class="choose-voucher btn-green"
                                data-toggle="modal" data-target="#modal-choose-voucher">Chọn Voucher</button>
                            {{-- <button id="myBtn" type="button">Open Modal</button> --}}
                        </div>
                    </div>
                    <div class="cus_view">
                        <div class="content-payment-method row">
                            <h4 class="title-payment-method">Phương Thức Thanh Toán</h4>
                            <div class="btn-group btn-group-toggle group-checkbox-btn group-checkbox_btn op-0" data-toggle="buttons">
								<label class="btn btn-outline-secondary active btn-outline-payment btn_cash">
									<input type="radio" name="payment_method" value="0" id="cash_pay" autocomplete="off" checked=""> Thanh toán khi nhận hàng
								</label>
                                <label for=""></label>
								<label class="btn btn-outline-secondary btn-outline-payment btn_paypal">
									<input type="radio" name="payment_method" value="1" id="paypal" autocomplete="off"> Paypal
								</label>
							</div>
                            <div class="content-text-payment_method text_payment_method">
                                Thanh toán khi nhận hàng
                            </div>
                            <button type="button" class="btn-green btn-change-method btn_change_method_pay">Thay Đổi</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- The Modal -->
    <div id="modal_voucher" class="modal">
        <!-- Modal content -->
        <div class="modal-content container">
            <div class="modal-header-cus">
                <span class="close">&times;</span>
                <h4>Chọn Voucher</h4>
            </div>
            <div class="modal-body-cus">
                <div class="content-enter-voucher">
                    <label class="title-code-voucher col-2">Mã Voucher: </label>
                    <div class="content-input-voucher">
                        <input type="text" class="input-voucher col-8" placeholder="Mã MKU_FOOD Voucher">
                    </div>
                    <button type="button" class="btn-green btn-voucher col-2">ÁP DỤNG</button>
                </div>
            </div>
        </div>

    </div>



    <script src="{{ asset('public/font_end/assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/font_end/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- check out custom --}}
    <script src="{{ asset('public/font_end/custom/checkout_custom.js') }}"></script>

@endsection
