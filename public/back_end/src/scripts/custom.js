$(document).ready(function(){
    $('#file_upload').change(function(){
        $('#image_upload').addClass('op-1');
        $('#content_image_upload').addClass('op-1');
    });
    $('.confirm').click(function(){
        location.reload();
    });
    // Modal delete forever
    $('.btn_delete_forever').click(function(){
        var admin_id = $(this).attr('data-id');
        $('.admin_id_delete_forever').val(admin_id);
    });
    $('.btn_confirm_delete_forever').click(function(){
        var form_delete = document.forms['form_delete_forever'];
        form_delete.submit();
    });

    //soft delete
    $('.soft_delete_admin_class').click(function(){
            var admin_id = $(this).attr('data-id');
            $('.id_delete_admin').val(admin_id);
    });
    $('.btn_delete_soft').click(function(){
        var form_delete = document.forms['form_soft_delete'];
        form_delete.submit();
    });

    // soft delete category
    $('.soft_delete_category_class').click(function(){
            var cate_id = $(this).attr('data-id');
            $('.id_delete_category').val(cate_id);
    });
    $('.btn_delete_forever').click(function(){
        var cate_id = $(this).attr('data-id');
        $('.category_id_delete_forever').val(cate_id);
    });

    // time out alert
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

    //search category
    $('#find_category').keyup(function(){
        var value_find = $('#find_category').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: 'find_category',
            method: 'POST',
            data: {
                value_find: value_find,
                _token: _token
            },
            success: function (data) {
                $('.content_find_category').html(data);
            }
        });
    });
    // change live profile
    $('.change_name').keyup(function(){
        $('.following_name').text($('.change_name').val());
    });
    $('.change_birthday').keyup(function(){
        $('.following_birthday').text($('.change_birthday').val());
    });
    $('.change_gender').keyup(function(){
        $('.following_gender').text($('.change_gender').val());
    });
    $('.change_email').keyup(function(){
        $('.following_email').text($('.change_email').val());
    });
    $('.change_phone').keyup(function(){
        $('.following_phone').text($('.change_phone').val());
    });
});

    //keep active when load page tab
    $(function() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('lastTab', $(this).attr('href'));
        });
        var lastTab = localStorage.getItem('lastTab');

        if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
        }
    });





