<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiangVienAccess
{
  
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->accounttype == 2) {
            return $next($request);
        }
        elseif (Auth::user()->accounttype == 1) {
            return redirect()->route('Admin')->with('message','URL không hoạt động!!!');
         }
        elseif (Auth::user()->accounttype == 3) {
            return redirect()->route('showClassStudent')->with('message','Tài khoản của bạn không có quyền truy cập trang này!!!');
        } else if (Auth::check()==false) {
            return redirect()->route('Wellcome');
        }   
    }
}