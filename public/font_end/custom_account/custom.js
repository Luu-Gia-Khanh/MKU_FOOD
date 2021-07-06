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
        $.ajax({
            url: '../get_address_detail_trans',
            method: 'post',
            data: {
                _token: _token,
                trans_id: trans_id
            },
            success: function (data) {
                $('.address_detail_trans_update').val(data);
            }
        });
    });
    $('.btn_update_address').click(function(){
        var form_update_address = document.forms['update_transport'];
        form_update_address.submit();
    });

    //delete item address
    $('.delete_address').click(function(){
        var trans_id = $(this).attr('data-id');
        $('.delete_address').val(trans_id);
    });
    $('.btn_delete_address').click(function(){
        var form_delete = document.forms['form_delete_address'];
        form_delete.submit();
    });

});
function upberFirstKey(){
    var str = document.getElementsByClassName('upper_val')[0].value;
    str = str.toLowerCase().replace(/^[\u00C0-\u1FFF\u2C00-\uD7FF\w]|\s[\u00C0-\u1FFF\u2C00-\uD7FF\w]/g, function(letter) {
        return letter.toUpperCase();
    });
    document.getElementsByClassName('upper_val')[0].value=str;
}


// Get the modal
var modal_add_address = document.getElementById("modal_add_address");

// Get the button that opens the modal
var btn_add_address = document.getElementById("btn-open-model-add_address");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn_add_address.onclick = function() {
  modal_add_address.style.display = "block";
}

var btn_close = document.getElementById("close");
btn_close.onclick = function(){
    modal_add_address.style.display="none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal_add_address.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal_add_address) {
    modal_add_address.style.display = "none";
  }
}




//MODAL DELETE ADDRESS
// Get the modal
var modal_delte_address = document.getElementById("modal_delete_address");

$(document).ready(function(){
    //delete item address
    $('.get_trans_id').click(function(){
        var trans_id = $(this).attr('data-id');




        // DELETE ADDRESS
        // Get the button that opens the modal
        var open_modal = "btn-open-model-delete_address_"+trans_id;
        var btn_delete_address = document.getElementById(open_modal);

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close_delete_address")[0];
        
        var btn_close_delete = document.getElementById("close_delete_address");

        btn_close_delete.onclick = function(){
            modal_delete_address.style.display="none";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal_delete_address.style.display = "none";
        }

        // When the user clicks the button, open the modal
        btn_delete_address.onclick = function() {
        modal_delete_address.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal_delte_address) {
                modal_delete_address.style.display = "none";
            }
        }
    });
});

$(document).ready(function(){
    //delete item address
    $('.get_trans_id_update_address').click(function(){
        var trans_id = $(this).attr('data-id');




        // UPDATE ADDRESS
        // Get the button that opens the modal
        var open_modal_update = "btn-open-model-update_address_"+trans_id;
        var btn_update_address = document.getElementById(open_modal_update);

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close_update_address")[0];
        
        var btn_close_update = document.getElementById("close_update_address");

        btn_close_update.onclick = function(){
            modal_update_address.style.display="none";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal_update_address.style.display = "none";
        }

        // When the user clicks the button, open the modal
        btn_update_address.onclick = function() {
        modal_update_address.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal_update_address) {
                modal_update_address.style.display = "none";
            }
        }
    });
});