<?php

//LOGIN

use App\Action;
use App\Admin_Action_Category;
use App\Http\Controllers\StorageProductController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

Route::get('login', 'AuthController@show_login');
Route::post('process_login', 'AuthController@process_login');
Route::get('logout_admin', 'AuthController@logout_admin');

Route::get('login_client', 'CustomerController@show_login');
Route::post('process_login_client', 'CustomerController@process_login');
Route::get('register_client', 'CustomerController@show_register');
Route::post('process_register_client', 'CustomerController@process_register');
Route::get('logout_client', 'CustomerController@logout_client');

// MIDDLEWARE PAGE ADMIN
// Route::group(['middleware'=>'roles'], function(){
//
// });

// GROUP ADMIN
Route::prefix('admin')->group(function () {
    // DASHBORD
    Route::get('dashboard', 'AdminController@index')->middleware('roles');
    // ADMIN
    Route::get('all_admin', 'AdminController@show_admin')->middleware('role_admin_manager');
    Route::get('add_admin', 'AdminController@add_admin');
    Route::get('update_admin/{admin_id}', 'AdminController@update_admin');
    Route::get('delete_admin/{admin_id}', 'AdminController@delete_admin');
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
    Route::post('process_update_storage/{storage}', 'StorageController@process_update_storage');
    Route::get('process_delete_storage/{storage}', 'StorageController@process_delete_storage');

    Route::get('view_recycle_storage', 'StorageController@view_recycle');
    Route::get('re_delete_storage/{storage_id}', 'StorageController@re_delete');
    Route::post('delete_forever_storage', 'StorageController@delete_forever');
    Route::get('delete_recovery_forever_storage/{storage_id}', 'StorageController@delete_recovery_forever_storage');
    Route::post('soft_delete_storage', 'StorageController@soft_delete');

    Route::get('find_storage', 'StorageController@find_storage');

    //STORAGE_PRODUCT
    Route::get('all_storage_product/{storage_id}', 'StorageProductController@all_storage_product');
    Route::get('update_storage_product/{storage_product_id}', 'StorageProductController@update_storage_product');
    Route::get('import_storage_product/{storage_product_id}', 'StorageProductController@import_storage_product');
    Route::get('history_storage_product/{storage_product_id}', 'StorageProductController@history_storage_product');

    Route::post('process_update_storage_product/{storage_product_id}', 'StorageProductController@process_update_storage_product');
    Route::post('process_import_storage_product/{storage_product_id}', 'StorageProductController@process_import_storage_product');
    Route::get('process_delete_storage_product/{storage_product_id}', 'StorageProductController@process_delete_storage_product');

    Route::get('view_recycle_storage_product', 'StorageProductController@view_recycle');
    Route::get('re_delete_storage_product/{StorageProduct_id}', 'StorageProductController@re_delete');
    Route::post('delete_forever_storage_product', 'StorageProductController@delete_forever');
    Route::get('delete_recovery_forever_storage_product/{storage_product_id}', 'StorageProductController@delete_recovery_forever_storage_product');
    Route::post('soft_delete_storage_product', 'StorageProductController@soft_delete');

    Route::post('find_storage_product', 'StorageProductController@find_storage_product');
    
});

// ADDRESS ADD ADDRESS ADMIN LOAD
Route::post('admin/load_district', 'AddressController@load_district');
Route::post('admin/load_ward', 'AddressController@load_ward');
//ADDRESS UPDATE ADDRESS ADDMIN LOAD
Route::post('admin/load_district_update_address_admin', 'AddressController@load_district');
Route::post('admin/load_ward_update_address_admin', 'AddressController@load_ward');
//ADDRESS UPDATE ADDRESS PROFILE ADDMIN LOAD
Route::post('admin/load_district_update_profile_admin', 'AddressController@load_district');
Route::post('admin/load_ward_update_address_profile_admin', 'AddressController@load_ward');
