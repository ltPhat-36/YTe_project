<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string'], // Chấp nhận chuỗi bất kỳ (SĐT hoặc Email)
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Lấy dữ liệu từ ô nhập liệu (lúc này name="email" ở form)
        $input = $this->input('email');

        // LOGIC QUAN TRỌNG:
        // Kiểm tra xem người dùng nhập vào là Email hay Số điện thoại
        // Nếu đúng định dạng email -> tìm cột 'email'
        // Nếu không phải email -> tìm cột 'phone'
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Thử đăng nhập với cột tương ứng ($field)
        if (! Auth::attempt([$field => $input, 'password' => $this->input('password')], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}