<?php

namespace App\Http\Controllers\Frontend; // Namespace chuẩn theo thư mục

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Specialty;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu từ Database
        $hospitals = Hospital::all();
        $specialties = Specialty::all();
        // Lấy 4 bác sĩ mới nhất để hiển thị demo
        $doctors = Doctor::with(['hospital', 'specialty'])->latest()->take(4)->get();

        return view('welcome', compact('hospitals', 'specialties', 'doctors'));
    }
}