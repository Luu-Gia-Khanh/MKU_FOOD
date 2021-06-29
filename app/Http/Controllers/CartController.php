<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Session;
use Carbon\Carbon;
use App\Storage_Product;
use App\Product;
use App\ProductPrice;

Session::start();
class CartController extends Controller
{
    public function add_cart(Request $request){
        $product_id = $request->product_id;
        $qty = $request->qty;
        $customer_id = Session::get('customer_id');

        $product_storage = Storage_Product::where('product_id',$product_id)->first();
        $product_storage_quantity = $product_storage->total_quantity_product;
        if($qty <= $product_storage_quantity){
            $check_cart = Cart::where('customer_id',$customer_id)->where('product_id',$product_id)->first();
            if($check_cart){
                $total_quantity_cart = $qty + $check_cart->quantity;
                if($total_quantity_cart <= $product_storage_quantity){
                    $cart_id = $check_cart->cart_id;
                    $update_cart = Cart::find($cart_id);
                    $update_cart->quantity = $check_cart->quantity + $qty;
                    $update_cart->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $update_cart->save();
                    echo 1;
                }
                else{
                    echo 0;
                }
            }
            else{
                $add_cart = new Cart();
                $add_cart->customer_id = $customer_id;
                $add_cart->product_id = $product_id;
                $add_cart->quantity = $qty;
                $add_cart->save();
                echo 1;
            }
        }
        else{
            echo 0;
        }


    }
    public function load_quantity_cart(){
        $all_cart = Cart::all();
        echo count($all_cart);
    }
    public function show_cart(){
        $customer_id = Session::get('customer_id');
        $all_cart = Cart::where('customer_id',$customer_id)->get();
        $all_product = Product::all();
        $product_storage = Storage_Product::all();
        $product_price = ProductPrice::where('status',1)->get();
        return view('client.cart.show_cart',[
            'all_cart' => $all_cart,
            'all_product' => $all_product,
            'product_storage' => $product_storage,
            'product_price' => $product_price
        ]);
    }
    public function update_cart(Request $request){
        $cart_id = $request->cart_id;
        $qty = $request->qty;
        $customer_id = Session::get('customer_id');
        $cart = Cart::find($cart_id);

        $product_storage = Storage_Product::where('product_id',$cart->product_id)->first();
        $product_storage_quantity = $product_storage->total_quantity_product;
        if($qty <= $product_storage_quantity && $qty > 0){
            $update_cart = Cart::find($cart_id);
            $update_cart->quantity = $qty;
            $update_cart->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $update_cart->save();
            echo $qty;
        }
        else{
            echo 0;
        }
    }
    public function check_quatity_blur(Request $request){
        $cart_id = $request->cart_id;
        $cart = Cart::find($cart_id);
        $litmit_qty = Storage_Product::where('product_id',$cart->product_id)->first();
        echo $litmit_qty->total_quantity_product;
    }
}
