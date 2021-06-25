<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    //
    public function show_login() {
        return view('client.login.login_client');
    }

    public function process_login(Request $request){
        $check_customer_login = Customer::where('email', $request->email)->where('password', md5($request->password))->first();

        if(!empty($check_customer_login)){
            Session::put('customer_id', $check_customer_login->customer_id);
            Session::put('username', $check_customer_login->username);

            echo 'dang nhap thanh cong';
        }
        else {
            return redirect('login_client')->withErrors('Email hoặc Password không đúng');
        }
    }

    public function show_register(){
        return view('client.login.register_client');
    }

    public function process_register(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|min:3|max:100',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ],[
            'username.required' => 'Username không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.min' => 'Email phải có độ dài tối thiểu 3 ký tự',
            'email.max' => 'Email phải có độ dài tối đa 100 ký tự',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có độ dài tối thiểu 8 ký tự',
            'password_confirmation.required' => 'Confirm Password không được để trống',
            'password_confirmation.same' => 'Password không khớp',
        ]);

        $check_email_register = Customer::where('email', $request->email)->get();

        if (count($check_email_register) > 0){
            return redirect('register_client')->withErrors('Email Đã tồn tại');
        }
        else{

            $customer_register = new Customer();
            $customer_register->username = $request->username;
            $customer_register->email = $request->email;
            $customer_register->password = md5($request->password);
            $customer_register->save();

            echo 'dang ky thanh cong';
        }
    }

    public function logout_client() {

        Session::forget('customer_id');
        Session::forget('username');

        return redirect('login_client');
    }
}
