<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Customer_Info;
use App\Customer_Transport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Cart;
use App\Product;
use App\ProductPrice;
class AccountController extends Controller
{
    //
    public function show_account(){
        $customer_id = Session::get('customer_id');
        $customer = Customer::where('customer_id', $customer_id)->first();
        $customer_info = Customer_Info::where('customer_id', $customer_id)->first();
        $all_cart = Cart::where('customer_id', $customer_id)->where('status', 1)->get();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();
        return view('client.user.account',
            compact('customer_info', 'customer', 'all_product', 'all_cart', 'all_price'));
    }

    public function update_account(Request $request, $customer_id){
        $this->validate($request, [
            'customer_fullname' => 'required|min:5|max:100',
            'customer_phone' => 'required|starts_with:0|digits:10|numeric',
        ],[
            'customer_fullname.required'=>'Họ và Tên không được để trống',
            'customer_fullname.min'=>'Họ và Tên phải ít nhất 5 ký tự',
            'customer_fullname.alpha'=>'Họ và Tên không được chứa chữ số',
            'customer_fullname.max'=>'Họ và Tên có độ dài tối đa là 100 ký tự',

            'customer_phone.required' => 'Số điện thoại không được để trống',
            'customer_phone.digits' => 'Số điện thoại phải đúng 10 số',
            'customer_phone.numeric' => 'Số điện thoại phải là chữ số',
            'customer_phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0',
        ]);

        $year_now = Carbon::now()->year;
        $input_year = date('Y', strtotime($request->customer_birthday));
        $check_year = $year_now - $input_year;
        if($check_year > 70){
            $request->session()->flash('check_update_birthday', 'Số tuổi không được trên 70');
            return redirect()->back();
        }
        if($input_year > $year_now){
            $request->session()->flash('check_update_birthday', 'Số năm không hợp lệ');
            return redirect()->back();
        }

        $customer_info = Customer_Info::where('customer_id', $customer_id)->first();

        $customer_info->customer_fullname = $request->customer_fullname;
        $customer_info->customer_phone = $request->customer_phone;
        $customer_info->customer_gender = $request->customer_gender;
        $customer_info->customer_birthday = $request->customer_birthday;
        $get_image = $request->file('customer_avt');
        if(isset($get_image)){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $customer_info->customer_avt = $new_image;
        }
        else{
            $customer_info->customer_avt = $customer_info->customer_avt;
        }
        $customer_info->save();
        return redirect()->back();

        // echo $request->customer_fullname.'<br>';
        // echo $request->customer_phone.'<br>';
        // echo $request->customer_gender.'<br>';
        // echo $request->customer_birthday.'<br>';

        // $customer_info->customer_fullname = $request->customer_fullname;
        // $customer_info->customer_phone = $request->customer_phone;
        // $customer_info->customer_avt = $request->customer_avt;
        // $customer_info->customer_gender = $request->customer_gender;
        // $customer_info->customer_phone = $request->customer_phone;
        // $customer_info->save();
    }

    public function address_account(){
        $customer_id = Session::get('customer_id');

        $all_address = Customer_Transport::where('customer_id', $customer_id)->get();

        $customer = Customer::where('customer_id', $customer_id)->first();
        $customer_info = Customer_Info::where('customer_id', $customer_id)->first();
        $citys = DB::table('tinhthanhpho')->get();
        $districts = DB::table('quanhuyen')->get();
        $wards = DB::table('xaphuongthitran')->get();
        $all_cart = Cart::where('customer_id', $customer_id)->where('status', 1)->get();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();
        return view('client.user.address',
            compact('customer_info', 'customer', 'all_address', 'citys', 'districts', 'wards', 'all_product', 'all_cart', 'all_price'));
    }

    public function process_add_address(Request $request){
        $this->validate($request, [
            'trans_fullname' => 'required|min:5|max:100',
            'trans_phone' => 'required|starts_with:0|digits:10|numeric',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'trans_address_detail' => 'required|min:5|max:100',
        ],[
            'trans_fullname.required'=>'Họ và Tên không được để trống',
            'trans_fullname.min'=>'Họ và Tên phải ít nhất 5 ký tự',
            'trans_fullname.alpha'=>'Họ và Tên không được chứa chữ số',
            'trans_fullname.max'=>'Họ và Tên có độ dài tối đa là 100 ký tự',

            'trans_phone.required' => 'Số điện thoại không được để trống',
            'trans_phone.digits' => 'Số điện thoại phải đúng 10 số',
            'trans_phone.numeric' => 'Số điện thoại phải là chữ số',
            'trans_phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0',

            'trans_address_detail.required'=>'Địa chỉ cụ thể không được để trống',
            'trans_address_detail.min'=>'Địa chỉ cụ thể phải ít nhất 5 ký tự',
            'trans_address_detail.max'=>'Địa chỉ cụ thể có độ dài tối đa là 100 ký tự',

            'city.required' => 'Tỉnh/Thành Phố không được để trống',
            'district.required' => 'Quận Huyện không được để trống',
            'ward.required' => 'Xã/Phường/Thị Trấn không được để trống',
        ]);

        $customer_id = Session::get('customer_id');

        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        $name_city = DB::table('tinhthanhpho')->where('matp', $city)->first();
        $name_district = DB::table('quanhuyen')->where('maqh', $district)->first();
        $name_ward = DB::table('xaphuongthitran')->where('xaid', $ward)->first();

        //address
        $trans_address = $name_city->name_tp.", ".$name_district->name_qh.", ".$name_ward->name_xa.", ".$request->trans_address_detail;

        $transport = new Customer_Transport();
        $transport->customer_id = $customer_id;
        $transport->trans_fullname = $request->trans_fullname;
        $transport->trans_phone = $request->trans_phone;
        $transport->trans_address = $trans_address;

        $all_transport = Customer_Transport::where('customer_id', $customer_id)->get();
        if(count($all_transport) == 0){
            $transport->trans_status = 1;
        }
        else{
            $transport->trans_status = 0;
        }
        $transport->save();
        return redirect()->back();
    }

