<div class="content-image">
    <img src="{{ asset('public/upload/'.$product->product_image) }}" alt="" style="width: 361px; height: 361px;">
</div>
<div class="content_info_product">
    <h4 class="title">
        <div class="product_id"></div>
        <a href="#" class="pr-name name_product">{{ $product->product_name }}</a>
    </h4>
    <div class="price price-contain">
        <ins><span class="price-amount"><span class="currencySymbol price_prod">{{ number_format($price->price, 0, ',', '.') }}</span>vnđ</span></ins>
        {{-- <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del> --}}
    </div>
    <p class="excerpt sort_desc_product">{!! $product->product_sort_desc !!}</p>
    <div class="from-cart">
        <div class="qty-input">
            <input class="qty_prod qty_mini_detail_{{ $product->product_id }}" type="number" name="qty_mini_detail" value="1" data-max_value="100" data-min_value="1" data-step="1">
            <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up up" aria-hidden="true"></i></a>
            <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down down" aria-hidden="true"></i></a>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </div>
        <div class="buttons">
            @if (Session::get('customer_id'))
                <button class="btn add-to-cart-btn btn-bold btn_add_cart btn_add_cart_mini_detail" data-id="{{ $product->product_id }}">Thêm Vào Giỏ Hàng</button>
            @else
                <a href="{{ URL::to('login_client') }}"class="btn add-to-cart-btn btn-bold">Thêm Vào Giỏ Hàng</a>
            @endif

        </div>
    </div>
    <div class="product-meta">
        <div class="product-atts">
            <div class="product-atts-item show_category">
                <b class="meta-title">Danh mục sản phẩm:</b>
                <label for="">{{ $cate->cate_name }}</label>
            </div>
            <div class="show_qty_storage">
                <b class="meta-title">Trong Kho:</b>
                <label for="">{{ $product_storage->total_quantity_product }}</label>
            </div>
        </div>
        <div class="biolife-social inline add-title">
            <span class="fr-title">Chia sẻ:</span>
            <ul class="socials">
                <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<script>
    function update_qty_when_change(product_id, _token){
        $.ajax({
            url: 'update_qty_when_change',
            method: 'POST',
            data: {
                _token: _token,
                product_id: product_id,
            },
            success: function (data) {
                $('.qty_cart_'+product_id).val(data);
            }
        });

    }
    function show_mini_cart_when_add(product_id, _token){
        $.ajax({
            url: 'show_mini_cart_when_add',
            method: 'POST',
            data: {
                product_id:product_id,
                _token: _token,
            },
            success: function (data) {
                $('.show_mini_cart_when_add').html(data);
            }
        });
    }
    $(document).ready(function(){
        $('.btn_add_cart_mini_detail').click(function(){
            var product_id = $(this).attr('data-id');
            var qty = $('.qty_mini_detail_'+product_id).val();
            var _token = $('input[name="_token"]').val();
            if(qty <= 0){
                $('.qty_mini_detail_'+product_id).val(1);
                qty = 1;
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Thêm vào giỏ hàng thất bại, số lượng tối thiểu là 1',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            else{
                $.ajax({
                    url: 'add_to_cart',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        qty: qty,
                        _token: _token
                    },
                    success: function (data) {
                        $(function(){
                            $.ajax({
                                url: 'load_quantity_cart',
                                method: 'POST',
                                data: {
                                    _token: _token
                                },
                                success: function (data) {
                                    $('.total_quantity_cart').html(data);
                                }
                            });
                        });
                        if(data == 1){
                            show_mini_cart_when_add(product_id, _token);
                            update_qty_when_change(product_id, _token);
                            $('.modal_mini_detail').hide();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'đã thêm vào giỏ hàng',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                        else{
                            if(data == 0){
                                $('.qty_mini_detail_'+product_id).val(1);
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'thêm giỏ hàng thất bại, sản phầm không còn đủ số lượng mà bạn cần',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                            else{
                                $('.qty_mini_detail_'+product_id).val(data);
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'thêm giỏ hàng thất bại, bạn chỉ có thể mua thêm tối đa '+data+ ' sản phẩm',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        }
                    }
                });
            }

        });
    });
</script>
