<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function show_category() {
        $all_category = Category::paginate(10);
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
            $request->session()->flash('check_cate_name', 'Tên loại đã tồn tại hoặc chưa xóa trong thùng rác');
            return redirect('admin/add_category');
        }

        $category = new Category();
        $category->cate_name = $request->cate_name;
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
            $get_image = $request->file('cate_image');
            if(isset($get_image)){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload',$new_image);
                $category->cate_image = $new_image;
                $category->save();
                return redirect('admin/all_category');
            }
            else{
                $category->save();
                return redirect('admin/all_category');
            }
        }
        else if($check_cate_name){
            $request->session()->flash('check_cate_name', 'Tên loại đã tồn tại hoặc chưa xóa trong thùng rác');
            return redirect('admin/add_category');
        }
    }

    public function process_delete_category($cate_id) {
        Category::destroy($cate_id);
        return redirect('admin/all_category');
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
