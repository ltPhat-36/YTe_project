<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\HospitalImage; // Import Model ảnh
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function create()
    {
        return view('admin.hospitals.create');
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu (Thêm validate cho gallery)
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'address' => 'required|string',
            'hotline' => 'required|string',
            'logo' => 'required|image|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Kiểm tra từng ảnh trong mảng gallery
        ]);

        // 2. Xử lý Logo (Ảnh đại diện chính)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Lưu vào disk 'public' để hiển thị được
            $file->storeAs('hospitals', $filename, 'public'); 
            
            $logoPath = 'hospitals/' . $filename;
        }

        // 3. Tạo Bệnh viện và GÁN VÀO BIẾN $hospital để lấy ID
        $hospital = Hospital::create([
            'name' => $request->name,
            'type' => $request->type,
            'address' => $request->address,
            'hotline' => $request->hotline,
            'logo' => $logoPath,
            'description' => $request->description,
            'work_hours' => $request->work_hours,
        ]);

        // 4. Xử lý Upload Gallery (Nhiều ảnh Slide) - MỚI THÊM
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                // Tạo tên file unique để không bị trùng
                $galleryName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Lưu ảnh vào thư mục 'hospitals/gallery' trên disk 'public'
                $image->storeAs('hospitals/gallery', $galleryName, 'public');

                // Lưu đường dẫn vào bảng phụ hospital_images
                HospitalImage::create([
                    'hospital_id' => $hospital->id, // Lấy ID của bệnh viện vừa tạo ở trên
                    'image_path' => 'hospitals/gallery/' . $galleryName
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Thêm cơ sở y tế và ảnh chi tiết thành công!');
    }
}