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

Route::get('dashboard', function () {
    return view('admin.dashboard.dashbord');
});

Route::get('client', function () {
    return view('client.layout_client');
});
Route::get('trangchu', function () {
    return view('client.home.trangchu');
});
