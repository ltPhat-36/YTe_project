<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function show($id)
{
    // Eager loading 'images' để lấy luôn danh sách ảnh
    $hospital = Hospital::with('images')->findOrFail($id);
    
    return view('frontend.hospitals.show', compact('hospital'));
}
}