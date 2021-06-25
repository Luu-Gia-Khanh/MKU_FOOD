<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Roles;
use App\User;
use App\Admin_Action_Admin;
use Auth;
use DB;
use Session;
use Carbon\Carbon;
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
        $citys = DB::table('tinhthanhpho')->get();
        return view('admin.admin.add_admin',['citys'=>$citys]);
    }
    public function process_add_admin(Request $request){
        //Validate
        $this->Validation_Admin($request);
        // connect city distrist ward
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        $name_city = DB::table('tinhthanhpho')->where('matp', $city)->first();
        $name_district = DB::table('quanhuyen')->where('maqh', $district)->first();
        $name_ward = DB::table('xaphuongthitran')->where('xaid', $ward)->first();

        //address
        $admin_address = $name_city->name_tp.", ".$name_district->name_qh.", ".$name_ward->name_xa;

        //format time
        //$admin_birthday = date("d/m/Y", strtotime($request->admin_birthday));

        //validate day
        $nowdate = getdate();
        $nowYear = $nowdate['year'];
        $yearAdmin = date('Y', strtotime($request->admin_birthday));
        $age = $nowYear-$yearAdmin;
        //check age
        if($age<18){
            $request->session()->flash('check_age', 'Người quản trị phải trên 18 tuổi');
            return redirect('admin/add_admin');
        }

        //check phone
        $check_phone = DB::table('admin')->where('admin_phone', $request->admin_phone)->first();
        if($check_phone){
            $request->session()->flash('check_phone', 'Số điện thoại đã tồn tại');
            return redirect('admin/add_admin');
        }

        //check email
        $check_email = DB::table('admin')->where('admin_email', $request->admin_email)->first();
        if($check_email){
            $request->session()->flash('check_email', 'Email đã tồn tại');
            return redirect('admin/add_admin');
        }
        //
        $admin = new Admin();
        $admin->admin_name = $request->admin_name;
        $admin->admin_email = $request->admin_email;
        $admin->admin_phone = $request->admin_phone;
        $admin->admin_birthday = $request-> admin_birthday;
        $admin->admin_gender = $request->admin_gender;
        $admin->admin_address = $admin_address;
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
        $result = $admin->save();
        if($result){
            // insert table admin_action_admin
            $action_admin = new Admin_Action_Admin();
            $action_admin->admin_id = Session::get('admin_id');
            $action_admin->admin_impact_id = $admin->admin_id;
            $action_admin->action_id = 1;
            $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_admin->action_message = 'Thêm người quản trị';
            $action_admin->save();
            //
            $request->session()->flash('add_admin_success', 'Thêm thành công người quản trị');
            return redirect('admin/all_admin');
        }
        else{
            return redirect()->back();
        }

    }
    public function update_admin(Request $request, $admin_id){
        $update_admin = Admin::find($admin_id);
        $citys = DB::table('tinhthanhpho')->get();
        $districts = DB::table('quanhuyen')->get();
        $wards = DB::table('xaphuongthitran')->get();
        return view('admin.admin.update_admin',['update_admin'=>$update_admin,'citys'=>$citys, 'districts'=>$districts, 'wards'=>$wards]);
    }
    public function process_update_admin(Request $request, $admin_id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->Validation_Admin($request);
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        $name_city = DB::table('tinhthanhpho')->where('matp', $city)->first();
        $name_district = DB::table('quanhuyen')->where('maqh', $district)->first();
        $name_ward = DB::table('xaphuongthitran')->where('xaid', $ward)->first();

        //address
        $admin_address = $name_city->name_tp.", ".$name_district->name_qh.", ".$name_ward->name_xa;
        //validate day

        $nowdate = getdate();
        $nowYear = $nowdate['year'];
        $yearAdmin = date('Y', strtotime($request->admin_birthday));
        $age = $nowYear-$yearAdmin;
        //check age
        if($age<18){
            $request->session()->flash('check_age', 'Người quản trị phải trên 18 tuổi');
            return redirect()->back();
        }

        //check phone
        $check_phone = DB::table('admin')->where('admin_phone', $request->admin_phone)->get();
        if (count($check_phone)>1){
            $request->session()->flash('check_phone', 'Số điện thoại đã tồn tại');
            return redirect()->back();
        }

        $check_email = DB::table('admin')->where('admin_email', $request->admin_email)->get();
        if(count($check_email)>1){
            $request->session()->flash('check_email', 'Email đã tồn tại');
            return redirect()>back();
        }
        $admin = Admin::find($admin_id);
        $admin->admin_name = $request->admin_name;
        $admin->admin_email = $request->admin_email;
        $admin->admin_phone = $request->admin_phone;
        $admin->admin_birthday = $request-> admin_birthday;
        $admin->admin_gender = $request->admin_gender;
        $admin->admin_address = $admin_address;
        $admin->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('avt');
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $admin->avt = $new_image;
            $result = $admin->save();
            if($result){
                $action_admin = new Admin_Action_Admin();
                $action_admin->admin_id = Session::get('admin_id');
                $action_admin->admin_impact_id = $admin->admin_id;
                $action_admin->action_id = 2;
                $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $action_admin->action_message = 'Sửa thông tin người quản trị';
                $action_admin->save();
                //
                $request->session()->flash('update_success_admin', 'Sửa thành công người quản trị');
                return redirect('admin/all_admin');
            }
            else{
                return redirect()->back();
            }
        }
        else{
            $result = $admin->save();
            if($result){
                $action_admin = new Admin_Action_Admin();
                $action_admin->admin_id = Session::get('admin_id');
                $action_admin->admin_impact_id = $admin->admin_id;
                $action_admin->action_id = 2;
                $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $action_admin->action_message = 'Sửa thông tin người quản trị';
                $action_admin->save();

                $request->session()->flash('update_success_admin', 'Sửa thành công người quản trị');
                return redirect('admin/all_admin');
            }
            else{
                return redirect()->back();
            }

        }
    }
    public function process_update_profile_admin(Request $request, $admin_id){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->Validation_Admin($request);
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        $name_city = DB::table('tinhthanhpho')->where('matp', $city)->first();
        $name_district = DB::table('quanhuyen')->where('maqh', $district)->first();
        $name_ward = DB::table('xaphuongthitran')->where('xaid', $ward)->first();

        //address
        $admin_address = $name_city->name_tp.", ".$name_district->name_qh.", ".$name_ward->name_xa;
        //validate day

        $nowdate = getdate();
        $nowYear = $nowdate['year'];
        $yearAdmin = date('Y', strtotime($request->admin_birthday));
        $age = $nowYear-$yearAdmin;
        //check age
        if($age<18){
            $request->session()->flash('check_age', 'Người quản trị phải trên 18 tuổi');
            return redirect()->back();
        }

        //check phone
        $check_phone = DB::table('admin')->where('admin_phone', $request->admin_phone)->get();
        if (count($check_phone)>1){
            $request->session()->flash('check_phone', 'Số điện thoại đã tồn tại');
            return redirect()->back();
        }

        $check_email = DB::table('admin')->where('admin_email', $request->admin_email)->get();
        if(count($check_email)>1){
            $request->session()->flash('check_email', 'Email đã tồn tại');
            return redirect()>back();
        }
        $admin = Admin::find($admin_id);
        $admin->admin_name = $request->admin_name;
        $admin->admin_email = $request->admin_email;
        $admin->admin_phone = $request->admin_phone;
        $admin->admin_birthday = $request-> admin_birthday;
        $admin->admin_gender = $request->admin_gender;
        $admin->admin_address = $admin_address;
        $admin->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('avt');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $admin->avt = $new_image;
            $result = $admin->save();
            if($result){
                $action_admin = new Admin_Action_Admin();
                $action_admin->admin_id = Session::get('admin_id');
                $action_admin->admin_impact_id = $admin->admin_id;
                $action_admin->action_id = 2;
                $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $action_admin->action_message = 'Sửa thông tin người quản trị';
                $action_admin->save();
                //
                $request->session()->flash('update_profile_success', 'Cập nhật thành công');
                return redirect()->back();
            }
            else{
                return redirect()->back();
            }
        }
        else{
            $result = $admin->save();
            if($result){
                $action_admin = new Admin_Action_Admin();
                $action_admin->admin_id = Session::get('admin_id');
                $action_admin->admin_impact_id = $admin->admin_id;
                $action_admin->action_id = 2;
                $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
                $action_admin->action_message = 'Sửa thông tin người quản trị';
                $action_admin->save();

                $request->session()->flash('update_profile_success', 'Cập nhật thành công');
                return redirect()->back();
            }
            else{
                return redirect()->back();
            }

        }
    }
    public function update_password_admin(Request $request, $admin_id){
        $this->Validation_Update_Password($request);

        $old_password = md5($request->old_password);
        $new_password = md5($request->new_password);
        $confirm_password = md5($request->confirm_password);
        $admin = DB::table('Admin')->where('admin_id', $admin_id)->where('password', $old_password)->first();
        if($admin){
            if($new_password === $confirm_password){
                $updata_pass = Admin::find($admin_id);
                $updata_pass->password = $new_password;
                $updata_pass->save();

                $request->session()->flash('change_password_success', 'Thay đổi mật khẩu thành công');
                return redirect()->back();
            }
            else{
                $request->session()->flash('change_password_error_confirm', 'Mật khẩu không trùng khớp');
                return redirect()->back();
            }
        }
        else{
            $request->session()->flash('change_password_error', 'Mật khẩu sai');
            return redirect()->back();
        }
    }
    public function view_recycle(){
        $recycle_item = Admin::onlyTrashed()->get();
        return view('admin.admin.all_recycle_item',['recycle_item'=>$recycle_item]);
    }
    public function re_delete(Request $request,$admin_id){
        $restore = Admin::withTrashed()->where('admin_id', $admin_id)->restore();
        if($restore){
            $action_admin = new Admin_Action_Admin();
            $action_admin->admin_id = Session::get('admin_id');
            $action_admin->admin_impact_id = $admin_id;
            $action_admin->action_id = 4;
            $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_admin->action_message = 'Khôi phục người quản trị từ thùng rác';
            $action_admin->save();
            $request->session()->flash('restore_success', 'Khôi phục thành công');
        }
        return redirect()->back();
    }
    public function delete_forever(Request $request){
        $admin_id = $request->admin_id_delete_forever;
        $delete_forever = Admin::withTrashed()->where('admin_id', $admin_id)->forceDelete();
        if($delete_forever){
            $action_admin = new Admin_Action_Admin();
            $action_admin->admin_id = Session::get('admin_id');
            $action_admin->admin_impact_id = $admin_id;
            $action_admin->action_id = 5;
            $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_admin->action_message = 'Xóa vĩnh viễn người quản trị';
            $action_admin->save();
        }
        $request->session()->flash('delete_forever_success', 'Xóa thành công người quản trị');
        return redirect()->back();
    }
    public function soft_delete(Request $request){
        $admin_id = $request->admin_id;
        $soft_delete = Admin::where('admin_id', $admin_id)->delete();
        if($soft_delete){
            $action_admin = new Admin_Action_Admin();
            $action_admin->admin_id = Session::get('admin_id');
            $action_admin->admin_impact_id = $admin_id;
            $action_admin->action_id = 3;
            $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_admin->action_message = 'Đưa người quản trị vào thùng rác';
            $action_admin->save();
        }
        $request->session()->flash('delete_success', 'Xóa thành công');
        return redirect()->back();
    }
    public function view_profile($admin_id){
        //$view_profile = Admin::find($admin_id);
        $view_profile = DB::table('admin_roles')
        ->join('admin','admin.admin_id','=','admin_roles.admin_admin_id')
        ->join('roles','roles.roles_id','=','admin_roles.roles_roles_id')
        ->where('admin_admin_id',$admin_id)->first();
        $citys = DB::table('tinhthanhpho')->get();
        $districts = DB::table('quanhuyen')->get();
        $wards = DB::table('xaphuongthitran')->get();
        return view('admin.admin.view_profile_admin',['view_profile'=>$view_profile,'citys'=>$citys,'districts'=>$districts,'wards'=>$wards]);
    }
    public function find_admin(Request $request){
        $val_find = $request->value_find;
        $result_find = DB::table('admin')->where('deleted_at', null)->where('admin_name','LIKE','%'.$val_find.'%')->orwhere('admin_phone','LIKE','%'.$val_find.'%')->get();
        $stt = 1;
        foreach ($result_find as $result){
            $show = '
            <tr role="row" class="odd">
                <td>'.$stt++.'</td>
                <td class="table-plus sorting_1" tabindex="0">
                    <img src="http://localhost/MKU_FOOD/public/upload/'.$result->avt.'" alt="hình ảnh" height="70px" width="70px">
                </td>
                <td>'.$result->admin_name.'</td>
                <td>'.$result->admin_phone.'</td>
                <td>'.$result->admin_email.'</td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                            href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="http://localhost/MKU_FOOD/admin/view_profile/'.$result->admin_id.'"><i class="dw dw-eye"></i>Thông tin cá nhân</a>
                            <a class="dropdown-item" href="http://localhost/MKU_FOOD/admin/update_admin/'.$result->admin_id.'"><i class="dw dw-edit2"></i>Chỉnh Sửa</a>
                            <form action = "http://localhost/MKU_FOOD/admin/delete_when_find/'.$result->admin_id.'" method="get">

                                <button type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i>Xóa</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
                    ';
            echo $show;
        }
    }
    public function delete_when_find(Request $request,$admin_id){
        $soft_delete = Admin::where('admin_id', $admin_id)->delete();
        if($soft_delete){
            $action_admin = new Admin_Action_Admin();
            $action_admin->admin_id = Session::get('admin_id');
            $action_admin->admin_impact_id = $admin_id;
            $action_admin->action_id = 3;
            $action_admin->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_admin->action_message = 'Đưa người quản trị vào thùng rác';
            $action_admin->save();
        }
        $request->session()->flash('delete_success', 'Xóa thành công');
        return redirect()->back();
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
            'admin_name' =>'required|min:5|max:100',
            'admin_email' =>'required|email|min:3|max:100',
            'admin_phone' => 'required|starts_with:0|digits:10|numeric',
            'admin_birthday' =>'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
        ],[
            'admin_name.required'=>'Họ và Tên không được để trống',
            'admin_name.min'=>'Họ và Tên phải ít nhất 5 ký tự',
            'admin_name.alpha'=>'Họ và Tên không được chứa chữ số',
            'admin_name.max'=>'Họ và Tên có độ dài tối đa là 100 ký tự',

            'admin_email.required' => 'Email không được để trống',
            'admin_email.email' => 'Không đúng định dạng của một email',
            'admin_email.min' => 'Email phải có độ dài tối thiểu 3 ký tự',
            'admin_email.max' => 'Email phải có độ dài tối đa 100 ký tự',

            'admin_phone.required' => 'Số điện thoại không được để trống',
            'admin_phone.digits' => 'Số điện thoại phải đúng 10 số',
            'admin_phone.numeric' => 'Số điện thoại phải là chữ số',
            'admin_phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0',

            'admin_birthday.required' => 'Ngày sinh không được để trống',

            'city.required' => 'Tỉnh/Thành Phố không được để trống',
            'district.required' => 'Quận Huyện không được để trống',
            'ward.required' => 'Xã/Phường/Thị Trấn không được để trống',
        ]);
    }
    public function Validation_Update_Password(Request $request){
        $request -> validate([
            'old_password' =>'required',
            'new_password' =>'required|min:5',
            'confirm_password' =>'required',
        ],[
            'old_password.required' => 'Bạn không được để trống',
            'new_password.required' => 'Bạn không được để trống',
            'new_password.min' => 'Password phải chứa ít nhất 5 ký tự',
            'confirm_password.required' => 'Bạn không được để trống',
        ]);
    }
}
