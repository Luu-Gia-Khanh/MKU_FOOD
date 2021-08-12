<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
}
