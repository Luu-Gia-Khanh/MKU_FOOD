<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Auth;
use Closure;

class PermissionManager
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
            if(Auth::user()->hasRole('manager')){
                return $next($request);
            }
            else{
                return redirect('admin/dashboard');
            }
        }
        else{
            return redirect('login');
        }
    }
}
