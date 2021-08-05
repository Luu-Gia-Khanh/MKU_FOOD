<?php

namespace App\Http\Controllers;

use App\Admin_Action_Voucher;
use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPrice;
use App\Voucher;
use Carbon\Carbon;
use Session;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    //
    public static function unique_product($product_id){
        $count_voucher = Voucher::where('product_id', $product_id)->get();
        if(count($count_voucher) > 0){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function all_product_voucher(){
        $all_voucher = Voucher::all();
        $all_product = Product::paginate(10);
        return view('admin.voucher.all_product_voucher', compact('all_product', 'all_voucher'));
    }

    public function all_voucher($product_id){
        $all_voucher = Voucher::where('product_id', $product_id)->orderBy('voucher_id', 'desc')->paginate(10);
        return view('admin.voucher.all_voucher', compact('all_voucher'));
    }

    public function add_voucher(){
        $all_product = Product::paginate(10);
        return view('admin.voucher.add_voucher', compact('all_product'));
    }

    public function process_add_voucher(Request $request){
        $this->validate_voucher($request);

        $voucher_code = $request->voucher_code;
        $voucher_name = $request->voucher_name;
        $product_id = $request->product_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $voucher_amount = $request->voucher_amount;
        $voucher_quantity = $request->voucher_quantity;
        $voucher_type = $request->voucher_type;

        $date_now =Carbon::now('Asia/Ho_Chi_Minh');
        $product = ProductPrice::where('product_id', $product_id)->where('status', 1)->first();
        $product_price = $product->price;

        $check_voucher_code = Voucher::where('voucher_code', $voucher_code)->first();

        if($check_voucher_code){
            $request->session()->flash('voucher_code', 'Mã voucher đã tồn tại');
            return redirect()->back();
        }
        if($start_date < date("Y-m-d\TH:i", strtotime($date_now))){
            $request->session()->flash('start_date', 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại');
            return redirect()->back();
        }
        if($end_date <= $start_date){
            $request->session()->flash('end_date', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
            return redirect()->back();
        }
        if($voucher_quantity < 0){
            $request->session()->flash('check_voucher_quantity', 'Số lượng không hợp lệ');
            return redirect()->back();
        }

        $voucher_new = new Voucher();
        $voucher_new->voucher_code = strtoupper($voucher_code);
        $voucher_new->voucher_name = $voucher_name;
        $voucher_new->product_id = $product_id;
        $voucher_new->start_date = $start_date;
        $voucher_new->end_date = $end_date;
        $voucher_new->voucher_quantity = $voucher_quantity;

        $product = ProductPrice::where('product_id', $product_id)->where('status', 1)->first();
        $product_price = $product->price;

        if($voucher_type == 1){
            if($voucher_amount < 1000){
                $request->session()->flash('voucher_amount', 'Mệnh giá không được nhỏ hơn 1.0000đ');
                return redirect()->back();
            }
            if($voucher_amount > $product_price){
                $request->session()->flash('voucher_amount', 'Mệnh giá không được lớn hơn '.number_format($product_price, 0, ',', '.').'đ');
                return redirect()->back();
            }
            $voucher_new->voucher_amount = $voucher_amount;
        }
        else{
            if($voucher_amount < 1 || $voucher_amount > 100){
                $request->session()->flash('voucher_amount', 'Mệnh giá phải từ 1-100%');
                return redirect()->back();
            }
            else{
                $voucher_new->voucher_amount = $product_price * ($voucher_amount/100);
            }
        }
        $voucher_new->status = 1;
        $result_voucher_new = $voucher_new->save();

        if($result_voucher_new){
            $admin_action_voucher = new Admin_Action_Voucher();
            $admin_action_voucher->admin_id = Session::get('admin_id');
            $admin_action_voucher->voucher_id = $voucher_new->voucher_id;
            $admin_action_voucher->action_id = 1;
            $admin_action_voucher->action_message = 'Thêm voucher';
            $admin_action_voucher->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $admin_action_voucher->save();

            $request->session()->flash('add_voucher_success', 'Thiết lập voucher cho sản phẩm thành công');
            return redirect('admin/all_voucher/'.$product_id);
        }
    }

    public function update_voucher($voucher_id){
        $all_product = Product::all();
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        return view('admin.voucher.update_voucher', compact('voucher', 'all_product'));
    }

    public function process_update_voucher(Request $request, $voucher_id){

        $this->validate_voucher($request);

        $voucher_code = $request->voucher_code;
        $voucher_name = $request->voucher_name;
        $product_id = $request->product_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $voucher_amount = $request->voucher_amount;
        $voucher_quantity = $request->voucher_quantity;

        $product = ProductPrice::where('product_id', $product_id)->where('status', 1)->first();
        $product_price = $product->price;

        $date_now = Carbon::now('Asia/Ho_Chi_Minh');

        $check_voucher_code_first = Voucher::where('voucher_id', $voucher_id)->first();
        $check_voucher_code_second = Voucher::where('voucher_code', $voucher_code)->first();

        if($check_voucher_code_first->voucher_code == $voucher_code){
            $voucher_code = $check_voucher_code_first->voucher_code;
        }
        else{
            if($check_voucher_code_second){
                $request->session()->flash('voucher_code', 'Mã voucher đã tồn tại');
                return redirect()->back();
            }
        }
        if($start_date < date("Y-m-d\TH:i", strtotime($date_now))){
            $request->session()->flash('start_date', 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại');
            return redirect()->back();
        }
        if($end_date <= $start_date){
            $request->session()->flash('end_date', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
            return redirect()->back();
        }
        if($voucher_quantity < 0){
            $request->session()->flash('check_voucher_quantity', 'Số lượng không hợp lệ');
            return redirect()->back();
        }

        $voucher_update = Voucher::where('voucher_id', $voucher_id)->first();
        $voucher_update->voucher_code = strtoupper($voucher_code);
        $voucher_update->voucher_name = $voucher_name;
        $voucher_update->product_id = $product_id;
        $voucher_update->start_date = $start_date;
        $voucher_update->end_date = $end_date;
        $voucher_update->voucher_quantity = $voucher_quantity;

        $product = ProductPrice::where('product_id', $product_id)->where('status', 1)->first();
        $product_price = $product->price;

        if($voucher_amount < 1000){
            $request->session()->flash('voucher_amount', 'Mệnh giá không được nhỏ hơn 1.000đ');
            return redirect()->back();
        }
        elseif($voucher_amount > $product_price){
            $request->session()->flash('voucher_amount', 'Mệnh giá không được lớn hơn '.number_format($product_price, 0, ',', '.').'đ');
            return redirect()->back();
        }
        else{
            $voucher_update->voucher_amount = $voucher_amount;
        }
        $result_voucher_update = $voucher_update->save();

        if($result_voucher_update){
            $admin_action_voucher = new Admin_Action_Voucher();
            $admin_action_voucher->admin_id = Session::get('admin_id');
            $admin_action_voucher->voucher_id = $voucher_id;
            $admin_action_voucher->action_id = 2;
            $admin_action_voucher->action_message = 'Sửa voucher';
            $admin_action_voucher->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $admin_action_voucher->save();

            $request->session()->flash('update_voucher_success', 'Thiết lập lại voucher cho sản phẩm thành công');
            return redirect('admin/all_voucher/'.$product_id);
        }
    }

    public function get_voucher_id(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher_detail = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        echo $voucher_detail->voucher_code;
    }

    public function get_voucher_name(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        echo $voucher->voucher_name;
    }

    public function get_voucher_product(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        $product_id = $voucher->product_id;
        $product = Product::where('product_id', $product_id)->first();
        echo $product->product_name;
    }

    public function get_voucher_start_date(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        echo date("d-m-Y H:i a", strtotime($voucher->start_date));
    }

    public function get_voucher_end_date(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        echo date("d-m-Y H:i a", strtotime($voucher->end_date));
    }

    public function get_voucher_amount(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        echo number_format($voucher->voucher_amount, 0, ',', '.').' vnđ';
    }

    public function get_voucher_quantity(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        echo $voucher->voucher_quantity;
    }

    public function get_voucher_status(Request $request){
        $voucher_id = $request->voucher_id;
        $now = Carbon::now();
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        if($voucher->start_date <= $now && $now <= $voucher->end_date){
            echo '<span class="badge badge-success" style="width: 105px;">Đang áp dụng</span>';
        }else{
            echo '<span class="badge badge-danger" style="width: 105px;">Ngưng áp dụng</span>';
        }
    }

    public function find_product_voucher(Request $request) {
        $val_find_product_voucher = $request->value_find;
        $all_voucher = Voucher::all();
        $all_product_voucher = Product::where('product_name', 'LIKE','%'.$val_find_product_voucher.'%')->get();
        echo view('admin.voucher.find_result_product_voucher', compact('all_product_voucher', 'all_voucher'));
        // echo $val_find_product_voucher;
    }

    public function validate_voucher(Request $request){
        $request->validate([
            'voucher_code' => 'required|min:5|max:10|alpha_dash|regex:/^([a-z A-Z 0-9]+)$/',
            'voucher_name' => 'required|min:5|max:100',
            'product_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'voucher_amount' => 'required',
            'voucher_quantity' => 'required|integer',
        ],[
            'voucher_code.required' => 'Mã voucher không được để trống',
            'voucher_code.alpha_dash' => 'Mã voucher không hợp lệ',
            'voucher_code.regex' => 'Mã voucher không hợp lệ',
            'voucher_code.min' => 'Mã voucher phải lớn hơn 5 ký tự',
            'voucher_code.max' => 'Mã voucher không lớn hơn 10 ký tự',
            'product_id.required' => 'Vui lòng chọn sản phẩm cho voucher',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc',
            'voucher_name.required' => 'Tên voucher không được để trống',
            'voucher_name.min' => 'Tên voucher phải lớn hơn 5 ký tự',
            'voucher_name.max' => 'Tên voucher phải nhỏ hơn hoặc bằng 10 ký tự',
            'voucher_amount.required' => 'Vui lòng nhập mệnh giá',
            'voucher_quantity.required' => 'Vui lòng nhập số lượng',
            'voucher_quantity.integer' => 'Số lượng không hợp lệ',
        ]);
    }
}