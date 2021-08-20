$(document).ready(function(){
    var _token = $('input[name="_token"]').val();
    $('.choose_cate_sort_ajax_shop').click(function (){
        var cate_id = $(this).attr('data-id');
            $.ajax({
                url: 'ajax_sort_cate_shop',
                method: 'POST',
                data: {
                    _token: _token,
                    cate_id: cate_id,
                },
                success: function (data) {
                    $('.content_list_product_sort_ajax_shop').html(data);
                }
            });
    });

    // sort rating ajaz shop
    $('.choose_rating_sort_ajax_shop').click(function(){
        var rating = $(this).attr('data-id');
        $.ajax({
            url: 'ajax_sort_rating_shop',
            method: 'POST',
            data: {
                _token: _token,
                rating: rating,
            },
            success: function (data) {
                $('.content_list_product_sort_ajax_shop').html(data);
            }
        });
    });

    // btn sort price
    $('.btn_sort_price_ajax_shop').click(function (){
        var price_start = $('.val_price_sort_start').val();
        var price_end = $('.val_price_sort_end').val();

        if(price_start >= price_end || price_start < 0){
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Vui lòng điền khoảng giá phù hợp',
                showConfirmButton: false,
                timer: 2000
            });
        }
        else{
            $.ajax({
                url: 'ajax_sort_price_enter_shop',
                method: 'POST',
                data: {
                    _token: _token,
                    price_start: price_start,
                    price_end: price_end,
                },
                success: function (data) {
                    $('.content_list_product_sort_ajax_shop').html(data);
                }
            });
        }
    });

    // check to sort price ajax shop
    $('.check_sort_price_ajax_shop').click(function(){
        var check_price_id = $(this).attr('data-id');
        if(check_price_id == 1){
            var price_start = 1000;
            var price_end = 50000;
            $.ajax({
                url: 'ajax_sort_price_enter_shop',
                method: 'POST',
                data: {
                    _token: _token,
                    price_start: price_start,
                    price_end: price_end,
                },
                success: function (data) {
                    $('.content_list_product_sort_ajax_shop').html(data);
                }
            });
        }
        else if(check_price_id == 2){
            var price_start = 50000;
            var price_end = 100000;
            $.ajax({
                url: 'ajax_sort_price_enter_shop',
                method: 'POST',
                data: {
                    _token: _token,
                    price_start: price_start,
                    price_end: price_end,
                },
                success: function (data) {
                    $('.content_list_product_sort_ajax_shop').html(data);
                }
            });
        }
        else if(check_price_id == 3){
            var price_start = 100000;
            var price_end = 500000;
            $.ajax({
                url: 'ajax_sort_price_enter_shop',
                method: 'POST',
                data: {
                    _token: _token,
                    price_start: price_start,
                    price_end: price_end,
                },
                success: function (data) {
                    $('.content_list_product_sort_ajax_shop').html(data);
                }
            });
        }
        else if(check_price_id == 4){
            var price_start = 500000;
            var price_end = 1000000;
            $.ajax({
                url: 'ajax_sort_price_enter_shop',
                method: 'POST',
                data: {
                    _token: _token,
                    price_start: price_start,
                    price_end: price_end,
                },
                success: function (data) {
                    $('.content_list_product_sort_ajax_shop').html(data);
                }
            });
        }
        else{
            var price_start = 1000000;
            var price_end = 1000000000;
            $.ajax({
                url: 'ajax_sort_price_enter_shop',
                method: 'POST',
                data: {
                    _token: _token,
                    price_start: price_start,
                    price_end: price_end,
                },
                success: function (data) {
                    $('.content_list_product_sort_ajax_shop').html(data);
                }
            });
        }
    });

    // sort_price_ajax_shop_select
    $('.sort_price_ajax_shop_select').change(function(){
        var val_sort_price = $('.sort_price_ajax_shop_select option:selected').val();

        $.ajax({
            url: 'sort_price_ajax_shop_select',
            method: 'POST',
            data: {
                _token: _token,
                val_sort_price: val_sort_price,
            },
            success: function (data) {
                $('.content_list_product_sort_ajax_shop').html(data);
            }
        });
    });
    // sort_rating_ajax_shop_select
    $('.sort_rating_ajax_shop_select').change(function(){
        var sort_rating_fiter = $('.sort_rating_ajax_shop_select option:selected').val();
        $.ajax({
            url: 'sort_rating_ajax_shop_select',
            method: 'POST',
            data: {
                _token: _token,
                sort_rating_fiter: sort_rating_fiter,
            },
            success: function (data) {
                $('.content_list_product_sort_ajax_shop').html(data);
            }
        });
    });

    // sort_discount_ajax_shop_select
    $('.sort_discount_ajax_shop_select').change(function(){
        var sort_discount_fiter = $('.sort_discount_ajax_shop_select option:selected').val();
        $.ajax({
            url: 'sort_discount_ajax_shop_select',
            method: 'POST',
            data: {
                _token: _token,
                sort_discount_fiter: sort_discount_fiter,
            },
            success: function (data) {
                $('.content_list_product_sort_ajax_shop').html(data);
            }
        });
    });
});
