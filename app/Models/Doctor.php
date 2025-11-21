<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'specialty_id',
        'name',
        'avatar',
        'bio',
        'price',        // <-- Đã thêm dấu phẩy ở đây
        'treatments',   // Mới thêm
        'experience',   // Mới thêm
    ];

    // Quan hệ: Bác sĩ thuộc về 1 Bệnh viện
    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }

    // Quan hệ: Bác sĩ thuộc về 1 Chuyên khoa
    public function specialty() {
        return $this->belongsTo(Specialty::class);
    }

    // Quan hệ: Bác sĩ có nhiều lịch hẹn
    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}