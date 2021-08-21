<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Customer_Info;
use App\Customer_Transport;
use App\Http\Controllers\Controller;
use App\Order_Detail_Status;
use App\Order_Item;
use App\Orders;
use App\Product;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerAdminController extends Controller
{
    //
    public function all_customer(){
        $all_customer_info = Customer_Info::all();
        $all_customer = Customer::paginate(10);
        return view('admin.customer.all_customer', compact('all_customer_info', 'all_customer'));
    }
    public function detail_customer($customer_id){
        $customer = Customer::where('customer_id', $customer_id)->first();
        $customer_info = Customer_Info::where('customer_id', $customer_id)->first();
        $customer_trans = Customer_Transport::where('customer_id', $customer_id)->where('trans_status', 1)->first();
        $all_order = Orders::where('customer_id', $customer_id)->orderBy('create_at', 'desc')->get();
        $all_order_item = Order_Item::all();
        $all_product = Product::all();
        $all_order_detail_status = Order_Detail_Status::all();
        $status_order = DB::table('status_order')->get();
        $trans = Customer_Transport::all();
        $payment_method = DB::table('payment_method')->get();
        $all_voucher = Voucher::all();
        return view('admin.customer.detail_customer', compact('customer', 'customer_info', 'customer_trans',
                                                                'all_order', 'all_order_item', 'all_product',
                                                                'all_order_detail_status', 'status_order', 
                                                                'payment_method', 'trans', 'all_voucher'));
    }
    public function find_customer(Request $request){
        $val_find_customer = $request->value_find;
        $all_customer_info = Customer_Info::all();
        $find_result_customer = Customer::where('username', 'LIKE','%'.$val_find_customer.'%')
                                        ->orwhere('email','LIKE','%'.$val_find_customer.'%')
                                        ->get();
        return view('admin.customer.find_result_customer', compact('all_customer_info','find_result_customer'));
    }
}
