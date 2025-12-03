<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'address',
        'hotline',
        'logo',
        'description',
        'work_hours', // <--- Thêm dòng này
    ];
    // Quan hệ: 1 Bệnh viện có nhiều Bác sĩ
    public function doctors() {
        return $this->hasMany(Doctor::class);
    }
    // Thêm hàm này vào model Hospital
public function images()
{
    return $this->hasMany(HospitalImage::class);
}
}