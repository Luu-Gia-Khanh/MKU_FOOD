<?php

//LOGIN

use App\Action;
use App\Admin_Action_Category;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\StorageProductController;
use App\Mail\verify;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

// LOGIN SOCIAL
Route::get('/login_facebook','LoginSocialController@login_facebook');
Route::get('/callback','LoginSocialController@callback_facebook');

Route::get('login_google','LoginSocialController@login_google');
Route::get('/google/callback','LoginSocialController@callback_google');

// LOGIN ADDMIN
Route::get('login', 'AuthController@show_login');
Route::post('process_login', 'AuthController@process_login');
Route::get('logout_admin', 'AuthController@logout_admin');

// LOGIN CLIENT
Route::get('login_client', 'CustomerController@show_login');
Route::post('process_login_client', 'CustomerController@process_login');
Route::get('register_client', 'CustomerController@show_register');
Route::get('process_register_client/{username}/{email}/{password}', 'CustomerController@process_register');
Route::get('logout_client', 'CustomerController@logout_client');

Route::get('mail_reset_password', 'CustomerController@mail_reset_password');
Route::post('process_mail_reset_password', 'CustomerController@process_mail_reset_password');
Route::get('reset_password/{customer_id}', 'CustomerController@reset_password');
Route::post('process_reset_password/{customer_id}', 'CustomerController@process_reset_password');
Route::post('mail_register_client', 'CustomerController@mail_register_client');

Route::get('verify_account', 'CustomerController@verify_account');
Route::get('error_process_register', 'CustomerController@error_process_register');
Route::get('success_process_register', 'CustomerController@success_process_register');


// MIDDLEWARE PAGE ADMIN
// Route::group(['middleware'=>'roles'], function(){
//
// });

