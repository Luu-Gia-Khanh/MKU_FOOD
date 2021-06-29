<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductPrice;
use App\ImageProduct;
use App\Cart;
use App\Storage_Product;
use Session;

Session::start();
class HomeClientController extends Controller
{
    public function index(){
        $customer_id = Session::get('customer_id');
        $all_category = Category::all();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();
        $all_cart = Cart::where('customer_id', $customer_id)->get();
        $product_storage = Storage_Product::all();
        return view('client.home.trangchu',[
            'all_category'=>$all_category,
            'all_product'=>$all_product,
            'all_price' =>$all_price,
            'all_cart' => $all_cart,
            'product_storage' => $product_storage,
        ]);
    }
    public function product_detail($product_id){
        $customer_id = Session::get('customer_id');
        $product = Product::find($product_id);
        $cate = Category::where('cate_id',$product->category_id)->first();
        $price = ProductPrice::where('product_id',$product_id)->where('status', 1)->first();
        $all_image = ImageProduct::where('product_id',$product_id)->get();
        $all_cart = Cart::where('customer_id', $customer_id)->get();
        $product_storage = Storage_Product::all();
        return view('client.home.product_detail',[
            'product'=>$product,
            'cate'=>$cate,
            'price'=>$price,
            'all_image'=>$all_image,
            'all_cart' => $all_cart,
            'product_storage' => $product_storage,
        ]);
    }
}
