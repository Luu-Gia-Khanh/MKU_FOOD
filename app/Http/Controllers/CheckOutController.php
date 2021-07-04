<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\ProductPrice;


class CheckOutController extends Controller
{
    public function show_checkout(Request $request){
        $arrCart_id = $request->itemCart;
        $all_cart = Cart::where('status', 1)->get();
        $all_product = Product::all();
        $product_price = ProductPrice::where('status',1)->get();
        return view('client.checkout.checkout',[
            'arrCart_id' => $arrCart_id,
            'all_cart' => $all_cart,
            'all_product' => $all_product,
            'product_price' => $product_price,
        ]);
    }
}
