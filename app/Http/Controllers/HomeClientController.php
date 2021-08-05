<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductPrice;
use App\ImageProduct;
use App\Cart;
use App\Storage_Product;
use App\Order_Detail_Status;
use App\Order_Item;
use App\Orders;
use App\Comment;
use App\Rating;
use App\Customer;
use App\Customer_Info;
use App\Discount;
use Session;
use DB;
use Carbon\Carbon;

Session::start();
class HomeClientController extends Controller
{
    public static function check_price_discount($product_id){
        $product = DB::table('product')
        ->join('product_price','product_price.product_id','=','product.product_id')
        ->where('product_price.status',1)->where('product.product_id',$product_id)->first();
        $discount = Discount::find($product->discount_id);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $Ob_price = (object)[];
        if($product->discount_id == null){
            $Ob_price = (object) [
                'percent_discount' => 0,
                'price_now' => $product->price,
                'price_old' => 0
            ];
        }
        else{
            if($discount->start_date_2 != ''){
                if ($now >= $discount->start_date_2 && $now <= $discount->end_date_2){
                    if($discount->condition_discount_2 ==1){
                        $price_discount = ($product->price * $discount->amount_discount_2) / 100;
                        $price_now = $product->price - $price_discount;
                    }
                    else{
                        $price_now = $product->price - $discount->amount_discount_2;
                    }
                    $percent_discount = 100 - ($price_now *100)/$product->price;
                    $Ob_price = (object) [
                        'percent_discount' => $percent_discount,
                        'price_now' => $price_now,
                        'price_old' => $product->price
                    ];
                }
                else{
                    if($now >= $discount->start_date_1 && $now <= $discount->end_date_1){
                        if($discount->condition_discount_1 ==1){
                            $price_discount = ($product->price * $discount->amount_discount_1) / 100;
                            $price_now = $product->price - $price_discount;
                        }
                        else{
                            $price_now = $product->price - $discount->amount_discount_1;
                        }
                        $percent_discount = 100 - ($price_now *100)/$product->price;
                        $Ob_price = (object) [
                            'percent_discount' => $percent_discount,
                            'price_now' => $price_now,
                            'price_old' => $product->price
                        ];
                    }
                    else{
                        $Ob_price = (object) [
                            'percent_discount' => 0,
                            'price_now' => $product->price,
                            'price_old' => 0
                        ];
                    }
                }
            }
            else{
                if($now >= $discount->start_date_1 && $now <= $discount->end_date_1){
                    if($discount->condition_discount_1 ==1){
                        $price_discount = ($product->price * $discount->amount_discount_1) / 100;
                        $price_now = $product->price - $price_discount;
                    }
                    else{
                        $price_now = $product->price - $discount->amount_discount_1;
                    }
                    $percent_discount = 100 - ($price_now *100)/$product->price;
                    $Ob_price = (object) [
                        'percent_discount' => $percent_discount,
                        'price_now' => $price_now,
                        'price_old' => $product->price
                    ];
                }
                else{
                    $Ob_price = (object) [
                        'percent_discount' => 0,
                        'price_now' => $product->price,
                        'price_old' => 0
                    ];
                }
            }
        }
        return $Ob_price;
    }
    public static function info_rating_saled($product_id){
        //Count rating
        $rating_5 = count(Rating::where('product_id',$product_id)->where('rating_level', 5)->get());
        $rating_4 = count(Rating::where('product_id',$product_id)->where('rating_level', 4)->get());
        $rating_3 = count(Rating::where('product_id',$product_id)->where('rating_level', 3)->get());
        $rating_2 = count(Rating::where('product_id',$product_id)->where('rating_level', 2)->get());
        $rating_1 = count(Rating::where('product_id',$product_id)->where('rating_level', 1)->get());

        $all_rating = count(Rating::where('product_id',$product_id)->get());
        if ($all_rating != 0){
            $avg_rating = (($rating_5*5)+($rating_4*4)+($rating_3*3)+($rating_2*2)+($rating_1*1))/$all_rating;
        }
        else{
            $avg_rating = 0;
        }

        // count product saled
        $count_product_saled = Order_Item::where('product_id',$product_id)->sum('quantity_product');

        $Ob_rating = (object) [
            'count_all_rating' => $all_rating,
            'avg_rating' => $avg_rating,
            'count_product_saled' => $count_product_saled,
        ];
        return $Ob_rating;
    }

