<?php

//LOGIN
Route::get('login', 'AuthController@show_login');
Route::post('process_login', 'AuthController@process_login');
Route::get('logout_admin', 'AuthController@logout_admin');

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
