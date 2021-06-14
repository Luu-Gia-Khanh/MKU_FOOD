<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;
use Auth;

class AccessPermission
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
            if(Auth::user()->hasAnyRoles(['admin','manager'])){
                return $next($request);
            }
            else{
                return redirect('login');
            }
        }
        else{
            return redirect('login');
        }
    }
}