    //
    public function index(){
        $customer_id = Session::get('customer_id');
        $all_category = Category::all();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();
        $all_cart = Cart::where('customer_id', $customer_id)->where('status', 1)->get();
        $product_storage = Storage_Product::all();
        $all_discount = Discount::all();

        $all_product_join = DB::table('product')
        ->join('category','category.cate_id','=','product.category_id')
        ->join('product_price','product_price.product_id','=','product.product_id')
        ->join('storage_product','storage_product.product_id','=','product.product_id')
        ->where('product.deleted_at', null)->where('product_price.status',1)->get();
        return view('client.home.trangchu',[
            'all_category'=>$all_category,
            'all_product'=>$all_product,
            'all_price' =>$all_price,
            'all_cart' => $all_cart,
            'product_storage' => $product_storage,

            'all_product_join' => $all_product_join,
            'all_discount' => $all_discount,
        ]);
        //dd($all_product_join);
    }
    public function product_detail($product_id){
        $customer_id = Session::get('customer_id');
        $product = Product::find($product_id);
        $cate = Category::where('cate_id',$product->category_id)->first();
        $price = ProductPrice::where('product_id',$product_id)->where('status', 1)->first();
        $all_image = ImageProduct::where('product_id',$product_id)->get();
        $all_cart = Cart::where('customer_id', $customer_id)->where('status', 1)->get();
        $product_storage = Storage_Product::all();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();

        // able rating and comment
        $orders = DB::table('order_detail_status')
                ->join('orders','orders.order_id','=','order_detail_status.order_id')
                ->where('status',1)->where('order_detail_status.status_id',4)
                ->where('customer_id', Session::get('customer_id'))->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $day_now = date('d', strtotime($now));
        $month_now = date('m', strtotime($now));
        $year_now = date('Y', strtotime($now));
        if($orders){
            foreach ($orders as $order){
                $order_time = $order->create_at;
                $day_order = date('d', strtotime($order_time));
                $month_order = date('m', strtotime($order_time));
                $year_order = date('Y', strtotime($order_time));
                $check_day =$this->convert_day($month_now, $day_now) - $this->convert_day($month_order, $day_order);
                if($check_day <= 1){
                    $order_item = Order_Item::where('order_id', $order->order_id)->get();
                    foreach ($order_item as $item){
                        if($item->product_id == $product_id){
                            Session::put('able_rating_comment_'.$product_id, $product_id);
                            break;
                        }
                    }
                }
            }
        }

        //Load rating and comment
        $get = 5;
        $all_rating = Rating::where('product_id',$product_id)->orderBy('rating_id','desc')->get();
        $all_comment = Comment::where('product_id',$product_id)->orderBy('comment_id','desc')->take($get)->get();
        $customers = Customer::all();
        $customer_info = Customer_Info::all();
        $all_comment_to_count = Comment::where('product_id',$product_id)->get();
        $check_show = count($all_comment_to_count) - $get;

        //Count rating
        $rating_5 = count(Rating::where('product_id',$product_id)->where('rating_level', 5)->get());
        $rating_4 = count(Rating::where('product_id',$product_id)->where('rating_level', 4)->get());
        $rating_3 = count(Rating::where('product_id',$product_id)->where('rating_level', 3)->get());
        $rating_2 = count(Rating::where('product_id',$product_id)->where('rating_level', 2)->get());
        $rating_1 = count(Rating::where('product_id',$product_id)->where('rating_level', 1)->get());

        return view('client.home.product_detail',[
            'product'=>$product,
            'cate'=>$cate,
            'price'=>$price,
            'all_image'=>$all_image,
            'all_cart' => $all_cart,
            'all_product'=>$all_product,
            'all_price' =>$all_price,
            'product_storage' => $product_storage,
            'all_rating' => $all_rating,
            'all_comment' => $all_comment,
            'customers' => $customers,
            'customer_info' => $customer_info,
            'check_show' => $check_show,
            'all_comment_to_count' => $all_comment_to_count,
            'rating_5' => $rating_5,
            'rating_4' => $rating_4,
            'rating_3' => $rating_3,
            'rating_2' => $rating_2,
            'rating_1' => $rating_1,
        ]);
    }
    public function load_detail_product(Request $request){
        $product_id = $request->product_id;

        $product = Product::find($product_id);
        $cate = Category::where('cate_id',$product->category_id)->first();
        $price = ProductPrice::where('product_id',$product_id)->where('status', 1)->first();
        $product_storage = Storage_Product::where('product_id',$product_id)->where('deleted_at', null)->first();

        echo view('client.home.mini_detail_product',[
            'product' =>$product,
            'cate' =>$cate,
            'price' =>$price,
            'product_storage' =>$product_storage,
        ]);
    }
    public function convert_day($month, $date){
        $num_day = 0;
        switch ($month) {
            case 1:
                $num_day = $date + $month*31;
                break;
            case 2:
                $num_day = $date + $month*28;
                break;
            case 3:
                $num_day = $date + $month*31;
                break;
            case 4:
                $num_day = $date + $month*30;
                break;
            case 5:
                $num_day = $date + $month*31;
                break;
            case 6:
                $num_day = $date + $month*30;
                break;
            case 7:
                $num_day = $date + $month*31;
                break;
            case 8:
                $num_day = $date + $month*31;
                break;
            case 9:
                $num_day = $date + $month*30;
                break;
            case 10:
                $num_day = $date + $month*31;
                break;
            case 11:
                $num_day = $date + $month*30;
                break;
            case 12:
                $num_day = $date + $month*31;
                break;
        }
        return $num_day;
    }