// GROUP ADMIN
Route::prefix('admin')->group(function () {
    // DASHBORD
    Route::get('/', 'AdminController@index')->middleware('roles');
    // ADMIN
    Route::get('all_admin', 'AdminController@show_admin')->middleware('role_admin_manager');
    Route::get('add_admin', 'AdminController@add_admin');
    Route::get('update_admin/{admin_id}', 'AdminController@update_admin');
    Route::get('view_recycle', 'AdminController@view_recycle');
    Route::get('re_delete/{admin_id}', 'AdminController@re_delete');
    Route::get('delete_when_find/{admin_id}', 'AdminController@delete_when_find');
    Route::get('view_profile/{admin_id}', 'AdminController@view_profile');

    Route::post('find_admin', 'AdminController@find_admin');
    Route::post('delete_forever', 'AdminController@delete_forever');
    Route::post('soft_delete', 'AdminController@soft_delete');
    Route::post('process_add_admin', 'AdminController@process_add_admin');
    Route::post('process_update_admin/{admin_id}', 'AdminController@process_update_admin');
    Route::post('process_update_profile_admin/{admin_id}', 'AdminController@process_update_profile_admin');
    Route::post('update_password_admin/{admin_id}', 'AdminController@update_password_admin');

    //PRODUCT
    Route::get('add_product', 'ProductController@add_product');
    Route::get('all_product', 'ProductController@all_product');
    Route::get('is_featured/{prod_id}', 'ProductController@is_featured');
    Route::get('is_not_featured/{prod_id}', 'ProductController@is_not_featured');
    Route::get('update_product/{prod_id}', 'ProductController@update_product');
    Route::get('view_recycle_product', 'ProductController@view_recycle_product');
    Route::get('re_delete_product/{prod_id}', 'ProductController@re_delete_product');
    Route::get('find_product', 'ProductController@find_product');
    Route::get('view_detail_product/{prod_id}', 'ProductController@view_detail_product');

    Route::post('process_add_product', 'ProductController@process_add_product');
    Route::post('process_update_product/{prod_id}', 'ProductController@process_update_product');
    Route::post('soft_delete_product', 'ProductController@soft_delete_product');
    Route::post('delete_forever_product', 'ProductController@delete_forever_product');
    Route::post('filter_new_product', 'ProductController@filter_new_product');
    Route::post('filter_product_feature', 'ProductController@filter_product_feature');
    Route::post('filter_product_follow_cate', 'ProductController@filter_product_follow_cate');
    Route::post('filter_product_follow_cate_many', 'ProductController@filter_product_follow_cate_many');
    Route::post('filter_product_follow_storage', 'ProductController@filter_product_follow_storage');
    Route::post('filter_product_follow_storage_many', 'ProductController@filter_product_follow_storage_many');
    Route::post('filter_product_follow_price_choose', 'ProductController@filter_product_follow_price_choose');
    Route::post('filter_product_follow_price_cus_option', 'ProductController@filter_product_follow_price_cus_option');
    Route::post('filter_product_follow_rating_choose', 'ProductController@filter_product_follow_rating_choose');
    Route::post('filter_product_follow_date_create_single', 'ProductController@filter_product_follow_date_create_single');
    Route::post('filter_product_follow_date_create_many', 'ProductController@filter_product_follow_date_create_many');

    Route::post('print_pdf_product', 'ProductController@print_pdf_product');
    // PRODUCT IMAGE
    Route::get('all_gallery_product/{prod_id}', 'ImageProductController@all_gallery_product');
    Route::get('view_recycle_image_product/{prod_id}', 'ImageProductController@view_recycle_image_product');
    Route::get('restore_image_product/{image_id}', 'ImageProductController@restore_image_product');


    Route::post('process_add_image_product/{prod_id}', 'ImageProductController@process_add_image_product');
    Route::post('delete_soft_image_product', 'ImageProductController@delete_soft_image_product');
    Route::post('delete_forever_image_product', 'ImageProductController@delete_forever_image_product');

    // PRODUCT PRICE
    Route::get('history_price_product/{prod_id}', 'ProductPriceController@history_price_product');

    Route::post('update_price_product', 'ProductPriceController@update_price_product');
    Route::post('filter_price_product_history', 'ProductPriceController@filter_price_product_history');

    //PERMISSION
    Route::get('list_permission', 'AdminController@list_permission')->middleware('role_admin_manager');
    Route::post('assign_roles', 'AdminController@assign_roles')->middleware('role_admin_manager');
    //CATEGORY
    Route::get('all_category', 'CategoryController@show_category');
    Route::get('add_category', 'CategoryController@add_category');
    Route::get('update_category/{cate_id}', 'CategoryController@update_category');

    Route::post('process_add_category', 'CategoryController@process_add_category');
    Route::post('process_update_category/{cate_id}', 'CategoryController@process_update_category');
    Route::get('process_delete_category/{cate_id}', 'CategoryController@process_delete_category');

    Route::get('view_recycle_cate', 'CategoryController@view_recycle');
    Route::get('re_delete_cate/{cate_id}', 'CategoryController@re_delete');
    Route::post('delete_forever_cate', 'CategoryController@delete_forever');
    Route::get('delete_recovery_forever/{cate_id}', 'CategoryController@delete_recovery_forever');
    Route::post('soft_delete_cate', 'CategoryController@soft_delete');

    Route::get('find_category', 'CategoryController@find_category');

    //STORAGE
    Route::get('all_storage', 'StorageController@show_storage');
    Route::get('add_storage', 'StorageController@add_storage');
    Route::get('update_storage/{storage_id}', 'StorageController@update_storage');

    Route::post('process_add_storage', 'StorageController@process_add_storage');
    Route::post('process_update_storage', 'StorageController@process_update_storage');
    Route::get('process_delete_storage/{storage}', 'StorageController@process_delete_storage');

    Route::get('view_recycle_storage', 'StorageController@view_recycle');
    Route::get('re_delete_storage/{storage_id}', 'StorageController@re_delete');
    Route::post('delete_forever_storage', 'StorageController@delete_forever');
    Route::get('delete_recovery_forever_storage/{storage_id}', 'StorageController@delete_recovery_forever_storage');
    Route::post('soft_delete_storage', 'StorageController@soft_delete');

    Route::get('find_storage', 'StorageController@find_storage');
    Route::post('storage_id_update', 'StorageController@get_id_storage');

    //STORAGE_PRODUCT
    Route::get('all_storage_product/{storage_id}', 'StorageProductController@all_storage_product');
    Route::get('update_storage_product/{storage_product_id}', 'StorageProductController@update_storage_product');
    Route::get('import_storage_product/{storage_product_id}', 'StorageProductController@import_storage_product');
    Route::get('history_storage_product/{storage_product_id}', 'StorageProductController@history_storage_product');

    Route::post('process_update_storage_product/{storage_product_id}', 'StorageProductController@process_update_storage_product');
    Route::post('process_import_storage_product/{storage_product_id}', 'StorageProductController@process_import_storage_product');
    Route::get('process_delete_storage_product/{storage_product_id}', 'StorageProductController@process_delete_storage_product');

    Route::get('view_recycle_storage_product/{storage_id}', 'StorageProductController@view_recycle');
    Route::get('re_delete_storage_product/{storage_product_id}', 'StorageProductController@re_delete');
    Route::post('delete_forever_storage_product', 'StorageProductController@delete_forever');
    Route::get('delete_recovery_forever_storage_product/{storage_product_id}', 'StorageProductController@delete_recovery_forever_storage_product');
    Route::post('soft_delete_storage_product', 'StorageProductController@soft_delete');

    Route::post('find_storage_product', 'StorageProductController@find_storage_product');


    //ORDER
    Route::get('all_order', 'OrderController@all_order');
    Route::get('await_confirm_order', 'OrderController@await_confirm_order');
    Route::get('confirmed', 'OrderController@confirmed');
    Route::get('delivering', 'OrderController@delivering');
    Route::get('delivery_success', 'OrderController@delivery_success');
    Route::get('detail_order_item/{order_id}', 'OrderController@detail_order_item');
    Route::get('cancelled', 'OrderController@cancelled');

    Route::post('confirm_order', 'OrderController@confirm_order');
    Route::post('confirm_delivary_order', 'OrderController@confirm_delivary_order');
    Route::post('confirm_delivery_success_order', 'OrderController@confirm_delivery_success_order');
    Route::post('search_order', 'OrderController@search_order');

    // VOUCHER PRODUCT
    Route::get('all_voucher/{product_id}', 'VoucherController@all_voucher');
    Route::get('detail_voucher/{voucher_id}', 'VoucherController@detail_voucher');
    Route::get('add_voucher', 'VoucherController@add_voucher');
    Route::get('add_product_voucher/{product_id}', 'VoucherController@add_product_voucher');
    Route::get('update_voucher/{voucher_id}', 'VoucherController@update_voucher');
    Route::post('process_add_voucher', 'VoucherController@process_add_voucher');
    Route::post('process_update_voucher/{voucher_id}', 'VoucherController@process_update_voucher');
    Route::get('all_product_voucher', 'VoucherController@all_product_voucher');
    Route::post('get_voucher_id', 'VoucherController@get_voucher_id');
    Route::post('get_voucher_name', 'VoucherController@get_voucher_name');
    Route::post('get_voucher_product', 'VoucherController@get_voucher_product');
    Route::post('get_voucher_start_date', 'VoucherController@get_voucher_start_date');
    Route::post('get_voucher_end_date', 'VoucherController@get_voucher_end_date');
    Route::post('get_voucher_quantity', 'VoucherController@get_voucher_quantity');
    Route::post('get_voucher_amount', 'VoucherController@get_voucher_amount');
    Route::post('get_voucher_status', 'VoucherController@get_voucher_status');

    Route::get('find_product_voucher', 'VoucherController@find_product_voucher');

    // SLIDER
    Route::get('all_slider', 'SliderController@all_slider');
    Route::get('add_slider', 'SliderController@add_slider');
    Route::get('active_slider/{slider_id}', 'SliderController@active_slider');
    Route::get('unactive_slider/{slider_id}', 'SliderController@unactive_slider');
    Route::post('process_add_slider', 'SliderController@process_add_slider');
    Route::post('process_delete_slider', 'SliderController@process_delete_slider');

    // CUSTOMER
    Route::get('all_customer', 'CustomerAdminController@all_customer');
    Route::get('detail_customer/{customer_id}', 'CustomerAdminController@detail_customer');
    Route::get('find_customer', 'CustomerAdminController@find_customer');

    //DISCOUNT PRODUCT
    Route::get('all_discount', 'DiscountController@all_discount');
    Route::get('add_discount', 'DiscountController@add_discount');
    Route::get('update_discount/{discount_id}', 'DiscountController@update_discount');
    Route::get('detail_discount/{discount_id}', 'DiscountController@detail_discount');

    Route::post('process_add_discount', 'DiscountController@process_add_discount');
    Route::post('check_val_discount', 'DiscountController@check_val_discount');
    Route::post('check_val_discount_2', 'DiscountController@check_val_discount_2');
    Route::post('check_val_discount_update', 'DiscountController@check_val_discount_update');
    Route::post('check_val_discount_update_2', 'DiscountController@check_val_discount_update_2');
    Route::post('process_update_discount/{discount_id}', 'DiscountController@process_update_discount');
    Route::post('delete_discount', 'DiscountController@delete_discount');

    // PROCESS COMMENT
    Route::get('view_comment_to_process', 'CommentController@view_comment_to_process');
    Route::post('process_accep_comment', 'CommentController@process_accep_comment');
    Route::post('process_unaccep_comment', 'CommentController@process_unaccep_comment');



});

