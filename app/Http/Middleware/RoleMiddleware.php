<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Kiểm tra xem đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Kiểm tra quyền hạn (Role)
        // User hiện tại có role trùng với role yêu cầu không?
        // Ví dụ: middleware('role:admin') -> $role = 'admin'
        if (Auth::user()->role !== $role) {
            // Nếu không đúng quyền -> Báo lỗi 403
            abort(403, 'Bạn không có quyền truy cập vào trang này.');
        }

        return $next($request);
    }
}