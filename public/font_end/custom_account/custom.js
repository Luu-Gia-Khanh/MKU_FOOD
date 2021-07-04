$(document).ready(function(){
    $('#file_upload').change(function(){
        $('#image_upload').addClass('op-1');
        $('#content_image_upload').addClass('op-1');
    });
    $('.confirm').click(function(){
        location.reload();
    });

    //add address
    $('.add_address_account').click(function(){
        var cart_id = $(this).attr('data-id');
        $('.add_address_account').val(cart_id);
    });
    // $('.btn_confirm_delete_item_cart').click(function(){
    //     var form_delete = document.forms['form_delete_item_cart'];
    //     form_delete.submit();
    //     Swal.fire({
    //         position: 'top-end',
    //         icon: 'success',
    //         title: 'xóa thành công',
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // });


    //add address
    $('.btn_add_address').click(function(){
        var form_add_address = document.forms['add_transport'];
        form_add_address.submit();
    });

    //update address
    $('.update_address').click(function(){
        var trans_id = $(this).attr('data-id');
        var _token = $('input[name="_token"]').val();
         $('.trans_id').val(trans_id);
        $.ajax({
            url: '../trans_id_update',
            method: 'post',
            data: {
                _token: _token,
                trans_id: trans_id
            },
            success: function (data) {
                $('.fullname_address_update').val(data);
            }
        });
        $.ajax({
            url: '../get_phone_address',
            method: 'post',
            data: {
                _token: _token,
                trans_id: trans_id
            },
            success: function (data) {
                $('.phone_address_update').val(data);
            }
        });
    });
    $('.btn_update_address').click(function(){
        var form_update_address = document.forms['update_transport'];
        form_update_address.submit();
    });

    //delete item cart
    $('.delete_address').click(function(){
        var trans_id = $(this).attr('data-id');
        $('.delete_address').val(trans_id);
    });
    $('.btn_delete_address').click(function(){
        var form_delete = document.forms['form_delete_address'];
        form_delete.submit();
    });

    //ADD ADRESS ACCOUNT
    // $('#city_add_admin').change(function(){
    //     var city = $('#city_add_admin').val();
    //     var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //         url: 'load_district',
    //         method: 'POST',
    //         data: {
    //             city: city,
    //             _token: _token
    //         },
    //         success: function (data) {
    //             $('#district_add_admin').html(data);
    //         }
    //     });
    // });
    // $('#district_add_admin').change(function(){
    //     var district = $('#district_add_admin').val();
    //     var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //         url: 'load_ward',
    //         method: 'POST',
    //         data: {
    //             district: district,
    //             _token: _token
    //         },
    //         success: function (data) {
    //             $('#ward_add_admin').html(data);
    //         }
    //     });
    // });
    // // UPDATE ADDRESS ACCOUNT
    // $('#city_update_admin').change(function(){
    //     var city = $('#city_update_admin').val();
    //     var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //         url: '../load_district_update_address_admin',
    //         method: 'POST',
    //         data: {
    //             city: city,
    //             _token: _token
    //         },
    //         success: function (data) {
    //             $('#district_update_admin').html(data);
    //         }
    //     });
    // });
    // $('#district_update_admin').change(function(){
    //     var district = $('#district_update_admin').val();
    //     var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //         url: '../load_ward_update_address_admin',
    //         method: 'POST',
    //         data: {
    //             district: district,
    //             _token: _token
    //         },
    //         success: function (data) {
    //             $('#ward_update_admin').html(data);
    //         }
    //     });
    // });
});
function upberFirstKey(){
    var str = document.getElementsByClassName('upper_val')[0].value;
    str = str.toLowerCase().replace(/^[\u00C0-\u1FFF\u2C00-\uD7FF\w]|\s[\u00C0-\u1FFF\u2C00-\uD7FF\w]/g, function(letter) {
        return letter.toUpperCase();
    });
    document.getElementsByClassName('upper_val')[0].value=str;
}