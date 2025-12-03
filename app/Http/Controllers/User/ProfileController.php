<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest; // Sử dụng lại Request mặc định của Breeze hoặc tạo mới
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // Để xử lý file ảnh
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Hiển thị trang hồ sơ
     */
    public function edit(Request $request): View
    {
        return view('frontend.user.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Cập nhật thông tin cá nhân & Avatar
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validate dữ liệu
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female,other'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Tối đa 2MB
        ]);

        // Cập nhật thông tin cơ bản
        $user->fill($request->except(['avatar']));

        // Nếu có đổi email thì reset xác thực (Tùy chọn)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // --- XỬ LÝ UPLOAD AVATAR ---
        if ($request->hasFile('avatar')) {
            // 1. Xóa ảnh cũ nếu có (trừ ảnh mặc định nếu bạn set)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // 2. Lưu ảnh mới vào thư mục 'avatars' trong storage/app/public
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Xóa tài khoản (Giữ nguyên logic của Breeze nếu cần)
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}