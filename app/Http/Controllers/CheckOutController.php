<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\ProductPrice;
use DB;
use App\Customer_Transport;
use Session;

Session::start();
class CheckOutController extends Controller
{
    public function show_checkout(Request $request){

        $arrCart_id = $request->itemCart;
        $all_cart = Cart::where('status', 1)->get();
        $all_product = Product::all();
        $product_price = ProductPrice::where('status',1)->get();
        $citys = DB::table('tinhthanhpho')->get();

        $customer_id = Session::get('customer_id');
        $static_trans = Customer_Transport::where('trans_status', 1)->where('customer_id',$customer_id)->first();
        $cus_trans = Customer_Transport::where('customer_id',$customer_id)->get();
        return view('client.checkout.checkout',[
            'arrCart_id' => $arrCart_id,
            'all_cart' => $all_cart,
            'all_product' => $all_product,
            'product_price' => $product_price,
            'citys' => $citys,
            'static_trans' =>$static_trans,
            'cus_trans' =>$cus_trans,
        ]);
    }
    public function add_address_trans(Request $request){
        $name = $request->fullname;
        $phone = $request->phone;
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        $detail_address = $request->detail_address;

        $find_city = DB::table('tinhthanhpho')->where('matp',$city)->first();
        $txt_city = $find_city->name_tp;
        $find_district = DB::table('quanhuyen')->where('maqh',$district)->first();
        $txt_district = $find_district->name_qh;
        $find_ward = DB::table('xaphuongthitran')->where('xaid',$ward)->first();
        $txt_ward = $find_ward->name_xa;

        $address_trans = $detail_address.', '.$txt_ward.', '.$txt_district.', '.$txt_city.'.';
        $customer_id = Session::get('customer_id');
        $find_static = Customer_Transport::where('trans_status', 1)->where('customer_id', $customer_id)->first();
        if($find_static){
            $add_address_trans = new Customer_Transport();
            $add_address_trans->customer_id = $customer_id;
            $add_address_trans->trans_fullname = $name;
            $add_address_trans->trans_phone = $phone;
            $add_address_trans->trans_address = $address_trans;
            $add_address_trans->save();
        }
        else{
            $add_address_trans = new Customer_Transport();
            $add_address_trans->customer_id = $customer_id;
            $add_address_trans->trans_fullname = $name;
            $add_address_trans->trans_phone = $phone;
            $add_address_trans->trans_address = $address_trans;
            $add_address_trans->trans_status = 1;
            $add_address_trans->save();
        }



    }
}
