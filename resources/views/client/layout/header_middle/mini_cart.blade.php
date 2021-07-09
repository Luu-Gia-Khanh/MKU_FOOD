<div class="minicart-block">
    <div class="minicart-contain">
        <a href="javascript:void(0)" class="link-to">
            <span class="icon-qty-combine">
                <i class="icon-cart-mini biolife-icon"></i>
                <span class="qty total_quantity_cart">
                    @if(isset($all_cart))
                        {{ count($all_cart) }}
                    @endif
                </span>
            </span>
            {{-- <span class="title">Giỏ Hàng -</span>
            <span class="sub-total">$0.00</span> --}}
        </a>
        <div class="cart-content">
            <div class="cart-inner show_mini_cart_when_add">
                @if (count($all_cart) > 0)
                    <ul class="products">
                            @foreach ($all_cart as $cart)
                                <li>
                                    <div class="minicart-item">
                                        @foreach ($all_product as $product)
                                            @if ($cart->product_id == $product->product_id)
                                                <div class="thumb">
                                                    <a href="{{ URL::to('product_detail/'.$product->product_id) }}"><img src="{{ asset('public/upload/'.$product->product_image) }}" style="width: 90px; height: 90px;" alt="National Fresh"></a>
                                                </div>
                                                <div class="left-info">
                                                    <div class="product-title"><a href="{{ URL::to('product_detail/'.$product->product_id) }}" class="product-name">{{ $product->product_name }}</a></div>
                                            @endif
                                        @endforeach
                                                    @foreach ($all_price as $price)
                                                        @if ($price->product_id == $cart->product_id)
                                                            <div class="price">
                                                                <ins><span class="price-amount"><span class="currencySymbol">{{ number_format($price->price, 0, ',', '.') }}</span> vnđ</span></ins>
                                                                {{-- <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del> --}}
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                    <div class="qty">
                                                        <label for="cart[id123][qty]">Số lượng:</label>
                                                        @foreach ($all_product as $product)
                                                            @if ($cart->product_id == $product->product_id && $cart->customer_id == Session::get('customer_id'))
                                                                <input type="number" class="input-qty qty_cart_{{ $product->product_id }} qty_update_when_change_cart_{{ $cart->cart_id }}" name="cart[id123][qty]" id="cart[id123][qty]" value="{{ $cart->quantity }}" disabled>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="#" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                    </div>
                                </li>

                            @endforeach


                    </ul>
                    <p class="btn-control" style="display: flex; justify-content: flex-end">
                        <a href="{{ URL::to('show_cart') }}" class="btn view-cart" style="border-radius: 2px">
                            Xem Giỏ Hàng
                        </a>
                        {{-- <a href="#" class="btn">checkout</a> --}}
                    </p>
                @else
                    <p class="minicart-empty">không có sản phẩm nào trong giỏ hàng</p>
                @endif
            </div>
        </div>
    </div>
</div>
