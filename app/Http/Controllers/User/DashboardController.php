<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Hiển thị danh sách lịch sử khám bệnh
     */
    public function index()
    {
        // 1. Lấy ID người dùng đang đăng nhập
        $userId = Auth::id();

        // 2. Truy vấn bảng appointments
        // - where('user_id', $userId): Chỉ lấy lịch của người này
        // - with('doctor'): Load thông tin bác sĩ (để hiện tên, ảnh)
        // - orderBy('created_at', 'desc'): Mới nhất lên đầu
        $appointments = Appointment::where('user_id', $userId)
            ->with('doctor') 
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Trả về view dashboard kèm biến $appointments
        return view('dashboard', compact('appointments'));
    }

    /**
     * Xử lý hủy lịch hẹn
     */
    public function cancel($id)
    {
        // 1. Tìm lịch hẹn theo ID và đảm bảo nó thuộc về user đang đăng nhập
        // (Tránh trường hợp user này hủy lịch của user kia)
        $appointment = Appointment::where('user_id', Auth::id())->findOrFail($id);

        // 2. Kiểm tra trạng thái
        // Chỉ cho phép hủy khi trạng thái là 'pending' (Chờ xác nhận)
        if ($appointment->status == 'pending') {
            
            // Cập nhật trạng thái sang 'cancelled'
            $appointment->status = 'cancelled';
            $appointment->save();

            // Thông báo thành công
            return redirect()->back()->with('success', 'Đã hủy lịch hẹn thành công!');
        }

        // Nếu trạng thái không phải pending (ví dụ đã khám xong), báo lỗi
        return redirect()->back()->with('error', 'Không thể hủy lịch đã hoàn thành hoặc đã hủy.');
    }
}