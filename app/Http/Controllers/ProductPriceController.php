<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin_Action_Product_Price;
use App\ProductPrice;
use App\Product;
use Session;
use DB;
use Carbon\Carbon;

class ProductPriceController extends Controller
{
    public function history_price_product($prod_id){

        $product = Product::find($prod_id);
        $history_price = ProductPrice::where('product_id', $prod_id)->get();
        return view('admin.product_price.view_history_price',
            ['product'=>$product, 'history_price'=>$history_price]);
    }
    public function update_price_product(Request $request){
        $request-> validate([
            'price' =>'required|numeric|min:1000|max:10000000'
        ],[
            'price.required' =>  'Bạn chưa nhập giá sản phẩm',
            'price.numeric' =>  'Giá của sản phẩm phải là số',
            'price.min' =>  'Giá của sản phẩm không thể nhỏ hơn 1000 vnđ',
            'price.max' =>  'Giá của sản phẩm tối đa là 10000000 vnđ',
        ]);
        $price_id = $request->price_id;
        $price = $request->price;
        $product_id = $request->product_id;
        $price_old = ProductPrice::where('price_id',$price_id)->first();
        if($price_old->price == $price){
            $request->session()->flash('update_price_error', 'Cập nhật thất bại, bạn vẫn chưa thay đổi giá mới');
            return redirect()->back();
        }

        $update_status = ProductPrice::find($price_id);
        $update_status->status = 0;
        $update_status->save();

        $update_price = new ProductPrice();
        $update_price->product_id = $product_id;
        $update_price->price = $price;
        $update_price->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $result_update = $update_price->save();
        if($result_update){
            $request->session()->flash('update_price_success', 'Cập nhật thành công giá sản phẩm');

            $admin_action_product_price = new Admin_Action_Product_Price();
            $admin_action_product_price->admin_id = Session::get('admin_id');
            $admin_action_product_price->price_id = $price_id;
            $admin_action_product_price->action_id = 2;
            $admin_action_product_price->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $admin_action_product_price->action_message = 'Cập nhật giá sản phẩm';
            $admin_action_product_price->save();
        }
        return redirect()->back();
    }
}