// FONT END
// NAV
Route::get('/', 'HomeClientController@index');
Route::get('shop_product', 'ShopController@shop_product');
Route::get('contact_us', 'HomeClientController@contact_us');
Route::get('terms_conditions', 'HomeClientController@terms_conditions');

//HOME -> SHOW
Route::get('show_all_product_discount', 'HomeClientController@show_all_product_discount');
Route::get('show_all_product_feature', 'HomeClientController@show_all_product_feature');
Route::get('show_all_product_recommend', 'HomeClientController@show_all_product_recommend');

// SHOP AJAX
Route::post('ajax_sort_cate_shop', 'ShopController@ajax_sort_cate_shop');
Route::post('ajax_sort_rating_shop', 'ShopController@ajax_sort_rating_shop');
Route::post('ajax_sort_price_enter_shop', 'ShopController@ajax_sort_price_enter_shop');

Route::post('sort_price_ajax_shop_select', 'ShopController@sort_price_ajax_shop_select');
Route::post('sort_rating_ajax_shop_select', 'ShopController@sort_rating_ajax_shop_select');
Route::post('sort_discount_ajax_shop_select', 'ShopController@sort_discount_ajax_shop_select');
Route::post('filter_modal_shop_ajax', 'ShopController@filter_modal_shop_ajax');

