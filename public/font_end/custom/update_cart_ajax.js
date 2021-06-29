$(document).ready(function () {

    //old val
    // var old_qty;
    // $('.val_update_cart_change').bind('keyup mouseup', function () {
    //     //old_qty =  $(this).val();
    //     alert(old_qty =  $(this).val());
    // });

    // up cart
    $('.btn_up_update_cart').click(function () {
        var cart_id = $(this).attr('data-id');
        var qty = $('.val_quantity_update_cart_' + cart_id).val();
        var old_qty = $('.val_quantity_update_cart_' + cart_id).val();
        var price = $('.val_price_update_cart_' + cart_id).val();
        var _token = $('input[name="_token"]').val();
        qty++;
        $.ajax({
            url: 'update_cart',
            method: 'POST',
            data: {
                cart_id: cart_id,
                qty: qty,
                _token: _token
            },
            success: function (data) {
                if (data == 0) {
                    $('.val_quantity_update_cart_' + cart_id).val(old_qty);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Rất tiếc, bạn chỉ có thể mua tối đa '+old_qty+ ' sản phẩm.',
                        showConfirmButton: false,
                        timer: 2000
                    });

                } else {
                    $('.val_quantity_update_cart_' + cart_id).val(data);
                    var total_price = data*price;
                    $('.totol_price_cart_item_update_'+ cart_id).html(total_price);
                }
            }
        });

        $('.val_quantity_update_cart_' + cart_id).val(qty);
    });

    // down cart
    $('.btn_down_update_cart').click(function () {
        var cart_id = $(this).attr('data-id');
        var qty = $('.val_quantity_update_cart_' + cart_id).val();
        var old_qty = $('.val_quantity_update_cart_' + cart_id).val();
        var _token = $('input[name="_token"]').val();
        if (qty > 1) {
            qty--;
            $.ajax({
                url: 'update_cart',
                method: 'POST',
                data: {
                    cart_id: cart_id,
                    qty: qty,
                    _token: _token
                },
                success: function (data) {
                    if (data == 0) {
                        $('.val_quantity_update_cart_' + cart_id).val(old_qty);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'cập nhật giỏ hàng thất bại',
                            showConfirmButton: false,
                            timer: 1000
                        });

                    } else {
                        $('.val_quantity_update_cart_' + cart_id).val(data);
                    }
                }
            });

            $('.val_quantity_update_cart_' + cart_id).val(qty);
        }
    });


    // update val on change
    $('.val_update_cart_change').bind('keyup mouseup blur', function () {
       var qty = $(this).val();
       var cart_id = $(this).attr('data-id');
       var _token = $('input[name="_token"]').val();
       $.ajax({
            url: 'update_cart',
            method: 'POST',
            data: {
                cart_id: cart_id,
                qty: qty,
                _token: _token
            },
            success: function (data) {
                if (data == 0) {
                    $(function(){
                        $.ajax({
                            url: 'check_quatity_blur',
                            method: 'POST',
                            data: {
                                cart_id: cart_id,
                                _token: _token
                            },
                            success: function (data) {
                                $('.val_quantity_update_cart_' + cart_id).val(data);
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Rất tiếc, bạn chỉ có thể mua tối đa '+data+ ' sản phẩm.',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                    });
                } else {
                    $('.val_quantity_update_cart_' + cart_id).val(data);
                }
            }
        });
    });
});
