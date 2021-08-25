<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order_Detail_Status;
use App\Order_Item;
use App\Orders;
use Illuminate\Http\Request;
use App\Product;
use App\Customer_Transport;
use App\Admin_Action_Order;
use App\Customer;
use App\Mail\Confirm_Order_Mail;
use App\Voucher;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function all_order(){
        $orders = Orders::orderBy('order_id', 'desc')->paginate(10);
        $order_detail_status = Order_Detail_Status::where('status',1)->get();
        $payment_method = DB::table('payment_method')->get();
        $status_order = DB::table('status_order')->get();
        $wait_confirm = Order_Detail_Status::where('status',1)->where('status_id',1)->get();
        $confirmed = Order_Detail_Status::where('status',1)->where('status_id',2)->get();
        $delivering = Order_Detail_Status::where('status',1)->where('status_id',3)->get();
        $delivery_success = Order_Detail_Status::where('status',1)->where('status_id',4)->get();
        $cancelled = Order_Detail_Status::where('status',1)->where('status_id',5)->get();

        return view('admin.order.all_order',[
            'orders' => $orders,
            'order_detail_status' => $order_detail_status,
            'payment_method' => $payment_method,
            'status_order' => $status_order,
            'wait_confirm' => $wait_confirm,
            'confirmed' => $confirmed,
            'delivering' => $delivering,
            'delivery_success' => $delivery_success,
            'cancelled' => $cancelled,
        ]);
    }
    public function await_confirm_order(){
        $orders = DB::table('order_detail_status')
                ->join('orders','orders.order_id','=','order_detail_status.order_id')
                ->join('status_order','status_order.status_id','=','order_detail_status.status_id')
                ->where('status',1)->where('order_detail_status.status_id',1)->get();
        $payment_method = DB::table('payment_method')->get();
        return view('admin.order.await_confirm_order',[
            'orders'=>$orders,
            'payment_method'=>$payment_method
        ]);
    }
    public function confirm_order(Request $request){
        $order_code = $request->order_code;
        $order = Orders::where('order_code', $order_code)->first();
        $detail_status_id = Order_Detail_Status::where('status',1)->where('status_id',1)->where('order_id',$order->order_id)->first();

        $update_order_detail_status = Order_Detail_Status::where('detail_status_id',$detail_status_id->detail_status_id)->first();
        $update_order_detail_status->status = 0;
        $result_update = $update_order_detail_status->save();

        if($result_update){
            $add_order_detail_status = new Order_Detail_Status();
            $add_order_detail_status->order_id = $order->order_id;
            $add_order_detail_status->status_id = 2;
            $add_order_detail_status->time_status = Carbon::now('Asia/Ho_Chi_Minh');
            $add_order_detail_status->status = 1;
            $add_order_detail_status->save();
            //
            $action_order = new Admin_Action_Order();
            $action_order->admin_id = Session::get('admin_id');
            $action_order->order_id = $order->order_id;
            $action_order->action_id = 6;
            $action_order->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_order->action_message = 'Duyệt đơn hàng';
            $action_order->save();

            //
            $data=[
                'order' => $order,
            ];
            $customer = Customer::find($order->customer_id);
            Mail::to($customer->email)->send(new Confirm_Order_Mail($data));

            $request->session()->flash('confirm_success', 'Xác nhận đơn hàng thành công');
            return redirect()->back();
        }
    }
    public function confirmed(){
        $orders = DB::table('order_detail_status')
                ->join('orders','orders.order_id','=','order_detail_status.order_id')
                ->join('status_order','status_order.status_id','=','order_detail_status.status_id')
                ->where('status',1)->where('order_detail_status.status_id',2)->get();
        $payment_method = DB::table('payment_method')->get();
        return view('admin.order.confirmed_order',[
            'orders'=>$orders,
            'payment_method'=>$payment_method
        ]);
    }
    public function confirm_delivary_order(Request $request){
        $order_code = $request->order_code;
        $order = Orders::where('order_code', $order_code)->first();
        $detail_status_id = Order_Detail_Status::where('status',1)->where('status_id',2)->where('order_id',$order->order_id)->first();

        $update_order_detail_status = Order_Detail_Status::where('detail_status_id',$detail_status_id->detail_status_id)->first();
        $update_order_detail_status->status = 0;
        $result_update = $update_order_detail_status->save();

        if($result_update){
            $add_order_detail_status = new Order_Detail_Status();
            $add_order_detail_status->order_id = $order->order_id;
            $add_order_detail_status->status_id = 3;
            $add_order_detail_status->time_status = Carbon::now('Asia/Ho_Chi_Minh');
            $add_order_detail_status->status = 1;
            $add_order_detail_status->save();
            //
            $action_order = new Admin_Action_Order();
            $action_order->admin_id = Session::get('admin_id');
            $action_order->order_id = $order->order_id;
            $action_order->action_id = 6;
            $action_order->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_order->action_message = 'Duyệt giao đơn hàng';
            $action_order->save();

            $request->session()->flash('confirm_delivary_success', 'Xác nhận đơn hàng đang giao thành công');
            return redirect()->back();
        }
    }
    public function delivering(){
        $orders = DB::table('order_detail_status')
                ->join('orders','orders.order_id','=','order_detail_status.order_id')
                ->join('status_order','status_order.status_id','=','order_detail_status.status_id')
                ->where('status',1)->where('order_detail_status.status_id',3)->get();
        $payment_method = DB::table('payment_method')->get();
        return view('admin.order.delivering_order',[
            'orders'=>$orders,
            'payment_method'=>$payment_method
        ]);
    }
    public function confirm_delivery_success_order(Request $request){
        $order_code = $request->order_code;
        $order = Orders::where('order_code', $order_code)->first();
        $detail_status_id = Order_Detail_Status::where('status',1)->where('status_id',3)->where('order_id',$order->order_id)->first();

        $update_order_detail_status = Order_Detail_Status::where('detail_status_id',$detail_status_id->detail_status_id)->first();
        $update_order_detail_status->status = 0;
        $result_update = $update_order_detail_status->save();

        if($result_update){
            $add_order_detail_status = new Order_Detail_Status();
            $add_order_detail_status->order_id = $order->order_id;
            $add_order_detail_status->status_id = 4;
            $add_order_detail_status->time_status = Carbon::now('Asia/Ho_Chi_Minh');
            $add_order_detail_status->status = 1;
            $add_order_detail_status->save();

            $update_status_payment_order = Orders::find($order->order_id);
            $update_status_payment_order -> status_pay = 1;
            $update_status_payment_order -> save();

            //
            $action_order = new Admin_Action_Order();
            $action_order->admin_id = Session::get('admin_id');
            $action_order->order_id = $order->order_id;
            $action_order->action_id = 6;
            $action_order->action_time = Carbon::now('Asia/Ho_Chi_Minh');
            $action_order->action_message = 'Xác nhận giao hàng thành công';
            $action_order->save();

            //


            $request->session()->flash('confirm_delivary_success_order', 'Xác nhận giao đơn hàng thành công');
            return redirect()->back();
        }
    }
    public function delivery_success(){
        $orders = DB::table('order_detail_status')
                ->join('orders','orders.order_id','=','order_detail_status.order_id')
                ->join('status_order','status_order.status_id','=','order_detail_status.status_id')
                ->where('status',1)->where('order_detail_status.status_id',4)->orderBy('orders.order_id','desc')->get();
        $payment_method = DB::table('payment_method')->get();
        return view('admin.order.delivery_success',[
            'orders'=>$orders,
            'payment_method'=>$payment_method
        ]);
    }
    public function cancelled(){
        $orders = DB::table('order_detail_status')
                ->join('orders','orders.order_id','=','order_detail_status.order_id')
                ->join('status_order','status_order.status_id','=','order_detail_status.status_id')
                ->where('status',1)->where('order_detail_status.status_id',5)->get();
        $payment_method = DB::table('payment_method')->get();
        return view('admin.order.order_cancelled',[
            'orders'=>$orders,
            'payment_method'=>$payment_method
        ]);
    }
    public function search_order(Request $request){
        $search_order = $request->search_order;
        $result_find = Orders::where('order_code','LIKE','%'.$search_order.'%')
        ->orwhere('total_price','LIKE','%'.$search_order.'%')->get();

        $order_detail_status = Order_Detail_Status::where('status',1)->get();
        $payment_method = DB::table('payment_method')->get();
        $status_order = DB::table('status_order')->get();
        echo view('admin.order.view_search_order',[
            'orders'=>$result_find,
            'order_detail_status'=>$order_detail_status,
            'payment_method'=>$payment_method,
            'status_order'=>$status_order,
        ]);
    }
    public function detail_order_item(Request $request){
        $order_id = $request->order_id;
        $order_item = Order_Item::where('order_id', $order_id)->get();
        $product = Product::all();
        $order = Orders::find($order_id);
        $payment_method = DB::table('payment_method')->get();
        $status_order = DB::table('status_order')->get();
        $detail_status = Order_Detail_Status::where('order_id',$order_id)->where('status',1)->first();
        $transport = Customer_Transport::find($order->trans_id);
        $time_line = Order_Detail_Status::where('order_id', $order_id)->get();
        $all_voucher = Voucher::all();
        return view('admin.order.order_detail_item',[
            'order_item' =>$order_item,
            'product' =>$product,
            'order' =>$order,
            'payment_method' =>$payment_method,
            'status_order' =>$status_order,
            'detail_status' =>$detail_status,
            'trans' =>$transport,
            'time_line' =>$time_line,
            'all_voucher' =>$all_voucher,
        ]);
    }
}
