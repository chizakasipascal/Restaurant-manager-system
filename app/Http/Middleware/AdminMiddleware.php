<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            // for admin role is 1
            // for user role is 0
            if(Auth::user()->role=='1'){
                return $next($request);
            }else{
                return redirect('/sales/create');
            }
        }else{
            return redirect('/login')->with('Message',"Vieller, vous connecté au système. S'il vous plaît");
        }
        return $next($request);
    }
}
