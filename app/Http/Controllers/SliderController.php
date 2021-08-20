<?php

namespace App\Http\Controllers;

use App\Admin_Action_Slider;
use App\Http\Controllers\Controller;
use App\Slider;
use Session;
use Carbon\Carbon;
use Dotenv\Regex\Result;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function all_slider(){
        $all_slider = Slider::orderBy('slider_id', 'desc')->paginate(10);
        return view('admin.slider.all_slider', compact('all_slider'));
    }
    public static function show_slider(){
        $all_slider = Slider::where('slider_status', 1)->get();
        return $all_slider;
    }
    public function add_slider(){
        return view('admin.slider.add_slider');
    }
    public function process_add_slider(Request $request){
        $this->validate_slider($request);
        $slider_name = $request->slider_name;
        $slider_desscription = $request->slider_description;

        $check_name_slider = Slider::where('slider_name', $slider_name)->first();

        if($check_name_slider){
            $request->session()->flash('check_name_slider', 'Tên slider đã tồn tại');
            return redirect()->back();
        }

        $get_image = $request->slider_image;
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $slider_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$slider_image);
        }

        $all_slider_status = Slider::where('slider_status', 1)->get();

        $new_slider = new Slider();
        if(count($all_slider_status) >= 10){
            $new_slider->slider_name = $slider_name;
            $new_slider->slider_image = $slider_image;
            $new_slider->slider_description = $slider_desscription;
            $new_slider->slider_status = 0;
            $reslut = $new_slider->save();

            if($reslut){
                $action_slider = new Admin_Action_Slider();
                $action_slider->admin_id = Session::get('admin_id');
                $action_slider->slider_id = $new_slider->slider_id;
                $action_slider->action_id = 1;
                $action_slider->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $action_slider->action_message = 'Thêm slider';
                $action_slider->save();
    
                $request->session()->flash('slider_status_unactive', 'Thêm slider thành công! Trạng thái được chuyển về TẮT vì đã đủ 10 slider đang chạy');
                return redirect('admin/all_slider');
            }
        }
        else{
            $new_slider->slider_name = $slider_name;
            $new_slider->slider_image = $slider_image;
            $new_slider->slider_description = $slider_desscription;
            $new_slider->slider_status = 1;
            
            $reslut = $new_slider->save();

            if($reslut){
                $action_slider = new Admin_Action_Slider();
                $action_slider->admin_id = Session::get('admin_id');
                $action_slider->slider_id = $new_slider->slider_id;
                $action_slider->action_id = 1;
                $action_slider->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $action_slider->action_message = 'Thêm slider';
                $action_slider->save();
    
                $request->session()->flash('slider_status_active', 'Thêm slider thành công!');
                return redirect('admin/all_slider');
            }
        }
    }
    public function process_delete_slider(Request $request){
        $slider_id = $request->slider_id;
        $reslut = Slider::destroy($slider_id);
        if($reslut){
            $action_slider = new Admin_Action_Slider();
            $action_slider->admin_id = Session::get('admin_id');
            $action_slider->slider_id = $slider_id;
            $action_slider->action_id = 3;
            $action_slider->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_slider->action_message = 'Xóa slider';
            $action_slider->save();

            $request->session()->flash('delete_slider', 'Xóa slider thành công!');
            return redirect('admin/all_slider');
        }
    }
    public function active_slider(Request $request, $slider_id){
        $all_slider_status = Slider::where('slider_status', 1)->get();
        if(count($all_slider_status) >= 10){
            $request->session()->flash('error_active_slider', 'Trạng thái không thể BẬT vì đã đủ 10 slider đang chạy');
            return redirect()->back();
        }
        else{
            $slider = Slider::where('slider_id', $slider_id)->first();
            $slider->slider_status = 1;
            $slider->save();
            $request->session()->flash('change_status_slider', 'Thay đổi trạng thái thành công!');
            return redirect()->back();
        }
    }
    public function unactive_slider(Request $request, $slider_id){
        $slider = Slider::where('slider_id', $slider_id)->first();
        $slider->slider_status = 0;
        $slider->save();
        $request->session()->flash('change_status_slider', 'Thay đổi trạng thái thành công!');
        return redirect()->back();
    }
    public function validate_slider(Request $request){
        $request->validate([
            'slider_name' => 'required|min:5|max:100',
            'slider_description' => 'required|min:5|max:255',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,svg',
        ],[
            'slider_name.required' => 'Tên slider không được để trống',
            'slider_name.min' => 'Tên slider phải lớn hơn 5 ký tự',
            'slider_name.max' => 'Tên slider phải nhỏ hơn hoặc bằng 100 ký tự',
            'slider_description.required' => 'Mô tả không được để trống',
            'slider_description.min' => 'Mô tả phải lớn hơn 5 ký tự',
            'slider_description.max' => 'Mô tả phải nhỏ hơn hoặc bằng 255 ký tự',
            'slider_image.required' => 'Vui lòng chọn ảnh',
            'slider_image.image' => 'Vui lòng chọn file dưới dạng hình ảnh',
            'slider_image.mimes' => 'Vui lòng chọn file có đuôi jpeg,png,jpg,svg',
        ]);
    }
}
