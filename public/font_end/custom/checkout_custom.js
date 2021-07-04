$(document).ready(function(){
    $('.btn_change_address_trans').click(function(){
        $('.hidden_address').css('opacity', 0);
    });
    $('.btn_show_hidden').click(function(){
        $('.hidden_address').css('opacity', 1);
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
});




//
// Get the modal
var modal = document.getElementById("modal_voucher");

// Get the button that opens the modal
var btn = document.getElementById("btn-open-model-voucher");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
