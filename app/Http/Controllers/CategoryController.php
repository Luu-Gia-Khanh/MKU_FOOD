<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Admin_Action_Category;
use App\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function show_category() {
        $all_category = Category::paginate(5);
        return view('admin.category.all_category', ['all_category' => $all_category]);
    }

    public function add_category() {
        return view('admin.category.add_category');
    }

    public function process_add_category(Request $request) {
        //check all
        $this->Validation_Category($request);

        //check name category
        $check_cate_name = Category::where('cate_name', $request->cate_name)->first();
        if($check_cate_name){
            $request->session()->flash('check_cate_name', 'Tên loại đã tồn tại');
            return redirect('admin/add_category');
        }

        $category = new Category();
        $category->cate_name = $request->cate_name;
        $category->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('cate_image');
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $category->cate_image = $new_image;
        }
        else{
            $category->cate_image = ('no_image.png');
        }
        $category->save();

        // Action add category
        $Action_Category = new Admin_Action_Category();
        $Action_Category->admin_id = Session::get('admin_id');
        $Action_Category->cate_id = $category->cate_id;
        $Action_Category->action_id = 1;
        $Action_Category->action_message = "Thêm loại sản phẩm";
        $Action_Category->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $Action_Category->save();

        $request->session()->flash('success_add_category', 'Thêm loại sản phẩm thành công');
        return redirect('admin/all_category');
    }

    public function update_category($cate_id) {
        $update_category = Category::find($cate_id);
        return view('admin.category.update_category', compact('update_category'));
    }

    public function process_update_category(Request $request, $cate_id) {
        $this->Validation_Category($request);

        $category = Category::find($cate_id);
        
        //check name category
        $check_cate_name = Category::where('cate_name', $request->cate_name)->first();

        if($request->cate_name == $category->cate_name){
            $category->cate_name = $request->cate_name;
            $category->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $get_image = $request->file('cate_image');
            if(isset($get_image)){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload',$new_image);
                $category->cate_image = $new_image;
                $category->save();

                // Action update category
                $this->action_update_cate($category->cate_id);

                $request->session()->flash('success_update_category', 'Sửa loại sản phẩm thành công');
                return redirect('admin/all_category');
            }
            else{
                $category->cate_image = $category->cate_image;
                $category->save();

                // Action update category
                $this->action_update_cate($category->cate_id);

                $request->session()->flash('success_update_category', 'Sửa loại sản phẩm thành công');
                return redirect('admin/all_category');
            }
        }
        else {
            if ($check_cate_name) {
                $request->session()->flash('check_cate_name', 'Tên loại đã tồn tại');
                return redirect('admin/update_category/'.$cate_id);
            }
            else {
                $category->cate_name = $request->cate_name;
                $category->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                $get_image = $request->file('cate_image');
                if(isset($get_image)){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/upload',$new_image);
                    $category->cate_image = $new_image;
                    $category->save();

                    // Action update ategory
                    $this->action_update_cate($category->cate_id);

                    $request->session()->flash('success_update_category', 'Sửa loại sản phẩm thành công');
                    return redirect('admin/all_category');
                }
                else{
                    $category->cate_image = $category->cate_image;
                    $category->save();

                    // Action update category
                    $this->action_update_cate($category->cate_id);

                    $request->session()->flash('success_update_category', 'Sửa loại sản phẩm thành công');
                    return redirect('admin/all_category');
                }
            }
        }
    }

    public function action_update_cate($cate_id){
        $Action_Category = new Admin_Action_Category();
        $Action_Category->admin_id = Session::get('admin_id');
        $Action_Category->cate_id = $cate_id;
        $Action_Category->action_id = 3;
        $Action_Category->action_message = "Sửa loại sản phẩm";
        $Action_Category->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $Action_Category->save();
    }

    public function find_category(Request $request) {
        $val_find_cate = $request->value_find;
        $result_find = DB::table('Category')->where('cate_name', 'LIKE','%'.$val_find_cate.'%')->get();
        $stt = 0;
        foreach($result_find as $result_item){
            $stt++;
            echo '<table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline"
                    id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <tbody class="content_find_category">

                    <tr role="row" class="odd">
                        <td>'.$stt.'</td>
                        <td class="table-plus sorting_1" tabindex="0">
                            <img src="'.'http://localhost/MKU_FOOD/public/upload/'.$result_item->cate_image.'" alt="hình ảnh" srcset="" width="200" height="200">
                        </td>
                        <td>'.$result_item->cate_name.'</td>
                        <td>'.$result_item->created_at.'</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="http://localhost/MKU_FOOD/admin/update_category/'.$result_item->cate_id.'"><i class="dw dw-edit2"></i>Chỉnh Sửa</a>
                                    <a class="dropdown-item" href="http://localhost/MKU_FOOD/admin/process_delete_category/'.$result_item->cate_id.'"><i class="dw dw-delete-3"></i>Xóa</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>';
        }
    }

    public function process_delete_category(Request $request, $cate_id) {
        Category::destroy($cate_id);

        // Action delete category
        $Action_Category = new Admin_Action_Category();
        $Action_Category->admin_id = Session::get('admin_id');
        $Action_Category->cate_id = $cate_id;
        $Action_Category->action_id = 2;
        $Action_Category->action_message = "Xóa loại sản phẩm";
        $Action_Category->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $Action_Category->save();
        
        $request->session()->flash('success_delete_category', 'Loại sản phẩm đã được chuyển vào thùng rác');
        return redirect()->back();
    }

    public function view_recycle(){
        $recycle_item = Category::onlyTrashed()->get();
        return view('admin.category.all_recycle_item',['recycle_item'=>$recycle_item]);
    }

    public function re_delete(Request $request, $cate_id){
        $cate_name_recycle = Category::onlyTrashed()->where('cate_id', $cate_id)->first();
        $cate_name_db = Category::where('cate_name', $cate_name_recycle->cate_name)->get();

        if(count($cate_name_db) > 0){
            $request->session()->flash('error_check_cate_name', 'Loại sản phẩm đã tồn tại trong danh sách');
            $request->session()->flash('cate_id', $cate_name_recycle->cate_id);
            return redirect('admin/view_recycle');
        }else {
            Category::withTrashed()->where('cate_id', $cate_id)->restore();

            // Action recovery category
            $Action_Category = new Admin_Action_Category();
            $Action_Category->admin_id = Session::get('admin_id');
            $Action_Category->cate_id = $cate_id;
            $Action_Category->action_id = 4;
            $Action_Category->action_message = "Khôi phục loại sản phẩm";
            $Action_Category->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $Action_Category->save();

            return redirect()->back();
        }
    }

    public function delete_forever(Request $request){
        $cate_id = $request->category_id_delete_forever;
        Category::withTrashed()->where('cate_id', $cate_id)->forceDelete();

        // Action delete forever category
        $Action_Category = new Admin_Action_Category();
        $Action_Category->admin_id = Session::get('admin_id');
        $Action_Category->cate_id = $cate_id;
        $Action_Category->action_id = 5;
        $Action_Category->action_message = "Xóa vĩnh viễn loại sản phẩm";
        $Action_Category->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $Action_Category->save();

        
        return redirect()->back();
    }

    public function delete_recovery_forever(Request $request, $cate_recovery_id){
        Category::withTrashed()->where('cate_id', $cate_recovery_id)->forceDelete();
        $request->session()->flash('success_delete_forever_category', 'Loại sản phẩm đã được xóa khỏi thùng rác');
        return redirect()->back();
    }

    public function soft_delete(Request $request){
        $cate_id = $request->cate_id;
        Category::where('cate_id', $cate_id)->delete();

        // Action delete category
        $Action_Category = new Admin_Action_Category();
        $Action_Category->admin_id = Session::get('admin_id');
        $Action_Category->cate_id = $cate_id;
        $Action_Category->action_id = 2;
        $Action_Category->action_message = "Xóa loại sản phẩm";
        $Action_Category->action_time = Carbon::now('Asia/Ho_Chi_Minh');
        $Action_Category->save();

        $request->session()->flash('success_delete_soft_category', 'Loại sản phẩm đã được chuyển vào thùng rác');
        return redirect()->back();
    }

    public function Validation_Category(Request $request){
        $request -> validate([
            'cate_name' =>'required|max:100',
        ],[
            'cate_name.required'=>'Tên không được để trống',
            'cate_name.max'=>'Tên có độ dài tối đa là 100 ký tự',
        ]);
    }

}
