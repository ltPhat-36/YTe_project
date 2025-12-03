<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Xác thực thông tin đăng nhập
        $request->authenticate();

        // 2. Tái tạo session để bảo mật
        $request->session()->regenerate();

        // 3. LOGIC CHUYỂN HƯỚNG THEO ROLE (MỚI THÊM)
        $role = Auth::user()->role;

        if ($role === 'admin') {
            // Nếu là Admin -> Chuyển đến trang quản trị
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'doctor') {
            // Nếu là Bác sĩ -> Chuyển đến trang lịch làm việc
            return redirect()->route('doctor.dashboard');
        }

        // Nếu là User thường -> Chuyển đến trang Lịch sử khám (hoặc trang chủ nếu muốn)
        // redirect()->intended() sẽ cố gắng đưa user về trang họ muốn vào trước đó
        // Nếu không có, mặc định về route 'dashboard'
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}