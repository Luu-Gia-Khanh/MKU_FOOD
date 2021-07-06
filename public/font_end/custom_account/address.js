$(document).ready(function(){
    //ADD ADRESS USER
    $('#city_add_address').change(function(){
        var city = $('#city_add_address').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '../load_district',
            method: 'POST',
            data: {
                city: city,
                _token: _token
            },
            success: function (data) {
                $('#district_add_address').html(data);
            }
        });
    });
    $('#district_add_address').change(function(){
        var district = $('#district_add_address').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '../load_ward',
            method: 'POST',
            data: {
                district: district,
                _token: _token
            },
            success: function (data) {
                $('#ward_add_address').html(data);
            }
        });
    });
    // UPDATE ADDRESS USER
    $('#city_update_address').change(function(){
        var city = $('#city_update_address').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '../load_district_update_address_user',
            method: 'POST',
            data: {
                city: city,
                _token: _token
            },
            success: function (data) {
                $('#district_update_address').html(data);
            }
        });
    });
    $('#district_update_address').change(function(){
        var district = $('#district_update_address').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '../load_ward_update_address_user',
            method: 'POST',
            data: {
                district: district,
                _token: _token
            },
            success: function (data) {
                $('#ward_update_address').html(data);
            }
        });
    });
    // UPDATE PROFILE ADMIN

    $('#city_update_profile').change(function(){
        var city = $('#city_update_profile').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '../load_district_update_profile_admin',
            method: 'POST',
            data: {
                city: city,
                _token: _token
            },
            success: function (data) {
                $('#district_update_profile_admin').html(data);
            }
        });

    });
    $('#district_update_profile_admin').change(function(){
        var district = $('#district_update_profile_admin').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '../load_ward_update_address_profile_admin',
            method: 'POST',
            data: {
                district: district,
                _token: _token
            },
            success: function (data) {
                $('#ward_update_profile_admin').html(data);
            }
        });
    });


});
