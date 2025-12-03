<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      // <--- QUAN TRỌNG: Cho phép lưu ID tài khoản
        'hospital_id',
        'specialty_id',
        'name',
        'avatar',
        'bio',
        'price',
        'treatments',
        'experience',
    ];

    // --- Quan hệ ngược lại: Bác sĩ thuộc về 1 User ---
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }

    public function specialty() {
        return $this->belongsTo(Specialty::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}