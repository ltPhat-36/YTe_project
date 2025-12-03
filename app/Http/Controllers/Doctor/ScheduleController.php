<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Hiển thị Dashboard Bác sĩ
     */
    public function index()
    {
        // 1. Lấy hồ sơ bác sĩ
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Tài khoản chưa liên kết hồ sơ bác sĩ.');
        }

        // 2. Lấy danh sách lịch hẹn
        // ĐỒNG BỘ VỚI ADMIN: Chỉ lấy 'confirmed' (Đã duyệt) và 'completed' (Đã xong)
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->whereIn('status', ['confirmed', 'completed']) 
            ->with('user')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc')
            ->paginate(10);

        return view('doctor.dashboard', compact('appointments'));
    }

    /**
     * Xử lý Hoàn thành ca khám
     */
    public function complete(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Bảo mật: Check quyền sở hữu
        if ($appointment->doctor_id != Auth::user()->doctor->id) {
            abort(403, 'Không có quyền truy cập.');
        }

        $request->validate([
            'diagnosis' => 'required|string|min:5'
        ], [
            'diagnosis.required' => 'Vui lòng nhập kết quả khám.',
            'diagnosis.min' => 'Kết quả khám quá ngắn.'
        ]);

        // Cập nhật trạng thái
        $appointment->diagnosis = $request->diagnosis;
        $appointment->status = 'completed'; // Chuyển sang đã xong
        $appointment->save();

        return redirect()->back()->with('success', 'Đã lưu kết quả khám thành công!');
    }
}