    public function add_comment_rating(Request $request){
        $number_rate = $request->number_rate;
        $comment_message = $request->comment_message;
        $product_id = $request->product_id;
        $customer_id = Session::get('customer_id');

        $add_rating = new Rating();
        $add_rating->customer_id = $customer_id;
        $add_rating->product_id = $product_id;
        $add_rating->rating_level = $number_rate;
        $add_rating->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $add_rating->save();

        $add_comment = new Comment();
        $add_comment->comment_id = $add_rating->rating_id;
        $add_comment->customer_id = $customer_id;
        $add_comment->product_id = $product_id;
        $add_comment->comment_message = $comment_message;
        $add_comment->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $add_comment->save();

    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $all_rating = Rating::where('product_id',$product_id)->orderBy('rating_id','desc')->get();
        $all_comment = Comment::where('product_id',$product_id)->orderBy('comment_id','desc')->take(5)->get();
        $customers = Customer::all();
        $customer_info = Customer_Info::all();

        echo view('client.home.view_load_comment_ajax',[
            'all_rating'=> $all_rating,
            'all_comment'=> $all_comment,
            'customers'=> $customers,
            'customer_info'=> $customer_info,
        ]);
    }
    public function load_more_comment(Request $request){
        $val_add_more = $request->val_load_add;
        $product_id = $request->product_id;
        $all_rating = Rating::where('product_id',$product_id)->orderBy('rating_id','desc')->get();
        $all_comment = Comment::where('product_id',$product_id)->orderBy('comment_id','desc')->take($val_add_more)->get();
        $customers = Customer::all();
        $customer_info = Customer_Info::all();

        echo view('client.home.view_load_comment_ajax',[
            'all_rating'=> $all_rating,
            'all_comment'=> $all_comment,
            'customers'=> $customers,
            'customer_info'=> $customer_info,
        ]);
    }
    public function like_comment(Request $request){
        $comment_id = $request->comment_id;

        $session = Session::get('user_like_comment_'.$comment_id);
        if($session == $comment_id){
            $comment = Comment::find($comment_id);
            $count_comment_useful = $comment->comment_useful - 1;
            $comment->comment_useful = $count_comment_useful;
            $comment->save();
            Session::forget('user_like_comment_'.$comment_id);
        }
        else{
            $comment = Comment::find($comment_id);
            $count_comment_useful = $comment->comment_useful + 1;
            $comment->comment_useful = $count_comment_useful;
            $comment->save();
            Session::put('user_like_comment_'.$comment_id, $comment_id);
        }
        echo $count_comment_useful;
    }

    public function shop_product(){
        $customer_id = Session::get('customer_id');
        $all_category = Category::all();
        $all_product = Product::all();
        $all_price = ProductPrice::where('status',1)->get();
        $all_cart = Cart::where('customer_id', $customer_id)->where('status', 1)->get();
        $product_storage = Storage_Product::all();
        return view('client.home.shop_product', [
            'all_category'=>$all_category,
            'all_product'=>$all_product,
            'all_price' =>$all_price,
            'all_cart' => $all_cart,
            'product_storage' => $product_storage,
        ]);
    }
    public function delete_comment(Request $request){
        $comment_id = $request->comment_id;

        $delete_comment = Comment::find($comment_id);
        $delete_comment->delete();

        $delete_rating = Rating::find($comment_id);
        $delete_rating->delete();
    }
    public function update_comment(Request $request){
        $comment_id = $request->comment_id;
        $comment_message = $request->comment_message;

        $update_comment = Comment::find($comment_id);
        $update_comment->comment_message = $comment_message;
        $update_comment->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $update_comment->save();

        $update_rating = Rating::find($comment_id);
        $update_rating->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $update_rating->save();
    }

}
