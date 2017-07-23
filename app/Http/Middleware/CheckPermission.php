<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if(Auth::check() && (Auth::user()->can('admin') || Auth::user()->can($permission))) {
            return $next($request);
        } else {
            return redirect()->back();
        }


    }

}