<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;

class AjaxSearchProductKeyword extends Controller
{
    public function ajax_search_cate_and_keyword(Request $request){
        $keyword = $request->keyword_search;
        $cate_id = $request->cate_id;
        $result_search = DB::table('product')
            ->join('product_price', 'product_price.product_id', '=', 'product.product_id')
            ->join('category', 'category.cate_id', '=', 'product.category_id')
            ->where('product_price.status', 1)
            ->where('product_name','LIKE','%'.$keyword.'%')
            ->where('cate_id',$cate_id)
            ->get();
        echo view('client.home.list_item_search_keyword',[
            'result_search'=>$result_search
        ]);
    }
    public function ajax_search_rating_and_keyword(Request $request){
        $keyword = $request->keyword_search;
        $rating = $request->rating;

        $arrayProduct = array();
        $all_product = DB::table('product')
            ->join('product_price', 'product_price.product_id', '=', 'product.product_id')
            ->join('category', 'category.cate_id', '=', 'product.category_id')
            ->where('product_price.status', 1)
            ->where('product_name','LIKE','%'.$keyword.'%')
            ->get();

        $callFunction = new HomeClientController;
        foreach($all_product as $product){
            $check_rating = $callFunction->info_rating_saled($product->product_id);
            if($check_rating->avg_rating >= $rating){
                // $arrayProduct[] = [
                //     'product_id' => $product->product_id,
                //     'avg_rating' => $check_rating->avg_rating,
                //     'question_id' => '2',
                // ];
                $product->rating = $check_rating->avg_rating;
                $arrayProduct[] = $product;

            }

        }
        //sortByDesc ->(low to height)
        $orderByArrayProduct = collect($arrayProduct)->sortBy('rating')->reverse()->toArray();
        echo view('client.home.list_item_search_keyword',[
            'result_search'=>$orderByArrayProduct
        ]);

    }
    public function ajax_search_price_and_keyword(Request $request){
        $keyword = $request->keyword_search;
        $price_start = $request->price_start;
        $price_end = $request->price_end;

        $arrayProduct = array();
        $all_product = DB::table('product')
            ->join('product_price', 'product_price.product_id', '=', 'product.product_id')
            ->join('category', 'category.cate_id', '=', 'product.category_id')
            ->where('product_price.status', 1)
            ->where('product_name','LIKE','%'.$keyword.'%')
            ->get();

        $callFunction = new HomeClientController;
        foreach($all_product as $product){
            $check_price = $callFunction->check_price_discount($product->product_id);
            $price_now = number_format($check_price->price_now,0,',','');
            if($price_start <= $price_now && $price_now <= $price_end){
                $product->price_now =  $price_now;
                $arrayProduct[] = $product;
            }
        }
        $orderByArrayProduct = collect($arrayProduct)->sortBy('price_now')->reverse()->toArray();
        echo view('client.home.list_item_search_keyword',[
            'result_search'=>$orderByArrayProduct
        ]);

    }
    public function ajax_sort_price_and_keyword(Request $request){
        $keyword = $request->keyword_search;
        $val_sort_price = $request->val_sort_price;

        $arrayProduct = array();
        $all_product = DB::table('product')
            ->join('product_price', 'product_price.product_id', '=', 'product.product_id')
            ->join('category', 'category.cate_id', '=', 'product.category_id')
            ->where('product_price.status', 1)
            ->where('product_name','LIKE','%'.$keyword.'%')
            ->get();

        $callFunction = new HomeClientController;
        foreach($all_product as $product){
            $check_price = $callFunction->check_price_discount($product->product_id);
            $price_now = number_format($check_price->price_now,0,',','');
            $product->price_now =  $price_now;
            $arrayProduct[] = $product;
        }
        if($val_sort_price == 'desc'){
            $orderByArrayProduct = collect($arrayProduct)->sortByDesc('price_now')->reverse()->toArray();
        }
        else{
            $orderByArrayProduct = collect($arrayProduct)->sortBy('price_now')->reverse()->toArray();
        }

        echo view('client.home.list_item_search_keyword',[
            'result_search'=>$orderByArrayProduct
        ]);
    }
    public function ajax_sort_rating_and_keyword(Request $request){
        $keyword = $request->keyword_search;
        $sort_rating_fiter = $request->sort_rating_fiter;

        $arrayProduct = array();
        $all_product = DB::table('product')
            ->join('product_price', 'product_price.product_id', '=', 'product.product_id')
            ->join('category', 'category.cate_id', '=', 'product.category_id')
            ->where('product_price.status', 1)
            ->where('product_name','LIKE','%'.$keyword.'%')
            ->get();

        $callFunction = new HomeClientController;
        foreach($all_product as $product){
            $check_rating = $callFunction->info_rating_saled($product->product_id);

            $product->rating = $check_rating->avg_rating;
            $arrayProduct[] = $product;
        }
        if($sort_rating_fiter == 'desc'){
            $orderByArrayProduct = collect($arrayProduct)->sortByDesc('rating')->reverse()->toArray();
        }
        else{
            $orderByArrayProduct = collect($arrayProduct)->sortBy('rating')->reverse()->toArray();
        }

        echo view('client.home.list_item_search_keyword',[
            'result_search'=>$orderByArrayProduct
        ]);
    }
    public function ajax_sort_discount_and_keyword(Request $request){
        $keyword = $request->keyword_search;
        $sort_discount_fiter = $request->sort_discount_fiter;

        $arrayProduct = array();
        $all_product = DB::table('product')
            ->join('product_price', 'product_price.product_id', '=', 'product.product_id')
            ->join('category', 'category.cate_id', '=', 'product.category_id')
            ->where('product_price.status', 1)
            ->where('product_name','LIKE','%'.$keyword.'%')
            ->get();

        $callFunction = new HomeClientController;
        foreach($all_product as $product){
            $check_price = $callFunction->check_price_discount($product->product_id);
            $product->percent_discount =  $check_price->percent_discount;
            $arrayProduct[] = $product;
        }
        if($sort_discount_fiter == 'desc'){
            $orderByArrayProduct = collect($arrayProduct)->sortByDesc('percent_discount')->reverse()->toArray();
        }
        else{
            $orderByArrayProduct = collect($arrayProduct)->sortBy('percent_discount')->reverse()->toArray();
        }

        echo view('client.home.list_item_search_keyword',[
            'result_search'=>$orderByArrayProduct
        ]);
    }
}
