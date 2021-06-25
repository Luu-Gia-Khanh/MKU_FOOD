$(document).ready(function(){
    $('#find_admin').keyup(function(){
        var value_find = $('#find_admin').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: 'find_admin',
            method: 'POST',
            data: {
                value_find: value_find,
                _token: _token
            },
            success: function (data) {
                $('.content_find_admin').html(data);
            }
        });
    });
    $('#find_admin').keydown(function(){
        var value_find = $('#find_admin').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: 'find_admin',
            method: 'POST',
            data: {
                value_find: value_find,
                _token: _token
            },
            success: function (data) {
                $('.content_find_admin').html(data);
            }
        });
    });
});
