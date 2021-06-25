<?php

namespace App\Http\Controllers;

use App\Admin_Action_Storage;
use App\Http\Controllers\Controller;
use App\Storage;
use App\Storage_Product;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{
    //
    public function show_storage(){
        $all_storage = Storage::paginate(5);
        return view('admin.storage.all_storage', compact('all_storage'));
    }

    public function add_storage(){
        return view('admin.storage.add_storage');
    }

    public function process_add_storage(Request $request){
        $this->validation_storage($request);

        //CHECK NAME OF STORAGE
        $check_storage_name = Storage::where('storage_name', $request->storage_name)->first();
        if($check_storage_name){
            $request->session()->flash('check_storage_name', 'Tên kho hàng đã tồn tại');
            return redirect('admin/add_storage');
        }

        $storage = new Storage();
        $storage->storage_name = $request->storage_name;
        $storage->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $storage->save();

        // Action add storage
        $action_storage = new Admin_Action_Storage();
        $action_storage->admin_id = Session::get('admin_id');
        $action_storage->storage_id = $storage->storage_id;
        $action_storage->action_id = 1;
        $action_storage->action_message = "Thêm kho hàng";
        $action_storage->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $action_storage->save();

        $request->session()->flash('success_add_storage', 'Thêm kho hàng thành công');
        return redirect('admin/all_storage');
    }

    public function update_storage(Request $request, $storage_id){
        $update_storage = Storage::find($storage_id);
        return view('admin.storage.update', compact('update_storage')); 
    }

    public function process_update_storage(Request $request, $storage_id){
        $this->validation_storage($request);
        $storage = Storage::find($storage_id);

        //CHECK NAME OF STORAGE
        $check_storage_name = Storage::where('storage_name', $request->storage_name)->first();

        if($storage->storage_name == $request->storage_name){
            $storage->storage_name = $request->storage_name;
            $storage->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $storage->save();

            // Action update storage
            $this->action_update_storage($storage->storage_id);

            $request->session()->flash('success_update_storage', 'Sửa kho hàng thành công');
            return redirect('admin/all_storage');
        }
        else{
            if($check_storage_name){
                $request->session()->flash('check_storage_name', 'Tên kho hàng đã tồn tại');
                return redirect('admin/update_storage/'.$storage_id);
            }
            else{
                $storage->storage_name = $request->storage_name;
                $storage->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                $storage->save();

                // Action update storage
                $this->action_update_storage($storage->storage_id);

                $request->session()->flash('success_update_storage', 'Sửa kho hàng thành công');
                return redirect('admin/all_storage');
            }
        }
    }

    public function action_update_storage($storage_id){
        $action_storage = new Admin_Action_Storage();
        $action_storage->admin_id = Session::get('admin_id');
        $action_storage->storage_id = $storage_id;
        $action_storage->action_id = 3;
        $action_storage->action_message = "Sửa kho hàng";
        $action_storage->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $action_storage->save();
    }

    public function find_storage(Request $request) {
        $val_find_storage = $request->value_find;
        $all_storage = DB::table('storage')->where('deleted_at', null)->where('storage_name', 'LIKE','%'.$val_find_storage.'%')->get();
        echo view('admin.storage.find_result_storage', compact('all_storage'));
        // $stt = 0;
        // foreach($result_find as $result_item){
        //     $stt++;
        //     echo '<table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline"
        //             id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
        //             <tbody class="content_find_category">

        //             <tr role="row" class="odd">
        //                 <td>'.$stt.'</td>
        //                 <td>'.$result_item->storage_name.'</td>
        //                 <td>'.Carbon::createFromFormat('Y-m-d H:i:s', $result_item->created_at)->format('d-m-Y').'</td>
        //                 <td>
        //                     <div class="dropdown">
        //                         <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
        //                             href="#" role="button" data-toggle="dropdown">
        //                             <i class="dw dw-more"></i>
        //                         </a>
        //                         <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
        //                             <a class="dropdown-item" href="http://localhost/MKU_FOOD/admin/update_storage/'.$result_item->storage_id.'"><i class="dw dw-edit2"></i>Chỉnh Sửa</a>
        //                             <a class="dropdown-item" href="http://localhost/MKU_FOOD/admin/process_delete_storage/'.$result_item->storage_id.'"><i class="dw dw-delete-3"></i>Xóa</a>
        //                         </div>
        //                     </div>
        //                 </td>
        //             </tr>
        //         </tbody>
        //         </table>';
        // }
    }

    public function process_delete_storage(Request $request, $storage_id) {
        $storage_product = Storage_Product::where('storage_id', $storage_id)->get();
        
        if(count($storage_product) > 0){
            $request->session()->flash('check_delete_storage', 'Kho hàng đang còn sản phẩm');
            return redirect()->back();
        }
        else{
            Storage::destroy($storage_id);

            // Action delete storage
            $action_storage = new Admin_Action_Storage();
            $action_storage->admin_id = Session::get('admin_id');
            $action_storage->storage_id = $storage_id;
            $action_storage->action_id = 2;
            $action_storage->action_message = "Xóa kho hàng";
            $action_storage->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_storage->save();
            
            $request->session()->flash('success_delete_storage', 'Kho hàng đã được chuyển vào thùng rác');
            return redirect()->back();
        }
    }

    public function view_recycle(){
        $recycle_item = Storage::onlyTrashed()->get();
        return view('admin.storage.all_recycle_storage',['recycle_item'=>$recycle_item]);
    }

    public function soft_delete(Request $request){
        $storage_id = $request->storage_id;
        $storage_product = Storage_Product::where('storage_id', $storage_id)->get();

        if(count($storage_product) > 0){
            $request->session()->flash('check_delete_storage', 'Kho hàng đang còn sản phẩm');
            return redirect()->back();
        }
        else{
            Storage::where('storage_id', $storage_id)->delete();

            // Action delete storage
            $action_storage = new Admin_Action_Storage();
            $action_storage->admin_id = Session::get('admin_id');
            $action_storage->storage_id = $storage_id;
            $action_storage->action_id = 2;
            $action_storage->action_message = "Xóa kho hàng";
            $action_storage->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_storage->save();

            $request->session()->flash('success_delete_soft_storage', 'Kho hàng đã được chuyển vào thùng rác');
            return redirect()->back();
        }
    }

    public function re_delete(Request $request, $storage_id){
        $storage_name_recycle = Storage::onlyTrashed()->where('storage_id', $storage_id)->first();
        $storage_name_db = Storage::where('storage_name', $storage_name_recycle->storage_name)->get();

        if(count($storage_name_db) > 0){
            $request->session()->flash('error_check_storage_name', 'Kho hàng đã tồn tại trong danh sách');
            $request->session()->flash('storage_id', $storage_name_recycle->storage_id);
            return redirect()->back();
        }else {
            Storage::withTrashed()->where('storage_id', $storage_id)->restore();

            // Action recovery category
            $action_storage = new Admin_Action_Storage();
            $action_storage->admin_id = Session::get('admin_id');
            $action_storage->storage_id = $storage_id;
            $action_storage->action_id = 4;
            $action_storage->action_message = "Khôi phục kho hàng";
            $action_storage->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_storage->save();

            $request->session()->flash('success_recovery_storage', 'Khôi phục thành công');
            return redirect()->back();
        }
    }

    public function delete_forever(Request $request){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $storage_id = $request->storage_id_delete_forever;
        Storage::withTrashed()->where('storage_id', $storage_id)->forceDelete();

        // Action delete forever storage
        $action_storage = new Admin_Action_Storage();
        $action_storage->admin_id = Session::get('admin_id');
        $action_storage->storage_id = $storage_id;
        $action_storage->action_id = 5;
        $action_storage->action_message = "Xóa vĩnh viễn kho hàng";
        $action_storage->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $action_storage->save();

        $request->session()->flash('success_delete_forever_storage', 'Xóa vĩnh viễn thành công');
        return redirect()->back();
    }

    public function delete_recovery_forever_storage(Request $request, $storage_recovery_id){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Storage::withTrashed()->where('storage_id', $storage_recovery_id)->forceDelete();
        $request->session()->flash('success_delete_forever_storage', 'Loại sản phẩm đã được xóa khỏi thùng rác');
        return redirect()->back();
    }

    public function validation_storage(Request $request){
        $request->validate([
            'storage_name' => 'required|max:100',
        ],[
            'storage_name.required' => 'Tên không được để trống',
            'storage_name.max' => 'Tên phải có độ dài tối đa là 100 ký tự'
        ]);
    }
}
