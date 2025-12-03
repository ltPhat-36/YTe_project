<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalImage extends Model
{
    use HasFactory;

    /**
     * Tên bảng trong database (tùy chọn, Laravel tự hiểu nhưng khai báo cho rõ)
     */
    protected $table = 'hospital_images';

    /**
     * Các trường được phép thêm dữ liệu (Mass Assignment)
     * Bắt buộc phải có để lệnh HospitalImage::create() hoạt động
     */
    protected $fillable = [
        'hospital_id',
        'image_path',
    ];

    /**
     * Định nghĩa quan hệ: Một hình ảnh thuộc về một bệnh viện
     * (Inverse of hasMany)
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}