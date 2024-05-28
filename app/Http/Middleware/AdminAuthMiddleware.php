<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        //dd($user);
        if (!$user) {
            return redirect()->route('admin.auth.login')->with('error', 'Bạn chưa đăng nhập');
        }
        if ($user->role_id != 1) {
            return redirect()->route('admin.auth.login')->with('error', 'Không có quyền truy cập, không phải tài khoản admin');
        }
        return $next($request);
    }
}
