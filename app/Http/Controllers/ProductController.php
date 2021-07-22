<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Unit;
use App\Storage;
use App\Product;
use App\ProductPrice;
use App\Storage_Product;
use App\ImageProduct;
use App\Admin_Action_Storage_Product;
use App\Admin_Action_Product;
use App\Admin_Action_Product_Price;
use Session;
use DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function add_product(){
        $category = Category::all();
        $unit_product = Unit::all();
        $storage = Storage::all();
        return view('admin.product.add_product',
                ['category'=>$category,'unit_product'=>$unit_product,'storage'=>$storage]);
    }
    public function process_add_product(Request $request){
        $this->Validate_Product($request);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->category_id = $request->cate_id;
        $product->unit_id = $request->unit_id;
        $product->product_sort_desc = $request->product_sort_desc;
        $product->product_desc = $request->product_desc;
        $get_image = $request->file('product_image');
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $product->product_image = $new_image;
        }
        else{
            $product->product_image = ('default_image79.png');
        }
        $result_add_product = $product->save();
        if(!$result_add_product){
            $request->session()->flash('add_product_error', 'Thêm sản phẩm thất bại');
            return redirect()->back();
        }

        $admin_action_product = new Admin_Action_Product();
        $admin_action_product->admin_id = Session::get('admin_id');
        $admin_action_product->product_id = $product->product_id;
        $admin_action_product->action_id = 1;
        $admin_action_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $admin_action_product->action_message = 'Thêm sản phẩm';
        $result_add_admin_action_product = $admin_action_product->save();
        if(!$result_add_admin_action_product){
            $request->session()->flash('admin_action_product_error', 'admin action product fail');
            return redirect()->back();
        }

        $product_price = new ProductPrice();
        $product_price->product_id = $product->product_id;
        $product_price->price = $request->product_price;
        $product_price->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $result_add_product_price = $product_price->save();
        if(!$result_add_product_price){
            $request->session()->flash('add_product_price_error', 'Thêm giá sản phẩm thất bại');
            return redirect()->back();
        }

        $admin_action_product_price = new Admin_Action_Product_Price();
        $admin_action_product_price->admin_id = Session::get('admin_id');
        $admin_action_product_price->price_id = $product_price->price_id;
        $admin_action_product_price->action_id = 1;
        $admin_action_product_price->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $admin_action_product_price->action_message = 'Thêm giá sản phẩm';
        $result_add_admin_action_product_price = $admin_action_product_price->save();
        if(!$result_add_admin_action_product_price){
            $request->session()->flash('admin_action_product_price_error', 'admin action product price fail');
            return redirect()->back();
        }

        $storage_product = new Storage_Product();
        $storage_product->storage_id = $request->storage_id;
        $storage_product->product_id = $product->product_id;
        $total_quantity_product = $request->product_quantity;
        if($total_quantity_product){
            $storage_product->total_quantity_product = $request->product_quantity;
        }
        else{
            $storage_product->total_quantity_product = 0;
        }
        $result_add_storage_product = $storage_product->save();
        if(!$result_add_storage_product){
            $request->session()->flash('add_storage_product_error', 'Thêm số lượng vào kho sản phẩm thất bại');
            return redirect()->back();
        }

        $admin_action_storage_product = new Admin_Action_Storage_Product();
        $admin_action_storage_product->admin_id = Session::get('admin_id');
        $admin_action_storage_product->storage_product_id = $storage_product->storage_product_id;
        $admin_action_storage_product->action_id = 1;
        $admin_action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $admin_action_storage_product->action_message = 'Thêm số lượng sản phẩm';
        $result_admin_action_storage_product = $admin_action_storage_product->save();
        if(!$result_admin_action_storage_product){
            $request->session()->flash('admin_action_add_storage_product_error', 'Admin action storage product fail');
            return redirect()->back();
        }

        $request->session()->flash('add_product_success', 'Thêm sản phẩm mới thành công');
        return redirect('admin/all_product');
    }
    public function all_product(){
        $all_product = Product::paginate(5);
        $all_unit = Unit::all();
        $all_cate = Category::all();
        $all_storage = Storage::all();
        $storage_product = Storage_Product::all();
        $product_price = DB::table('product_price')->where('status', 1)->get();
        //
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $day_now = date('d', strtotime($now));
        $month_now = date('m', strtotime($now));
        $year_now = date('Y', strtotime($now));
        foreach ($all_product as $prod){
            $prod_id = $prod->product_id;
            $time_cre = $prod->create_at;
            $day_cre = date('d', strtotime($time_cre));
            $month_cre = date('m', strtotime($time_cre));
            $year_cre = date('Y', strtotime($time_cre));
            $check_time = $this->convert_day($month_now, $day_now) - $this->convert_day($month_cre, $day_cre);
            if($check_time > 1 && $year_cre == $year_now){
                DB::table('product')->where('product_id',$prod->product_id)->update(['is_new'=>0]);
            }else{
                DB::table('product')->where('product_id',$prod->product_id)->update(['is_new'=>1]);
            }
        }
        return view('admin.product.all_product',
            [
                'all_product'=> $all_product,
                'all_unit'=> $all_unit,
                'all_cate'=> $all_cate,
                'product_price'=> $product_price,
                'all_storage' => $all_storage,
                'storage_product' => $storage_product,
            ]);
    }
    public function is_featured(Request $request,$prod_id){
        $is_featured = DB::table('product')->where('product_id',$prod_id)->update(['is_featured'=>1]);
        $request->session()->flash('change_status', 'Thay đổi trạng thái thành công');
        return redirect()->back();
    }
    public function is_not_featured(Request $request,$prod_id){
        $is_not_featured = DB::table('product')->where('product_id',$prod_id)->update(['is_featured'=>0]);
        $request->session()->flash('change_status', 'Thay đổi trạng thái thành công');
        return redirect()->back();
    }
    public function update_product($prod_id){
        $update_product = Product::find($prod_id);
        $category = Category::all();
        $unit_product = Unit::all();
        $storage = Storage::all();
        $storage_product = Storage_Product::where('product_id', $prod_id)->first();
        return view('admin.product.update_product',
        [
            'update_product'=>$update_product,
            'category' => $category,
            'unit_product' => $unit_product,
            'storage' => $storage,
            'storage_product' => $storage_product,
        ]);
    }
    public function process_update_product(Request $request, $prod_id){
        $this->Validate_Product_Update($request);

        $update_product = Product::find($prod_id);
        $update_product->product_name = $request->product_name;
        $update_product->category_id = $request->cate_id;
        $update_product->unit_id = $request->unit_id;
        $update_product->product_sort_desc = $request->product_sort_desc;
        $update_product->product_desc = $request->product_desc;
        $get_image = $request->file('product_image');
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $update_product->product_image = $new_image;
            $result_update_product = $update_product->save();
            if($result_update_product){
                $admin_action_product = new Admin_Action_Product();
                $admin_action_product->admin_id = Session::get('admin_id');
                $admin_action_product->product_id = $prod_id;
                $admin_action_product->action_id = 2;
                $admin_action_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $admin_action_product->action_message = 'Sửa thông tin sản phẩm';
                $admin_action_product->save();
                $request->session()->flash('update_product_success', 'Chỉnh sửa sản phẩm thành công');
            }
        }
        else{
            $result_update_product = $update_product->save();
            if($result_update_product){
                $admin_action_product = new Admin_Action_Product();
                $admin_action_product->admin_id = Session::get('admin_id');
                $admin_action_product->product_id = $prod_id;
                $admin_action_product->action_id = 2;
                $admin_action_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $admin_action_product->action_message = 'Sửa thông tin sản phẩm';
                $admin_action_product->save();
                $request->session()->flash('update_product_success', 'Chỉnh sửa sản phẩm thành công');
            }
        }
        $storage_product = Storage_Product::where('product_id', $prod_id)->first();
        $storage_product->storage_id = $request->storage_id;
        $result_update_storage_product = $storage_product->save();
        if($result_update_storage_product){
            $admin_action_storage_product = new Admin_Action_Storage_Product();
            $admin_action_storage_product->admin_id = Session::get('admin_id');
            $admin_action_storage_product->storage_product_id = $storage_product->storage_product_id;
            $admin_action_storage_product->action_id = 2;
            $admin_action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $admin_action_storage_product->action_message = 'Sửa thông tin kho của kho sản phẩm';
            $admin_action_storage_product->save();
        }

        return redirect('admin/all_product');

    }
    public function soft_delete_product(Request $request){
        $product_id = $request->product_id;
        $quantity_product = Storage_Product::where('product_id', $product_id)->first();
        if($quantity_product->total_quantity_product != 0){
            $request->session()->flash('delete_error', 'Sản phẩm chưa hết hàng, không thể xóa');
            return redirect()->back();
        }else{
            $soft_delete_storage_product = Storage_Product::where('product_id', $product_id)->delete();
            $soft_delete_product = Product::where('product_id', $product_id)->delete();
            if($soft_delete_product){
                $admin_action_product = new Admin_Action_Product();
                $admin_action_product->admin_id = Session::get('admin_id');
                $admin_action_product->product_id = $product_id;
                $admin_action_product->action_id = 3;
                $admin_action_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $admin_action_product->action_message = 'Xóa product';
                $admin_action_product->save();
                $request->session()->flash('delete_success', 'Xóa thành công');
                return redirect()->back();
            }
        }
    }
    public function view_recycle_product(){
        $recycle_item = Product::onlyTrashed()->get();
        return view('admin.product.all_recycle_product',['recycle_item'=>$recycle_item]);
    }
    public function re_delete_product($prod_id, Request $request){
        $restore_product = Product::withTrashed()->where('product_id', $prod_id)->restore();
        $restore_storage_product = Storage_Product::withTrashed()->where('product_id', $prod_id)->restore();
        if($restore_product && $restore_storage_product){
            $admin_action_product = new Admin_Action_Product();
            $admin_action_product->admin_id = Session::get('admin_id');
            $admin_action_product->product_id = $prod_id;
            $admin_action_product->action_id = 4;
            $admin_action_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $admin_action_product->action_message = 'Khôi phục sản phẩm từ thùng rác';
            $admin_action_product->save();
        }
        $request->session()->flash('restore_success', 'Khôi phục thành công');
        return redirect()->back();
    }
    public function delete_forever_product(Request $request){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $product_id = $request->product_id_delete_forever;
        $delete_forever_product = Product::withTrashed()->where('product_id', $product_id)->forceDelete();
        $delete_forever_storage_product = Storage_Product::withTrashed()->where('product_id', $product_id)->forceDelete();
        $delete_forever_image_product = ImageProduct::withTrashed()->where('product_id', $product_id)->forceDelete();
        $delete_forever_product_price = ProductPrice::withTrashed()->where('product_id', $product_id)->forceDelete();
        if($delete_forever_product){
            $admin_action_product = new Admin_Action_Product();
            $admin_action_product->admin_id = Session::get('admin_id');
            $admin_action_product->product_id = $product_id;
            $admin_action_product->action_id = 5;
            $admin_action_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $admin_action_product->action_message = 'Xóa vĩnh viễn sản phẩm';
            $admin_action_product->save();
        }
        $request->session()->flash('delete_product_forever_success', 'Xóa thành công sản phẩm');
        return redirect()->back();
    }
    public function find_product(Request $request){
        $val_find = $request->val_find;
        $all_product = DB::table('product')->where('deleted_at', null)
            ->where('product_name','LIKE','%'.$val_find.'%')
            ->get();
        $all_unit = Unit::all();
        $all_cate = Category::all();
        $all_storage = Storage::all();
        $storage_product = Storage_Product::all();
        $product_price = DB::table('product_price')->where('status', 1)->get();
        //
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $day_now = date('d', strtotime($now));
        $month_now = date('m', strtotime($now));
        $year_now = date('Y', strtotime($now));
        foreach ($all_product as $prod){
            $prod_id = $prod->product_id;
            $time_cre = $prod->create_at;
            $day_cre = date('d', strtotime($time_cre));
            $month_cre = date('m', strtotime($time_cre));
            $year_cre = date('Y', strtotime($time_cre));
            $check_time = $day_now - $day_cre;
            if($check_time > 1 && $month_now == $month_cre && $year_cre == $year_now){
                DB::table('product')->where('product_id',$prod->product_id)->update(['is_new'=>0]);
            }else{
                DB::table('product')->where('product_id',$prod->product_id)->update(['is_new'=>1]);
            }
        }
        echo view('admin.product.view_find_product',[
            'all_product'=>$all_product,
            'all_unit'=>$all_unit,
            'all_cate'=>$all_cate,
            'product_price'=>$product_price,
            'all_storage' =>$all_storage,
            'storage_product' =>$storage_product,
        ]);
    }
    public function view_detail_product($prod_id){
        $product = Product::find($prod_id);
        $all_cate = Category::all();
        $all_unit = Unit::all();
        $product_price = ProductPrice::where('product_id', $prod_id)->where('status',1)->first();
        $storage_product = Storage_Product::where('product_id', $prod_id)->first();
        $all_storage = Storage::all();
        return view('admin.product.view_detail_product',
            [
                'product'=>$product,
                'all_unit'=>$all_unit,
                'all_cate'=>$all_cate,
                'product_price'=>$product_price,
                'all_storage'=> $all_storage,
                'storage_product'=>$storage_product
            ]);
    }
    //Validate
    public function Validate_Product(Request $request){
        $request->validate([
            'product_name' =>'required',
            'cate_id' => 'required',
            'product_price' => 'required|numeric|min:1000|max:10000000',
            'unit_id' => 'required',
            'storage_id' => 'required',
            'product_quantity' => 'nullable|alpha_num|min:0|max:10000',
            'product_sort_desc' => 'required|max:255',
            'product_desc' => 'required',
        ],[
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'cate_id.required' => 'Bạn chưa chọn loại sản phẩm',
            'product_price.required' =>  'Bạn chưa nhập giá sản phẩm',
            'product_price.numeric' =>  'Giá của sản phẩm phải là số',
            'product_price.min' =>  'Giá của sản phẩm không thể nhỏ hơn 1000 vnđ',
            'product_price.max' =>  'Giá của sản phẩm tối đa là 10000000 vnđ',

            'unit_id.required' => 'Ban chưa chọn đơn vị tính',
            'storage_id.required' => 'Bạn chưa chọn kho hàng',
            'product_quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0',
            'product_quantity.max' => 'Số lượng không thể quá lớn',
            'product_quantity.alpha_num' => 'Số lượng phải lớn hơn hoặc bằng 0',
            'product_sort_desc.max' => 'Không vượt quá 255 ký tự',
            'product_sort_desc.required' => 'Bạn không được để trống',
            'product_desc.required' => 'Mô tả sản phẩm không được để trống',
        ]);
    }
    public function Validate_Product_Update(Request $request){
        $request->validate([
            'product_name' =>'required',
            'cate_id' => 'required',
            'unit_id' => 'required',
            'storage_id' => 'required',
            'product_sort_desc' => 'required|max:255',
            'product_desc' => 'required',
        ],[
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'cate_id.required' => 'Bạn chưa chọn loại sản phẩm',
            'product_price.required' =>  'Bạn chưa nhập giá sản phẩm',

            'unit_id.required' => 'Ban chưa chọn đơn vị tính',
            'storage_id.required' => 'Bạn chưa chọn kho hàng',
            'product_sort_desc.max' => 'Không vượt quá 255 ký tự',
            'product_sort_desc.required' => 'Bạn không được để trống',
            'product_desc.required' => 'Mô tả sản phẩm không được để trống',
        ]);
    }
    public function convert_day($month, $date){
        $num_day = 0;
        switch ($month) {
            case 1:
                $num_day = $date + 31;
                break;
            case 2:
                $num_day = $date + 28;
                break;
            case 3:
                $num_day = $date + 31;
                break;
            case 4:
                $num_day = $date + 30;
                break;
            case 5:
                $num_day = $date + 31;
                break;
            case 6:
                $num_day = $date + 30;
                break;
            case 7:
                $num_day = $date + 31;
                break;
            case 8:
                $num_day = $date + 31;
                break;
            case 9:
                $num_day = $date + 30;
                break;
            case 10:
                $num_day = $date + 31;
                break;
            case 11:
                $num_day = $date + 30;
                break;
            case 12:
                $num_day = $date + 31;
                break;
        }
        return $num_day;
    }
}
