<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'product_price';
    public $timestamps = false;
    protected $primaryKey = 'price_id';
    protected $fillable = [
    	'product_id', 'price', 'status', 'updated_at'
    ];
}
