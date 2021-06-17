<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Roles;
use App\User;
use Auth;
use DB;
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
        $admin->save();
        return redirect('admin/all_admin');
    }
    public function update_admin(Request $request, $admin_id){
        $update_admin = Admin::find($admin_id);
        $citys = DB::table('tinhthanhpho')->get();
        $districts = DB::table('quanhuyen')->get();
        $wards = DB::table('xaphuongthitran')->get();
        return view('admin.admin.update_admin',['update_admin'=>$update_admin,'citys'=>$citys, 'districts'=>$districts, 'wards'=>$wards]);
    }
    public function process_update_admin(Request $request, $admin_id){
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
            return redirect('admin/add_admin');
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
        $get_image = $request->file('avt');
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $admin->avt = $new_image;
            $admin->save();
            return redirect('admin/all_admin');
        }
        else{
            $admin->save();
            return redirect('admin/all_admin');
        }


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
}
