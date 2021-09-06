<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use App\User;
use Session;
Session::start();
class AuthController extends Controller
{
    public function show_login(){
        return view('admin.login.login_admin');
    }
    public function process_login(Request $request){
        if(Auth::attempt(['admin_email' => $request->email, 'password' => $request->password])){
            Session::put('admin_id', Auth::user()->admin_id);
            Session::put('admin_name', Auth::user()->admin_name);
            Session::put('admin_image', Auth::user()->avt);
            return redirect('admin/');
        }
        else{
            return redirect('login')->withErrors('ERROR');
        }
    }
    public function logout_admin(){
        Auth::logout();
        Session::forget('admin_id');
        Session::forget('admin_name');
        Session::forget('admin_image');
        return redirect('login');
    }
}
