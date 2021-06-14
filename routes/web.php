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
    Route::get('list_permission', 'AdminController@list_permission')->middleware('role_admin_manager');
    Route::post('assign_roles', 'AdminController@assign_roles')->middleware('role_admin_manager');
});

