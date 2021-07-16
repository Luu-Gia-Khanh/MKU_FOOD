<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order_Detail_Status;
use App\Order_Item;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function all_order(){
        return view('admin.order.all_order');
    }
}
