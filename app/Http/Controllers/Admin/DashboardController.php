<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // <-- Import Mail Facade
use App\Mail\BookingConfirmed;       // <-- Import Mailable Xác nhận
use App\Mail\BookingCancelled;       // <-- Import Mailable Hủy

class DashboardController extends Controller
{
    public function index()
    {
        // --- PHẦN 1: THỐNG KÊ SỐ LIỆU ---
        
        // 1. Tổng số bệnh nhân
        $totalPatients = User::where('role', 'user')->count();

        // 2. Tổng số bác sĩ
        $totalDoctors = Doctor::count();

        // 3. Tổng số lịch hẹn
        $totalAppointments = Appointment::count();

        // 4. Doanh thu ước tính (Tính các ca đã hoàn thành)
        $totalRevenue = Appointment::where('status', 'completed')
            ->with('doctor')
            ->get()
            ->sum(function($appointment) {
                return $appointment->doctor->price ?? 0; 
            });

        // --- PHẦN 2: DANH SÁCH LỊCH HẸN ---
        $appointments = Appointment::with(['user', 'doctor'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dashboard', compact(
            'appointments', 
            'totalPatients', 
            'totalDoctors', 
            'totalAppointments', 
            'totalRevenue'
        ));
    }

    // Hàm cập nhật trạng thái & Gửi Mail
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed'
        ]);

        // Lưu trạng thái mới vào DB
        $appointment->status = $request->status;
        $appointment->save();

        // --- LOGIC GỬI EMAIL TỰ ĐỘNG ---
        // Kiểm tra xem user có email không để tránh lỗi
        if ($appointment->user && $appointment->user->email) {
            try {
                // Nếu trạng thái là "Đã duyệt" (confirmed) -> Gửi mail xác nhận
                if ($request->status == 'confirmed') {
                    Mail::to($appointment->user->email)->send(new BookingConfirmed($appointment));
                } 
                // Nếu trạng thái là "Đã hủy" (cancelled) -> Gửi mail báo hủy
                elseif ($request->status == 'cancelled') {
                    Mail::to($appointment->user->email)->send(new BookingCancelled($appointment));
                }
            } catch (\Exception $e) {
                // Nếu gửi mail lỗi (do mạng, sai pass...) thì log lỗi lại nhưng không làm crash ứng dụng
                // \Log::error("Lỗi gửi mail: " . $e->getMessage());
            }
        }
        // ------------------------------

        return redirect()->back()->with('success', 'Cập nhật trạng thái & Gửi email thông báo thành công!');
    }
}