    public function get_id_trans(Request $request){
        $trans_id = $request->trans_id;
        $transport = Customer_Transport::find($trans_id);
        echo $transport->trans_fullname;
    }
    public function get_phone_trans(Request $request){
        $trans_id = $request->trans_id;
        $transport = Customer_Transport::find($trans_id);
        echo $transport->trans_phone;
    }
    public function get_address_detail_trans(Request $request){
        $trans_id = $request->trans_id;
        $trans_address = Customer_Transport::find($trans_id);


        $address_detail = explode(", ", $trans_address->trans_address);
        echo $address_detail[3];
    }

    public function process_update_address(Request $request){
        $this->validate($request, [
            'trans_fullname' => 'required|min:5|max:100',
            'trans_phone' => 'required|starts_with:0|digits:10|numeric',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'trans_address_detail' => 'required|min:5|max:100',
        ],[
            'trans_fullname.required'=>'Họ và Tên không được để trống',
            'trans_fullname.min'=>'Họ và Tên phải ít nhất 5 ký tự',
            'trans_fullname.alpha'=>'Họ và Tên không được chứa chữ số',
            'trans_fullname.max'=>'Họ và Tên có độ dài tối đa là 100 ký tự',

            'trans_phone.required' => 'Số điện thoại không được để trống',
            'trans_phone.digits' => 'Số điện thoại phải đúng 10 số',
            'trans_phone.numeric' => 'Số điện thoại phải là chữ số',
            'trans_phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0',

            'trans_address_detail.required'=>'Địa chỉ cụ thể không được để trống',
            'trans_address_detail.min'=>'Địa chỉ cụ thể phải ít nhất 5 ký tự',
            'trans_address_detail.max'=>'Địa chỉ cụ thể có độ dài tối đa là 100 ký tự',

            'city.required' => 'Tỉnh/Thành Phố không được để trống',
            'district.required' => 'Quận Huyện không được để trống',
            'ward.required' => 'Xã/Phường/Thị Trấn không được để trống',
        ]);

        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        $name_city = DB::table('tinhthanhpho')->where('matp', $city)->first();
        $name_district = DB::table('quanhuyen')->where('maqh', $district)->first();
        $name_ward = DB::table('xaphuongthitran')->where('xaid', $ward)->first();

        //address
        $trans_address = $name_city->name_tp.", ".$name_district->name_qh.", ".$name_ward->name_xa.", ".$request->trans_address_detail;

        $transport = Customer_Transport::where('trans_id', $request->trans_id)->first();
        $transport->trans_fullname = $request->trans_fullname;
        $transport->trans_phone = $request->trans_phone;
        $transport->trans_address = $trans_address;

        $transport->save();
        return redirect()->back();
    }

    public function process_delete_address(Request $request){
        Customer_Transport::destroy($request->trans_id);
        return redirect()->back();
    }

    public function process_mode_default(Request $request){
        $customer_id = Session::get('customer_id');
        $transport_disable_status = Customer_Transport::where('customer_id', $customer_id)->where('trans_status', '=', 1)->first();
        $transport_disable_status->trans_status = 0;
        $transport_disable_status->save();

        $transport_default_status = Customer_Transport::where('trans_id', $request->trans_id)->first();
        $transport_default_status->trans_status = 1;
        $transport_default_status->save();
        return redirect()->back();

    }

    public function reset_password_account(){
        $customer_id = Session::get('customer_id');
        $customer = Customer::where('customer_id', $customer_id)->first();
        $customer_info = Customer_Info::where('customer_id', $customer_id)->first();
        $all_cart = Cart::where('customer_id', $customer_id)->where('status', 1)->get();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();
        return view('client.user.resetpassword', compact('customer_info', 'customer', 'all_product', 'all_cart', 'all_price'));
    }

    public function process_update_password(Request $request){

        $customer_id = Session::get('customer_id');
        $customer = Customer::where('customer_id', $customer_id)->first();
        $customer_password = $customer->password;

        if($request->password == ''){
            $request->session()->flash('check_update_password', 'Mật khẩu không được để trống');
            return redirect()->back();
        }
        else if(md5(md5($request->password)) != $customer_password){
            $request->session()->flash('check_update_password', 'Mật khẩu không đúng');
            return redirect()->back();
        }
        else{
            $this->validate($request, [
                'password_new' => 'required|min:8',
                'password_new_confirmation' => 'required|same:password_new',
            ],[
                'password_new.required' => 'Mật khẩu không được để trống',
                'password_new.min' => 'Mật khẩu phải có độ dài tối thiểu 8 ký tự',
                'password_new_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
                'password_new_confirmation.same' => 'Mật khẩu không khớp',
            ]);
            $customer->password = md5(md5($request->password_new));
            $customer->save();
            return redirect()->back();
        }
    }

    public function order_account(){
        $customer_id = Session::get('customer_id');
        $customer = Customer::where('customer_id', $customer_id)->first();
        $customer_info = Customer_Info::where('customer_id', $customer_id)->first();
        $all_cart = Cart::where('customer_id', $customer_id)->where('status', 1)->get();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();
        return view('client.user.order', compact('customer_info', 'customer', 'all_product', 'all_cart', 'all_price'));
    }
}
