<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorageProduct extends Model
{
    use Notifiable,
        SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'storage_product';
    public $timestamps = false;
    protected $primaryKey = 'storage_product_id';
    protected $fillable = [
    	'storage_id', 'product_id','total_quantity_product',
    ];
}
