<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function show($id)
    {
        // 1. Lấy thông tin bác sĩ hiện tại
        $doctor = Doctor::with(['hospital', 'specialty'])->findOrFail($id);

        // 2. Lấy danh sách "Bác sĩ cùng cơ sở y tế" (Trừ ông hiện tại ra)
        $relatedDoctors = Doctor::with(['hospital', 'specialty'])
                                ->where('hospital_id', $doctor->hospital_id)
                                ->where('id', '!=', $id)
                                ->take(4) // Lấy tối đa 4 người
                                ->get();

        return view('frontend.doctor.show', compact('doctor', 'relatedDoctors'));
    }
}