//detail product
Route::get('product_detail/{product_id}', 'HomeClientController@product_detail');
Route::get('buy_now/{product_id}', 'HomeClientController@buy_now');
Route::post('load_detail_product', 'HomeClientController@load_detail_product');
    //event card side detail
    Route::post('product_detail/load_detail_product', 'HomeClientController@load_detail_product');
    Route::post('product_detail/add_to_cart', 'CartController@add_cart');
    Route::post('product_detail/add_wish_list_ajax', 'WishListController@add_wish_list_ajax');
// search auto complete
Route::post('ajax_search_auto_complete', 'HomeClientController@ajax_search_auto_complete');
Route::post('search_product_form_search_auto_complete', 'HomeClientController@search_product_form_search_auto_complete');
//search ajax product follow keyword search
Route::post('ajax_search_cate_and_keyword', 'AjaxSearchProductKeyword@ajax_search_cate_and_keyword');
Route::post('ajax_search_rating_and_keyword', 'AjaxSearchProductKeyword@ajax_search_rating_and_keyword');
Route::post('ajax_search_price_and_keyword', 'AjaxSearchProductKeyword@ajax_search_price_and_keyword');
//sort ajax and keyword
Route::post('ajax_sort_price_and_keyword', 'AjaxSearchProductKeyword@ajax_sort_price_and_keyword');
Route::post('ajax_sort_rating_and_keyword', 'AjaxSearchProductKeyword@ajax_sort_rating_and_keyword');
Route::post('ajax_sort_discount_and_keyword', 'AjaxSearchProductKeyword@ajax_sort_discount_and_keyword');

//comment_rating
Route::post('add_comment_rating', 'HomeClientController@add_comment_rating');
Route::post('load_comment', 'HomeClientController@load_comment');
Route::post('load_more_comment', 'HomeClientController@load_more_comment');
Route::post('like_comment', 'HomeClientController@like_comment');
Route::post('delete_comment', 'HomeClientController@delete_comment');
Route::post('update_comment', 'HomeClientController@update_comment');


Route::get('user/account', 'AccountController@show_account');
Route::get('user/address', 'AccountController@address_account');
Route::get('user/resetpassword', 'AccountController@reset_password_account');
Route::get('user/order', 'AccountController@order_account');

// update account info
Route::post('update_info_account', 'AccountController@update_account');
Route::post('upload_avt_account', 'AccountController@upload_avt_account');

