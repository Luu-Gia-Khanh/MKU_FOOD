$(document).ready(function(){
    $('.btn_change_address_trans').click(function(){
        $('.hidden_address').css('opacity', 0);
        $('.btn-add-new-add-trans').removeClass('op-0');
        $('.btn-thietlap').removeClass('op-0');
    });
    $('.btn_show_hidden').click(function(){
        $('.hidden_address').css('opacity', 1);
        $('.btn-add-new-add-trans').addClass('op-0');
        $('.btn-thietlap').addClass('op-0');
    });

    //btn change-payemnt
    $('.btn_change_method_pay').click(function(){
        $('.btn_change_method_pay').addClass('op-0');
        $('.text_payment_method').addClass('op-0');
        $('.group-checkbox_btn').removeClass('op-0');
    });
    $('.btn_cash').click(function(){
        var cash = $('#cash_pay').val();
        $('.btn_change_method_pay').removeClass('op-0');
        $('.text_payment_method').removeClass('op-0');
        $('.group-checkbox_btn').addClass('op-0');
        $('.text_payment_method').html('Thanh toán khi nhận hàng');

    });
    $('.btn_paypal').click(function(){
        var cash = $('#paypal').val();
        $('.btn_change_method_pay').removeClass('op-0');
        $('.text_payment_method').removeClass('op-0');
        $('.group-checkbox_btn').addClass('op-0');
        $('.text_payment_method').html('Thanh toán bằng paypal');
    });

    // MODAL ADD ADDRESS
    var modal_address = $('.modal_address');
    var btn_address = $('.btn_open_modal_adress');
    var close_address = $('.close_modal_address');
    var btn_back_modal_address = $('.btn_back_modal_address');
    btn_address.click(function () {
        modal_address.show();
    });
    close_address.click(function () {
        modal_address.hide();
    });
    $(window).on('click', function (e) {
        if ($(e.target).is('.modal_address')) {
            modal_address.hide();
        }
    });
    btn_back_modal_address.click(function () {
        modal_address.hide();
    });
    //
    $('.btn_submit_form_add_address').click(function(){
        var fullname = $('.trans_fullname').val();
        var phone = $('.trans_phone').val();
        var city = $('#city_add_trans').val();
        var district = $('#district_add_trans').val();
        var ward = $('#ward_add_trans').val();
        var detail_address = $('#detail_address').val();
        var _token = $('input[name="_token"]').val();
        var check = 1;

        if(fullname == "" || phone == "" || city == "" || district == "" || ward == "" || detail_address == ""){
            check = 0;
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Bạn chưa nhập đủ thông tin',
                showConfirmButton: false,
                timer: 1500
              });

        }
        else{
            if(phone.length != 10 || phone.indexOf('0')!==0){
                check = 0;
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Số điện thoại không đúng định dạng',
                    showConfirmButton: false,
                    timer: 1500
                  });
            }
        }
        if(check == 1){
            $.ajax({
                url: 'add_address_trans',
                method: 'POST',
                data: {
                    fullname: fullname,
                    phone: phone,
                    city: city,
                    district: district,
                    ward: ward,
                    detail_address: detail_address,
                    _token: _token,
                },
                success: function (data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Thêm địa chỉ thành công',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    setTimeout(
                        function(){
                            location.reload();
                        }, 2000);
                }
            });
        }

    });

    // radio check choose address trans
    $('.btn_change_address_radio_button').click(function (){
        $('.hidden_address').css('opacity', 1);
        $('.btn-add-new-add-trans').addClass('op-0');
        $('.btn-thietlap').addClass('op-0');

        var trans_id = $('input[name="radio_trans"]:checked').val();
        var name_phone = $('.name_phone_'+trans_id).val();
        var detail_address = $('.detail_address_trans_'+trans_id).val();
        var static = $('.static_choose_'+trans_id).html();

        $('.info_trans_js_change').html(name_phone);
        $('.address_detail_change').html(detail_address);

        if(static == null || static == ""){
            $('.static_change').html("");
        }
        else{
            $('.static_change').html(static);
        }


    });

    // submit form check out
    $('.btn_dathang').click(function(){
        var _token = $('input[name="_token"]').val();
        var trans_id = $('input[name="trans_id"]:checked').val();
        var payment_method = $('input[name="payment_method"]:checked').val();
        var summary_total_order = $('.summary_total_order').val();
        var cart_id = [];
        $("input:checkbox[name='cart_id[]']:checked").each(function() {
            cart_id.push($(this).val());
        });
        $.ajax({
            url: 'check_qty_to_checkout',
            method: 'POST',
            data: {
                _token: _token,
                trans_id: trans_id,
                payment_method: payment_method,
                summary_total_order: summary_total_order,
                cart_id: cart_id,
            },
            success: function (data) {
                if(data == 0){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Đặt hàng thất bại, số lượng trong kho không đủ với số lượng bạn mua',
                        showConfirmButton: false,
                        timer: 1500
                        });
                }
                else if(data == 1){
                    var form_checkout = document.forms['form_content_check_out_pay'];
                    form_checkout.submit();
                }
                else if(data == 2){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Bạn chưa nhập địa chỉ nhận hàng',
                        showConfirmButton: false,
                        timer: 1500
                        });
                }
            }
        });
    });



});


// MODAL CHOOSE VOUCHER
var modal_voucher = document.getElementById("modal_voucher");
var btn_voucher = document.getElementById("btn-open-model-voucher");
var span = document.getElementsByClassName("close")[0];
btn_voucher.onclick = function() {
    modal_voucher.style.display = "block";
}
span.onclick = function() {
    modal_voucher.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal_voucher) {
    modal_voucher.style.display = "none";
  }
}




