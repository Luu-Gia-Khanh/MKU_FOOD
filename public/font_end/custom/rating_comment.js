$(document).ready(function(){
    function load_comment(_token,product_id){
        $.ajax({
                url: '../load_comment',
                method: 'POST',
                data: {
                    _token: _token,
                    product_id: product_id,
                },
                success: function (data) {
                    $('.content_comment_rating').html(data);
                    $('.comment_message').val("");
                }
            });
    }

    //
    var number_rate;
    var val_load_add = $('.val_load_add_5').val();
    $('.choose_rating').click(function(){
        number_rate = $(this).attr('data-value');
    });
    $('.send_comment_rating').click(function(){
        var product_id = $('.val_product_id').val();
        var comment_message = $('.comment_message').val();
        var _token = $('input[name="_token"]').val();

        if(number_rate == null || number_rate == ""){
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Bạn chưa chọn sao đánh giá sản phẩm',
                showConfirmButton: false,
                timer: 1000
              });
        }
        else if(comment_message == null || comment_message == ""){
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Bạn chưa nhập nội dung bình luận',
                showConfirmButton: false,
                timer: 1000
              });
        }
        else{
            $.ajax({
                url: '../add_comment_rating',
                method: 'POST',
                data: {
                    _token: _token,
                    number_rate: number_rate,
                    comment_message: comment_message,
                    product_id: product_id,
                },
                success: function (data) {
                    load_comment(_token,product_id);
                    var all_comment_to_count = $('.all_comment_to_count').val();
                    var count_comment = Number(all_comment_to_count)+1;
                    $('.count_comment_tab').html('('+count_comment+')');
                    $('.count_comment_rating').html(count_comment+' đánh giá');
                    $('.all_comment_to_count').val(count_comment);
                    val_load_add = 5;
                    if(Number(all_comment_to_count) > Number(val_load_add)){
                        $('.load_more_comment').removeClass('op-0');
                    }
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Thêm đánh giá sản phẩm thành công',
                        showConfirmButton: false,
                        timer: 1000
                      });

                }
            });
        }
    });
    $('.load_more_comment').click(function(){
        var all_comment_to_count = $('.all_comment_to_count').val();
        //var val_load_add = $('.val_load_add_5').val(); // get biến toàn cục
        var _token = $('input[name="_token"]').val();
        var product_id = $('.val_product_id').val();
        val_load_add = Number(val_load_add) + 5;
        $.ajax({
            url: '../load_more_comment',
            method: 'POST',
            data: {
                _token: _token,
                val_load_add: val_load_add,
                product_id: product_id,
            },
            success: function (data) {
                if(all_comment_to_count < val_load_add){
                    $('.load_more_comment').addClass('op-0');
                }
                $('.content_comment_rating').html(data);
                $('.val_load_add_5').val(val_load_add)
            }
        });

    });
    $('.btn_useful_comment').click(function(){
        var _token = $('input[name="_token"]').val();
        var comment_id = $(this).attr('data-id');

        var check_like = $('.hidden_check_comment_like_'+comment_id).val();
        if(check_like == ""){
            $('.btn_useful_comment_'+comment_id).css('color','#7faf51');
            $('.hidden_check_comment_like_'+comment_id).val(comment_id);
        }
        else{
            $('.btn_useful_comment_'+comment_id).css('color','#666666');
            $('.hidden_check_comment_like_'+comment_id).val('');
        }

        $.ajax({
            url: '../like_comment',
            method: 'POST',
            data: {
                _token: _token,
                comment_id: comment_id,
            },
            success: function (data) {
                $('.txt_count_comment_useful_'+comment_id).html('Hữu ích ('+data+')');

            }
        });
    });
});

