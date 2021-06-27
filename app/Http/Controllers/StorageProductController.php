<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Admin_Action_Storage_Product;
use App\Http\Controllers\Controller;
use App\ImageProduct;
use App\Import_Storage_Product;
use App\Product;
use App\ProductPrice;
use App\Storage;
use App\Storage_Product;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorageProductController extends Controller
{
    //
    public function all_storage_product(Request $request, $storage_id){
        $all_storage_product = Storage_Product::where('storage_id', $storage_id)->paginate(5);
        $all_product = DB::table('product')->get();

        return view('admin.storage_product.all_storage_product', compact('all_storage_product', 'all_product', 'storage_id'));
    }

    public function update_storage_product(Request $request, $storage_product_id){
        $storage_product = Storage_Product::find($storage_product_id);
        $storage_id = $storage_product->storage_id;
        $all_product = DB::table('product')->get();

        return view('admin.storage_product.update_storage_product', compact('storage_product', 'all_product', 'storage_id'));
    }

    public function process_update_storage_product(Request $request, $storage_product_id){
        $storage_product = Storage_Product::find($storage_product_id);

        if($request->total_quantity_product > $storage_product->total_quantity_product){
            $request->session()->flash('error_check_storage_product_quantity', 'Số lượng không được lớn hơn số lượng hiện tại');
            return redirect()->back();
        }
        if($request->total_quantity_product < 0){
            $request->session()->flash('error_check_storage_product_quantity', 'Số lượng nhập phải lớn hơn 0');
            return redirect()->back();
        }
        if($request->total_quantity_product == null){
            $request->session()->flash('error_check_storage_product_null', 'Số lượng nhập không được bỏ trống');
            return redirect()->back();
        }

        DB::table('Storage_Product')->where('storage_product_id', $storage_product_id)->update([
            'total_quantity_product' => $request->total_quantity_product,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        // Action update storage product
        $action_storage_product = new Admin_Action_Storage_Product();
        $action_storage_product->admin_id = Session::get('admin_id');
        $action_storage_product->storage_product_id = $storage_product->storage_product_id;
        $action_storage_product->action_id = 3;
        $action_storage_product->action_message = "Sửa kho sản phẩm";
        $action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $action_storage_product->save();

        $request->session()->flash('success_update_storage_product', 'Sửa kho sản phẩm thành công');
        return redirect('admin/all_storage_product/'.$storage_product->storage_id);
    }

    public function import_storage_product($storage_product_id){
        $storage_product = Storage_Product::find($storage_product_id);
        $storage_id = $storage_product->storage_id;
        $product = DB::table('product')->where('product_id', $storage_product->product_id)->first();

        return view('admin.storage_product.import_storage_product', compact('storage_product', 'product', 'storage_id'));
    }

    public function process_import_storage_product(Request $request, $storage_product_id){
        $storage_product = Storage_Product::find($storage_product_id);

        if($request->total_quantity_product <= 0){
            $request->session()->flash('error_check_storage_product_quantity', 'Số lượng nhập phải lớn hơn 0');
            return redirect()->back();
        }

        $total_quantity_new = $request->total_quantity_product + $storage_product->total_quantity_product;

        $check_import = Import_Storage_Product::create([
            'admin_id' => Session::get('admin_id'),
            'quantity_import' => $request->total_quantity_product,
            'storage_product_id' => $storage_product_id,
            'quantity_current' => $storage_product->total_quantity_product,
            'quantity_total' => $total_quantity_new,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        if($check_import){
            DB::table('Storage_Product')->where('storage_product_id', $storage_product_id)->update([
                'total_quantity_product' => $total_quantity_new,
            ]);

            // Action add storage product
            $action_storage_product = new Admin_Action_Storage_Product();
            $action_storage_product->admin_id = Session::get('admin_id');
            $action_storage_product->storage_product_id = $storage_product->storage_product_id;
            $action_storage_product->action_id = 1;
            $action_storage_product->action_message = "Nhập kho sản phẩm";
            $action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_storage_product->save();
        }



        $request->session()->flash('success_import_storage_product', 'Nhập kho sản phẩm thành công');
        return redirect('admin/all_storage_product/'.$storage_product->storage_id);
    }

    public function find_storage_product(Request $request) {
        $value_find = $request->value_find;
        $value_storage_id = $request->value_storage_id;
        $all_storage_product = DB::table('storage_product')->where('deleted_at', null)->where('storage_id', $value_storage_id)->get();
        $all_product = DB::table('product')->where('product_name', 'LIKE','%'.$value_find.'%')->get();
        echo view('admin.storage_product.result_find_storage_product', compact('all_storage_product', 'all_product'));
    }

    public function history_storage_product($storage_product_id){
        $history_storage_product = Import_Storage_Product::where('storage_product_id', $storage_product_id)->paginate(5);
        $storage_product = Storage_Product::where('storage_product_id', $storage_product_id)->first();
        $storage_id = $storage_product->storage_id;
        $all_product = DB::table('product')->get();
        $all_admin = Admin::all();
        $quantity_total = $storage_product->total_quantity_product;

        return view('admin.storage_product.history_storage_product', compact('history_storage_product', 'all_product', 'storage_product', 'all_admin', 'storage_id', 'quantity_total'));
    }

    public function process_delete_storage_product(Request $request, $storage_product_id) {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $storage_product = Storage_Product::where('storage_product_id', $storage_product_id)->first();
        $product_id = $storage_product->product_id;

        if($storage_product->total_quantity_product > 0){
            $request->session()->flash('error_delete_soft_storage_product', 'Sản phẩm chưa hết hàng không thể xóa');
            return redirect()->back();
        }
        else{
            Product::where('product_id', $product_id)->delete();
            Storage_Product::destroy($storage_product_id);
            // Action delete storage product
            $action_storage_product = new Admin_Action_Storage_Product();
            $action_storage_product->admin_id = Session::get('admin_id');
            $action_storage_product->storage_product_id = $storage_product_id;
            $action_storage_product->action_id = 2;
            $action_storage_product->action_message = "Xóa kho sản phẩm";
            $action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_storage_product->save();

            $request->session()->flash('success_delete_storage_product', 'Xóa thành công');
            return redirect()->back();
        }
    }

    public function view_recycle($storage_id){
        $recycle_item = Storage_Product::onlyTrashed()->get();
        $all_product = DB::table('product')->get();

        return view('admin.storage_product.all_recycle_storage_product', compact('recycle_item', 'all_product', 'storage_id'));
    }

    public function soft_delete(Request $request){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $storage_product_id = $request->storage_product_id;
        $storage_product = Storage_Product::where('storage_product_id', $storage_product_id)->first();
        $product_id = $storage_product->product_id;

        if($storage_product->total_quantity_product > 0){
            $request->session()->flash('error_delete_soft_storage_product', 'Sản phẩm chưa hết hàng không thể xóa');
            return redirect()->back();
        }
        else{
            Product::where('product_id', $product_id)->delete();
            Storage_Product::where('storage_product_id', $storage_product_id)->delete();
            $request->session()->flash('success_delete_soft_storage_product', 'Xóa thành công');

            // Action delete storage product
            $action_storage_product = new Admin_Action_Storage_Product();
            $action_storage_product->admin_id = Session::get('admin_id');
            $action_storage_product->storage_product_id = $storage_product_id;
            $action_storage_product->action_id = 2;
            $action_storage_product->action_message = "Xóa sản phẩm trong kho";
            $action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_storage_product->save();
            return redirect()->back();
        }
    }

    public function re_delete(Request $request,$storage_product_id){
        $storage_product = Storage_Product::onlyTrashed()->where('storage_product_id', $storage_product_id)->first();
        $product_id = $storage_product->product_id;

        Product::withTrashed()->where('product_id', $product_id)->restore();
        Storage_Product::withTrashed()->where('storage_product_id', $storage_product_id)->restore();
            // Action recovery storage product
            $action_storage_product = new Admin_Action_Storage_Product();
            $action_storage_product->admin_id = Session::get('admin_id');
            $action_storage_product->storage_product_id = $storage_product_id;
            $action_storage_product->action_id = 4;
            $action_storage_product->action_message = "Khôi phục sản phẩm từ kho";
            $action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_storage_product->save();

        $request->session()->flash('success_recovery_storage_product', 'Khôi phục thành công');
        return redirect()->back();
    }
    public function delete_forever(Request $request){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $storage_product_id = $request->storage_product_id_delete_forever;
        $storage_product = Storage_Product::withTrashed()->where('storage_product_id', $storage_product_id)->first();
        $product_id = $storage_product->product_id;

        ProductPrice::withTrashed()->where('product_id', $product_id)->forceDelete();
        ImageProduct::withTrashed()->where('product_id', $product_id)->forceDelete();
        Product::withTrashed()->where('product_id', $product_id)->forceDelete();
        Storage_Product::withTrashed()->where('storage_product_id', $storage_product_id)->forceDelete();

        // Action delete forever storage product
        $action_storage_product = new Admin_Action_Storage_Product();
        $action_storage_product->admin_id = Session::get('admin_id');
        $action_storage_product->storage_product_id = $storage_product_id;
        $action_storage_product->action_id = 5;
        $action_storage_product->action_message = "Xóa vĩnh viễn kho sản phẩm";
        $action_storage_product->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $action_storage_product->save();
        $request->session()->flash('success_delete_forever_storage_product', 'Xóa vĩnh viễn thành công');
        return redirect()->back();
    }

}
