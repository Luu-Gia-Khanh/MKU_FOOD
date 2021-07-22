<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function test(){
        return view('admin.discount.test_tag');
    }
}
