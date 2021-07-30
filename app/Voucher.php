<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $table = 'voucher';
    protected $primarykey ='voucher_id';
    protected $fillable = ['voucher_code', 'voucher_name', 'voucher_quantity', 'voucher_amount', 'product_id', 'start_date', 'end_date', 'status'];
    public $timestamps = false;
}
