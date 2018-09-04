<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        // 如果登录;则重定向到首页
        if (session('admin.is_login') == 1) {
            return redirect('admin');
        }
        return $next($request);
    }
}
