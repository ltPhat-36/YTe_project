<?php

use App\Http\Controllers\Frontend\BookingController; // <-- MỚI: Import BookingController
use App\Http\Controllers\Frontend\DoctorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================================================
// 1. PUBLIC ROUTES (Ai cũng xem được)
// =========================================================

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Chi tiết bác sĩ
Route::get('/bac-si/{id}', [DoctorController::class, 'show'])->name('doctor.show');


// =========================================================
// 2. AUTHENTICATED ROUTES (Phải đăng nhập mới xem được)
// =========================================================

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Trang Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- ROUTE XỬ LÝ ĐẶT LỊCH (QUAN TRỌNG) ---
    Route::post('/dat-lich', [BookingController::class, 'store'])->name('booking.store');
    // -----------------------------------------

    // Quản lý hồ sơ cá nhân
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================
// 3. AUTH ROUTES (Nạp các route Login/Register)
// =========================================================
require __DIR__.'/auth.php';