// USER RESETPASSWORD
Route::post('process_update_password_account', 'AccountController@process_update_password');

// USER ADDRESS
Route::post('process_add_address', 'AccountController@process_add_address');
Route::post('trans_id_update', 'AccountController@get_id_trans');
Route::post('get_phone_address', 'AccountController@get_phone_trans');
Route::post('get_address_detail_trans', 'AccountController@get_address_detail_trans');
Route::post('get_address_ward_trans', 'AccountController@get_address_ward_trans');
Route::post('get_address_district_trans', 'AccountController@get_address_district_trans');
Route::post('get_address_city_trans', 'AccountController@get_address_city_trans');

Route::post('process_update_address', 'AccountController@process_update_address');
Route::post('process_delete_address', 'AccountController@process_delete_address');
Route::post('process_mode_default', 'AccountController@process_mode_default');

Route::post('load_district', 'AddressController@load_district');
Route::post('load_ward', 'AddressController@load_ward');
Route::post('load_district_update_address_user', 'AddressController@load_district');
Route::post('load_ward_update_address_user', 'AddressController@load_ward');

// USER ORDER
Route::get('user/order/{order_id}', 'AccountController@order_detail_account');
Route::post('process_cancel_order', 'AccountController@process_cancel_order');

// CART
Route::post('add_to_cart', 'CartController@add_cart');
Route::post('load_quantity_cart', 'CartController@load_quantity_cart');
Route::post('show_mini_cart_when_add', 'CartController@show_mini_cart_when_add');

Route::post('update_qty_when_change', 'CartController@update_qty_when_change');
Route::post('update_qty_when_update_cart', 'CartController@update_qty_when_update_cart');


Route::get('show_cart', 'CartController@show_cart');
Route::post('update_cart', 'CartController@update_cart');
Route::post('update_cart_checkbox', 'CartController@update_cart_checkbox');
Route::post('check_quatity_blur', 'CartController@check_quatity_blur');
Route::post('remove_item_cart', 'CartController@remove_item_cart');
Route::post('get_val_checkbox', 'CartController@get_val_checkbox');

// WISH LIST
Route::post('add_wish_list_ajax', 'WishListController@add_wish_list_ajax');
Route::post('load_wish_list_ajax', 'WishListController@load_wish_list_ajax');
Route::post('count_total_wish_list_ajax', 'WishListController@count_total_wish_list_ajax');
Route::post('remove_item_wish_list', 'WishListController@remove_item_wish_list');

//CHECK OUT
Route::post('checkout', 'CheckOutController@show_checkout');
Route::post('add_address_trans', 'CheckOutController@add_address_trans');
Route::post('check_voucher_code_to_apply', 'CheckOutController@check_voucher_code_to_apply');

Route::post('check_qty_to_checkout', 'CheckOutController@check_qty_to_checkout');
Route::post('process_checkout', 'CheckOutController@process_checkout');
//Route::post('paypal_check_out', 'CheckOutController@paypal_check_out');
Route::get('view_checkout_paypal_success/{payment_method}/{summary_total_order}/{status}/{order_code}',
        'CheckOutController@view_checkout_paypal_success');
Route::get('view_checkout_paypal_fail/{order_id}', 'CheckOutController@view_checkout_paypal_fail');

Route::get('check_out_success', 'CheckOutController@check_out_success');

//CUSTOMER VOUCHER
Route::get('user/voucher', 'AccountController@show_voucher');
Route::post('process_save_voucher', 'StorageVoucherController@process_save_voucher');

// ADDRESS ADD ADDRESS ADMIN LOAD
Route::post('admin/load_district', 'AddressController@load_district');
Route::post('admin/load_ward', 'AddressController@load_ward');
//ADDRESS UPDATE ADDRESS ADDMIN LOAD
Route::post('admin/load_district_update_address_admin', 'AddressController@load_district');
Route::post('admin/load_ward_update_address_admin', 'AddressController@load_ward');
//ADDRESS UPDATE ADDRESS PROFILE ADDMIN LOAD
Route::post('admin/load_district_update_profile_admin', 'AddressController@load_district');
Route::post('admin/load_ward_update_address_profile_admin', 'AddressController@load_ward');

//ADDRESS ADD TRANS
Route::post('load_district', 'AddressController@load_district');
Route::post('load_ward', 'AddressController@load_ward');


// CKDITOR
Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
