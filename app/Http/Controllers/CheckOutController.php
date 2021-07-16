<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\ProductPrice;
use App\Orders;
use App\Order_Item;
use App\Order_Detail_Status;
use App\Storage_Product;
use DB;
use App\Customer_Transport;
use Session;
use Carbon\Carbon;

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
    function generateRandomString($length = 4) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function check_qty_to_checkout(Request $request){
        $trans_id = $request->trans_id;
        $payment_method = $request->payment_method;
        $cart_id = $request->cart_id;
        $summary_total_order = $request->summary_total_order;
        $date = date('Ymd');
        $check = 1;
        $all_storage_product = Storage_Product::all();
        foreach ($cart_id as $id){
            $cart = Cart::find($id);
            foreach ($all_storage_product as $storage_product){
                if($cart->product_id == $storage_product->product_id){
                    $qty_cart = $cart->quantity;
                    $qty_sto = $storage_product->total_quantity_product;
                    if($qty_cart > $qty_sto){
                        $check = 0;

                    }
                    else{
                        $check = 1;
                    }
                }
            }
        }
        echo $check;
    }
    public function process_checkout(Request $request){

        $trans_id = $request->trans_id;
        $payment_method = $request->payment_method;
        $cart_id = $request->cart_id;
        $summary_total_order = $request->summary_total_order;
        $date = date('Ymd');

        $all_storage_product = Storage_Product::all();
        if($payment_method == 0){
            $orders = new Orders();
            $orders->order_code = $date.''.$this->generateRandomString();
            $orders->customer_id = Session::get('customer_id');
            $orders->total_price = $summary_total_order;
            $orders->payment_id = $payment_method;
            $orders->trans_id = $trans_id;
            $orders->create_at = Carbon::now('Asia/Ho_Chi_Minh');
            $orders->save();
            //
            foreach ($cart_id as $id){
                $cart = Cart::find($id);

                $order_item = new Order_Item();
                $order_item->product_id = $cart->product_id;
                $order_item->order_id = $orders->order_id;
                $order_item->quantity_product = $cart->quantity;

                //
                $price_product = ProductPrice::where('product_id',$cart->product_id)->where('status',1)->first();
                $order_item->price_product = $price_product->price;
                $order_item->save();

                foreach ($all_storage_product as $storage_product){
                    if($cart->product_id == $storage_product->product_id){
                        $qty_cart = $cart->quantity;
                        $qty_sto = $storage_product->total_quantity_product;
                        $update_storage_product = Storage_Product::where('product_id',$storage_product->product_id)->first();
                        $update_storage_product -> total_quantity_product = $qty_sto - $qty_cart;
                        $update_storage_product->save();
                    }
                }

                $delete_cart = Cart::find($id);
                $delete_cart->delete();
            }

            //
            $order_detail_status = new Order_Detail_Status();
            $order_detail_status->order_id = $orders->order_id;
            $order_detail_status->status_id = 1;
            $order_detail_status->time_status = Carbon::now('Asia/Ho_Chi_Minh');
            $order_detail_status->status = 1;
            $order_detail_status->save();

            return view('client.checkout.view_checkout_success',[
                'orders' => $orders,
                'payment_method' => $payment_method,
                'summary_total_order' => $summary_total_order,
                'status' => $orders->status,
            ]);
        }
        else{
            $orders = new Orders();
            $orders->order_code = $date.''.$this->generateRandomString();
            $orders->customer_id = Session::get('customer_id');
            $orders->total_price = $summary_total_order;
            $orders->payment_id = $payment_method;
            $orders->trans_id = $trans_id;
            $orders->status_pay = 1;
            $orders->create_at = Carbon::now('Asia/Ho_Chi_Minh');
            $orders->save();
            //
            foreach ($cart_id as $id){
                $cart = Cart::find($id);

                $order_item = new Order_Item();
                $order_item->product_id = $cart->product_id;
                $order_item->order_id = $orders->order_id;
                $order_item->quantity_product = $cart->quantity;

                //
                $price_product = ProductPrice::where('product_id',$cart->product_id)->where('status',1)->first();
                $order_item->price_product = $price_product->price;
                $order_item->save();

                foreach ($all_storage_product as $storage_product){
                    if($cart->product_id == $storage_product->product_id){
                        $qty_cart = $cart->quantity;
                        $qty_sto = $storage_product->total_quantity_product;
                        $update_storage_product = Storage_Product::where('product_id',$storage_product->product_id)->first();
                        $update_storage_product -> total_quantity_product = $qty_sto - $qty_cart;
                        $update_storage_product->save();
                    }
                }

                $delete_cart = Cart::find($id);
                $delete_cart->delete();
            }

            //
            $order_detail_status = new Order_Detail_Status();
            $order_detail_status->order_id = $orders->order_id;
            $order_detail_status->status_id = 1;
            $order_detail_status->time_status = Carbon::now('Asia/Ho_Chi_Minh');
            $order_detail_status->status = 1;
            $order_detail_status->save();

            $vnd_to_usd = $summary_total_order/23022;
            return view('client.checkout.check_out_paypal',['vnd_to_usd'=>$vnd_to_usd]);
        }
    }
    public function check_out_success(){
        return view('client.checkout.view_checkout_success');
    }
    public function paypal_check_out(Request $request){

        $total_price = $request->price_checkout_paypal;
        return view('client.checkout.check_out_paypal',['total_price'=>$total_price]);
    }
}
