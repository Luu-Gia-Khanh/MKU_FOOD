$(document).ready(function(){
    //search voucher
    $('#find_voucher').keyup(function(){
        var value_find = $('#find_voucher').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: 'find_voucher',
            method: 'get',
            data: {
                value_find: value_find,
                _token: _token
            },
            success: function (data) {
                $('.content_find_voucher').html(data);
            }
        });
    });
});