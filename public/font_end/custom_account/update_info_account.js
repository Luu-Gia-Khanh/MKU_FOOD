$(document).ready(function(){
    // UPDATE INFO ACCOUNT
    $('.btn_update_info_account').click(function(){
        var customer_fullname = $('.customer_fullname').val();
        var customer_phone = $('.customer_phone').val();
        var customer_gender = $('.customer_gender:checked').val();
        var customer_birthday = $('.customer_birthday').val();
        //
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '../update_info_account',
            method: 'POST',
            enctype: 'multipart/form-data',
            data: {
                customer_fullname: customer_fullname,
                customer_phone: customer_phone,
                customer_gender: customer_gender,
                customer_birthday: customer_birthday,
                _token: _token,
            },
            success: function (data) {
                if(data == 1){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Họ và Tên không được để trống',
                        showConfirmButton: false,
                        timer: 1500
                      });
                }
                else if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Số điện thoại không được để trống',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                else if(data == 3){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Số điện thoại phải bắt buộc 10 số',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                else if(data == 4){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Số điện thoại không đúng định dạng',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                else if(data == 5){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Năm sinh không hợp lệ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                else if(data == 6){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Người mua phải trên 12 tuổi',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                else if(data == 7){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cập nhật thành công',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    setTimeout(
                        function(){
                            location.reload();
                        }, 2500);
                }
            }
        });
    });
});
