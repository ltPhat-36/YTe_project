<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        // Nếu không chọn type thì mặc định là 'Bệnh viện công' (hoặc để null tùy bạn)
        $currentType = $request->input('type', 'Bệnh viện công'); 

        // 1. Lấy danh sách các bệnh viện theo bộ lọc
        $hospitalsQuery = Hospital::query();

        if ($keyword) {
            $hospitalsQuery->where('name', 'like', "%{$keyword}%");
        }

        if ($currentType) {
            $hospitalsQuery->where('type', $currentType);
        }

        $hospitals = $hospitalsQuery->paginate(10); // Phân trang

        // 2. Tính số lượng cho từng Tab (Để hiển thị trên thanh menu ngang)
        // Danh sách các loại hình y tế bạn định nghĩa
        $types = [
            'Bệnh viện công', 
            'Bệnh viện tư', 
            'Phòng khám', 
            'Phòng mạch', 
            'Xét nghiệm', 
            'Y tế tại nhà', 
            'Tiêm chủng'
        ];

        $typeCounts = [];
        foreach ($types as $type) {
            // Đếm số lượng bệnh viện thuộc loại hình đó
            $typeCounts[$type] = Hospital::where('type', $type)->count();
        }

        return view('frontend.search', compact('hospitals', 'keyword', 'currentType', 'typeCounts'));
    }
}