<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin_Action_Category extends Model
{
    //
    protected $table = 'admin_action_category';
    protected $primaryKey = 'id';
    protected $fillable = ['action_id', ''];
    public $timestamps = false;
}
