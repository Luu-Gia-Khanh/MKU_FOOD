<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Roles;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ADMIN
    public function index(){
        return view('admin.dashboard.dashbord');
    }
    public function show_admin(){
        $all_admin = Admin::paginate(10);
        return view('admin.admin.all_admin',['all_admin'=>$all_admin]);
    }
    public function add_admin(){
        return view('admin.admin.add_admin');
    }
    public function process_add_admin(Request $request){
        $this->Validation_Admin($request);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->admin_email = $request->admin_email;
        $admin->phone = $request->phone;
        $admin->password = md5('123456');
        $get_image = $request->file('avt');
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $admin->avt = $new_image;
        }
        else{
            $admin->avt = ('default_image79.png');
        }
        $admin->save();
        return redirect('admin/all_admin');
    }

    // PERMISSION
    public function list_permission(){
        $admin = Admin::with('roles')->orderBy('admin_id','asc')->paginate(5);
        return view('admin.admin.list_permission',['admin'=>$admin]);
    }
    public function assign_roles(Request $request){
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['admin']){
            $user->roles()->attach(Roles::where('name','admin')->first());
         }
        if($request['manager']){
           $user->roles()->attach(Roles::where('name','manager')->first());
        }
        if($request['user']){
            $user->roles()->attach(Roles::where('name','user')->first());
         }
        return redirect()->back();
    }
    // Validate
    public function Validation_Admin(Request $request){
        $request -> validate([
            'name' =>'required|min:5|alpha|max:100',
            'admin_email' =>'required|email|min:3|max:100',
            'phone' => 'required|starts_with:0|digits:10|numeric'
        ],[
            'name.required'=>'Họ và Tên không được để trống',
            'name.min'=>'Họ và Tên phải ít nhất 5 ký tự',
            'name.alpha'=>'Họ và Tên không được chứa chữ số',
            'name.max'=>'Họ và Tên có độ dài tối đa là 100 ký tự',
            'admin_email.required' => 'Email không được để trống',
            'admin_email.email' => 'Không đúng định dạng của một email',
            'admin_email.min' => 'Email phải có độ dài tối thiểu 3 ký tự',
            'admin_email.max' => 'Email phải có độ dài tối đa 100 ký tự',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.digits' => 'Số điện thoại phải đúng 10 số',
            'phone.numeric' => 'Số điện thoại phải là chữ số',
            'phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0',
        ]);
    }
}
