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
            <span class="title">My Cart -</span>
            <span class="sub-total">$0.00</span>
        </a>
        <div class="cart-content">
            <div class="cart-inner">
                <ul class="products">
                    <li>
                        <div class="minicart-item">
                            <div class="thumb">
                                <a href="#"><img src="assets/images/minicart/pr-01.jpg" width="90" height="90" alt="National Fresh"></a>
                            </div>
                            <div class="left-info">
                                <div class="product-title"><a href="#" class="product-name">National Fresh Fruit</a></div>
                                <div class="price">
                                    <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                    <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                </div>
                                <div class="qty">
                                    <label for="cart[id123][qty]">Qty:</label>
                                    <input type="number" class="input-qty" name="cart[id123][qty]" id="cart[id123][qty]" value="1" disabled>
                                </div>
                            </div>
                            <div class="action">
                                <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
                <p class="btn-control">
                    <a href="{{ URL::to('show_cart') }}" class="btn view-cart">
                        Giỏ Hàng
                    </a>
                    <a href="#" class="btn">checkout</a>
                </p>
            </div>
        </div>
    </div>
</div>
