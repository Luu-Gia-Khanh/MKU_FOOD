@if (count($result_search) > 0)
    @foreach ($result_search as $product)
    @php
        $price_discount = App\Http\Controllers\HomeClientController::check_price_discount($product->product_id);
    @endphp
        <a href="{{ URL::to('product_detail/'.$product->product_id) }}" id="">
            <div class="items" id="items">
                <div class="content_image_product_search">
                    <img src="{{ URL::to('public/upload/' . $product->product_image) }}" alt=""
                        style="width: 65px; height: 65px;">
                </div>
                <div class="content_info_product" style="padding-left: 15px">
                    <div class="name">{{ $product->product_name }}</div>
                    <div class="content_price">
                        @if ($price_discount->percent_discount == 0)
                            <div class="price">{{ number_format($price_discount->price_now, 0, ',', '.') }}đ</div>
                        @else
                            <div class="price">{{ number_format($price_discount->price_now, 0, ',', '.') }}đ</div>
                            <del class="price_old">{{ number_format($price_discount->price_old, 0, ',', '.') }}₫</del>
                        @endif
                    </div>
                </div>
            </div>
            <div class="ln"></div>
        </a>
    @endforeach
@else
    <div class="search_none">Không tìm thấy sản phẩm nào </div>
@endif
