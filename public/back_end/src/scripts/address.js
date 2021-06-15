$(document).ready(function(){
    $('#city').change(function(){
        var city = $('#city').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: 'load_district',
            method: 'POST',
            data: {
                city: city,
                _token: _token
            },
            success: function (data) {
                $('#district').html(data);
            }
        });
    });
    $('#district').change(function(){
        var district = $('#district').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: 'load_ward',
            method: 'POST',
            data: {
                district: district,
                _token: _token
            },
            success: function (data) {
                $('#ward').html(data);
            }
        });
    });
});
