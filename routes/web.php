<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('client', function () {
    return view('client.layout_client');
});
Route::get('dashboard', 'AdminController@index');//->middleware('roles')

//ADMIN
Route::prefix('admin')->group(function () {
    Route::get('all_admin', 'AdminController@show_admin');
});

//PERMISSION<<ADMIN>>




//LOGIN
Route::get('login', 'AuthController@show_login');
Route::post('process_login', 'AuthController@process_login');
Route::get('logout_admin', 'AuthController@logout_admin');

Route::group(['middleware'=>'roles'], function(){
    Route::get('list_permission', 'AdminController@list_permission');
    Route::post('assign_roles', 'AdminController@assign_roles');
});
