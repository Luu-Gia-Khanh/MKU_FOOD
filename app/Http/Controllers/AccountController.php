<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function show_account(){
        return view('client.user.account');
    }

    public function address_account(){
        return view('client.user.address');
    }

    public function reset_password_account(){
        return view('client.user.resetpassword');
    }

    public function order_account(){
        return view('client.user.order');
    }
}
