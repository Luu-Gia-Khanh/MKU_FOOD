<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Roles;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard.dashbord');
    }
    public function show_admin(){
        $all_admin = Admin::all();
        return view('admin.admin.all_admin',['all_admin'=>$all_admin]);
    }
    public function list_permission(){
        $admin = Admin::with('roles')->orderBy('admin_id','asc')->paginate(5);
        return view('admin.admin.list_permission',['admin'=>$admin]);
    }
    public function assign_roles(Request $request){
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['admin']){
            $user->roles()->attach(Roles::where('name','admin')->first());
         }
        if($request['manager']){
           $user->roles()->attach(Roles::where('name','manager')->first());
        }
        if($request['user']){
            $user->roles()->attach(Roles::where('name','user')->first());
         }
        return redirect()->back();
    }
}
