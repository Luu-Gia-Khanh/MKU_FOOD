<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Roles;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = false;
    protected $fillable = [
    	'admin_email', 'password', 'name','phone','avt'
    ];

    public function roles(){
        return $this->belongsToMany('App\Roles', 'admin_roles');
    }
    public function getAuthPassword(){
        return $this->password;
    }
    // public function hasAnyRoles($roles){

    //     if(is_array($roles)){
    //         foreach($roles as $role){
    //             if($this->hasRole($role)){
    //                 return true;
    //             }
    //         }
    //     }else{
    //         if($this->hasRole($roles)){
    //             return true;
    //         }
    //     }
    //     return false;
    // }
    // public function hasRole($role){
    //     if($this->roles()->where('name',$role)->first()){
    //         return true;
    //     }
    //     return false;
    // }
    public function hasRole($role){
        return null !== $this->roles()->where('name',$role)->first();
    }
    public function hasAnyRoles($roles){
        return null !== $this->roles()->where('name',$roles)->first();
    }
}
