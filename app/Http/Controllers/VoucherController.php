<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPrice;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    //
    public function all_voucher(){
        $all_product = Product::all();
        $all_voucher = Voucher::all();
        return view('admin.voucher.all_voucher', compact('all_voucher', 'all_product'));
    }

    public function add_voucher(){
        $all_product = Product::all();
        return view('admin.voucher.add_voucher', compact('all_product'));
    }

    function generateRandomString($length = 4) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
        $date = date("dmy", strtotime(Carbon::now()));

        $date_now =Carbon::now('Asia/Ho_Chi_Minh');
        $product = ProductPrice::where('product_id', $product_id)->where('status', 1)->first();
        $product_price = $product->price;
        if($start_date < $date_now){
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
        if($voucher_type == 1){
            if($voucher_amount < 1000){
                $request->session()->flash('voucher_amount', 'Mệnh giá không được nhỏ hơn 1000vnd');
                return redirect()->back();
            }
            else{
                $voucher_new->voucher_amount = $voucher_amount;
            }
        }
        else{
            if($voucher_amount < 1 || $voucher_amount >100){
                $request->session()->flash('voucher_amount', 'Mệnh giá phải từ 1-100%');
                return redirect()->back();
            }
            else{
                $voucher_new->voucher_amount = $product_price * ($voucher_amount/100);
            }
        }
        $voucher_new->status = 1;
        $voucher_new->save();
        return redirect('admin/all_voucher');
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
        $start_date = date("d-m-y H:i:s", strtotime($request->start_date));
        $end_date = date("d-m-y H:i:s", strtotime($request->end_date));
        $voucher_amount = $request->voucher_amount;
        $voucher_quantity = $request->voucher_quantity;

        $date_now =Carbon::now('Asia/Ho_Chi_Minh');
        if($start_date < $date_now){
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
        if($voucher_amount < 1000){
            $request->session()->flash('voucher_amount', 'Mệnh giá không được nhỏ hơn 1000vnd');
            return redirect()->back();
        }
        DB::table('voucher')->where('voucher_id', $voucher_id)->update([
            'voucher_code' => strtoupper($voucher_code),
            'voucher_name' => $voucher_name,
            'product_id' => $product_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'voucher_quantity' => $voucher_quantity,
            'voucher_amount' => $voucher_amount,
            'status' => 1,
        ]);
        return redirect('admin/all_voucher');
    }

    public function get_voucher_id(Request $request){
        $voucher_id = $request->voucher_id;
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        echo $voucher->voucher_code;
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
        $voucher = DB::table('voucher')->where('voucher_id', $voucher_id)->first();
        if($voucher->status == 1){
            echo 'Đang áp dụng';
        }else{
            echo 'Ngưng áp dụng';
        }
    }

    public function find_voucher(Request $request) {
        $val_find_voucher = $request->value_find;
        $all_voucher = DB::table('voucher')->where('voucher_name', 'LIKE','%'.$val_find_voucher.'%')->get();
        echo view('admin.voucher.find_result_voucher', compact('all_voucher'));
    }

    public function validate_voucher(Request $request){
        $request->validate([
            'voucher_code' => 'required|min:5|max:10|alpha_dash|regex:/^([a-z A-Z 1-9]+)$/',
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
