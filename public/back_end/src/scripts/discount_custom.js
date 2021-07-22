$(document).ready(function(){
    $('.get_val').click(function(){
       var tag = $('.test').val();
       var cut_string = tag.split(',');
       alert(cut_string[1]);
    })
    $('.check').click(function(){
        var isCheckAll = $(this).prop('checked');
        if(isCheckAll){
            $('.test').tagsinput('add', $(this).val());
        }
        else{
            $('.test').tagsinput('remove', $(this).val());
        }
    });
    $(".test").on('itemRemoved', function(event) {
       alert(event.item);
    })
});
