<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Kiểm tra dữ liệu đầu vào (Validate)
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id', // Bác sĩ phải tồn tại
            'appointment_date' => 'required|date|after_or_equal:today', // Ngày phải từ hôm nay trở đi
            'appointment_time' => 'required', // Giờ không được để trống
        ], [
            'appointment_date.required' => 'Vui lòng chọn ngày khám!',
            'appointment_date.after_or_equal' => 'Không thể chọn ngày trong quá khứ!',
            'appointment_time.required' => 'Vui lòng chọn giờ khám!',
        ]);

        // 2. Lưu vào Database (Bảng appointments)
        Appointment::create([
            'user_id' => Auth::id(), // Lấy ID của người đang đăng nhập
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'symptoms' => $request->symptoms ?? 'Đặt lịch trực tuyến', // Mặc định nếu không nhập
            'status' => 'pending', // Trạng thái chờ xác nhận
        ]);

        // 3. Thông báo và quay về trang chủ
        return redirect()->route('home')->with('success', 'Đặt lịch thành công! Vui lòng chờ xác nhận.');
    }
}