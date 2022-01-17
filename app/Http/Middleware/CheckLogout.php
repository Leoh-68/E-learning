<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()){
            if (Auth::user()->accounttype == 1) {
                return redirect()->route('Admin')->with('message','Bạn đang đăng nhập!!!');
            }
            if (Auth::user()->accounttype == 3) {
                return redirect()->route('showClassStudent')->with('message','Bạn đang đăng nhập!!!');
            }
            if (Auth::user()->accounttype == 2) {
                return redirect()->route('showClass')->with('message','Bạn đang đăng nhập!!!');
            }
        }
        return $next($request);
    }
}
