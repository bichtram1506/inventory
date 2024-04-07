<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdmin
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
        // Kiểm tra xem người dùng đã đăng nhập và có quyền admin hay không
        $user = Auth::guard('admins')->user();
        
        if ($user) {
            // Người dùng đã đăng nhập và có quyền admin, cho phép truy cập vào tài nguyên được bảo vệ
            return $next($request);
        } else {
            // Người dùng chưa đăng nhập hoặc không có quyền admin, chuyển hướng về trang đăng nhập
            return redirect()->route('login');
        }
    }
}
