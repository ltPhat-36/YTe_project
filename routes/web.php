<?php

use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\DoctorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
// --- MỚI: Import Controller chi tiết bệnh viện (Frontend) và đặt tên khác để tránh trùng ---
use App\Http\Controllers\Frontend\HospitalController as FrontendHospitalController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Doctor\ScheduleController as DoctorScheduleController;
use App\Http\Controllers\Admin\HospitalController; // Đây là Controller của Admin
use App\Http\Controllers\User\ProfileController; 
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

// --- MỚI: Chi tiết cơ sở y tế ---
Route::get('/co-so-y-te/{id}', [FrontendHospitalController::class, 'show'])->name('hospital.show');

// Trang tìm kiếm
Route::get('/tim-kiem', [SearchController::class, 'index'])->name('search');


// =========================================================
// 2. AUTHENTICATED ROUTES (Phải đăng nhập mới xem được)
// =========================================================

Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- USER DASHBOARD ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/booking/cancel/{id}', [DashboardController::class, 'cancel'])->name('booking.cancel');

    // --- CHỨC NĂNG ĐẶT LỊCH ---
    Route::post('/dat-lich', [BookingController::class, 'store'])->name('booking.store');

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =========================================================
// 3. ADMIN ROUTES (Chỉ Admin)
// =========================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/appointment/{id}/status', [AdminDashboardController::class, 'updateStatus'])->name('appointment.update');
    
    // Quản lý bệnh viện
    Route::get('/hospitals/create', [HospitalController::class, 'create'])->name('hospitals.create');
    Route::post('/hospitals', [HospitalController::class, 'store'])->name('hospitals.store');
});


// =========================================================
// 4. DOCTOR ROUTES (Chỉ Bác sĩ)
// =========================================================
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorScheduleController::class, 'index'])->name('dashboard');
    Route::post('/complete/{id}', [DoctorScheduleController::class, 'complete'])->name('complete');
});


// =========================================================
// 5. AUTH ROUTES
// =========================================================
require __DIR__.'/auth.php';