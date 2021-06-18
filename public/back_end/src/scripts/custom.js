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
    // time out alert
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
});





