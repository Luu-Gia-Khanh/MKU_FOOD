<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Customer_Info;
use App\Rating;
use App\Comment;
use App\Product;
use DB;
use Session;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public static function count_product_in_comment($product_id){
        $Ob_count_product = (object)[];
        $comment = DB::table('customer')
            ->join('comment', 'comment.customer_id', '=', 'customer.customer_id')
            ->join('rating', 'rating.customer_id', '=', 'customer.customer_id')
            ->join('customer_info', 'customer_info.customer_id', '=', 'customer.customer_id')
            ->where('comment.status', 0)
            ->where('comment.product_id', $product_id)
            ->get();
        if(count($comment) > 0){
            $Ob_count_product = $comment;
        }
        return $Ob_count_product;
    }
    public function view_comment_to_process(){
        $all_product = Product::all();
        $comment_join = DB::table('customer')
            ->join('comment', 'comment.customer_id', '=', 'customer.customer_id')
            ->join('rating', 'rating.customer_id', '=', 'customer.customer_id')
            ->join('customer_info', 'customer_info.customer_id', '=', 'customer.customer_id')
            ->where('comment.status', 0)
            ->get();
        return view('admin.comment.view_list_comment',[
            'all_product' => $all_product,
            'comment_join' => $comment_join,
        ]);
    }
    public function process_accep_comment(Request $request){
        $comment_id = $request->comment_id;
        if($comment_id != ''){
            $accept_comment = Comment::find($comment_id);
            $accept_comment->status = 1;
            $result = $accept_comment->save();
            if($result){
                $request->session()->flash('accept_comment_success', 'Duyệt bình luận thành công');
            }
            else{
                $request->session()->flash('accept_comment_error', 'Duyệt bình luận thất bại');
            }
        }
        else{
            $request->session()->flash('accept_comment_error', 'Duyệt bình luận thất bại');
        }
        return redirect()->back();
    }
    public function process_unaccep_comment(Request $request){
        $comment_id = $request->comment_id;
        if($comment_id != ''){
            $unaccept_comment = Comment::find($comment_id);
            $result = $unaccept_comment->delete();
            if($result){
                $request->session()->flash('unaccept_comment_success', 'Xóa bình luận thành công');
            }
            else{
                $request->session()->flash('unaccept_comment_error', 'Xóa bình luận thất bại');
            }
        }
        else{
            $request->session()->flash('unaccept_comment_error', 'Xóa bình luận thất bại');
        }
        return redirect()->back();
    }
}
