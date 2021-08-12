$(document).ready(function(){
    var keyword_search = $('.keyword_search').val();
    var _token = $('input[name="_token"]').val();
    $('.choose_cate_search').click(function (){
        var cate_id = $(this).attr('data-id');
            $.ajax({
                url: 'ajax_search_cate_and_keyword',
                method: 'POST',
                data: {
                    _token: _token,
                    keyword_search: keyword_search,
                    cate_id: cate_id,
                },
                success: function (data) {
                    $('.content_list_product_search').html(data);
                    //alert(data);
                }
            });
    });
});
