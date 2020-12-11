<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
//use Illuminate\Routing\;

class AuthMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //dd(1);
       // return $next($request);
        if (Auth::check())
        {
            return $next($request);
        }
        return redirect()->route('auth.login');
    }
}
