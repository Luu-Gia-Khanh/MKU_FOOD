@if (count($wish_lish) > 0)
    <ul class="products">
            @foreach ($wish_lish as $wish)
                <li>
                    <div class="minicart-item">
                        @foreach ($all_product as $product)
                            @if ($wish->product_id == $product->product_id)
                                @php
                                    $price_discount = App\Http\Controllers\HomeClientController::check_price_discount($product->product_id);
                                @endphp
                                <div class="thumb">
                                    <a href="{{ URL::to('product_detail/'.$product->product_id) }}"><img src="{{ asset('public/upload/'.$product->product_image) }}" style="width: 90px; height: 90px;" alt="National Fresh"></a>
                                </div>
                                <div class="left-info">
                                    <div class="product-title"><a href="{{ URL::to('product_detail/'.$product->product_id) }}" class="product-name">{{ $product->product_name }}</a></div>
                                    <div class="price">
                                        @if ($price_discount->percent_discount == 0)
                                            <ins><span class="price-amount">
                                                <span class="currencySymbol">
                                                    {{ number_format($price_discount->price_now, 0, ',', '.') }}đ
                                                </span></span>
                                            </ins>
                                        @else
                                            <ins><span class="price-amount">
                                                <span class="currencySymbol">
                                                    {{ number_format($price_discount->price_now, 0, ',', '.') }}đ
                                                </span></span>
                                            </ins>
                                            <del><span class="price-amount">
                                                <span class="currencySymbol">
                                                    {{ number_format($price_discount->price_old, 0, ',', '.') }}đ
                                                </span></span>
                                            </del>
                                        @endif
                                    </div>
                                </div>
                                <div class="action">
                                    <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </li>
            @endforeach
    </ul>
    {{-- <p class="btn-control" style="display: flex; justify-content: flex-end">
        <a href="{{ URL::to('show_cart') }}" class="btn view-cart" style="border-radius: 2px">
            Xem Giỏ Hàng
        </a>
    </p> --}}
@else
    <p class="minicart-empty">không có sản phẩm nào</p>
@endif
