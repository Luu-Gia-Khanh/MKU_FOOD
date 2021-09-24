<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class PermissionDelivery
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->hasRole('delivery')){
                return $next($request);
            }
            else{
                $request->session()->flash('no_permission', 'Bạn không có quyền truy cập trang này');
                return redirect('all_order_delivering/');
            }
        }
        else{
            return redirect('login_shipper');
        }
    }
}
