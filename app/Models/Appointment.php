<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'symptoms',
        'status'
    ];

    // Quan hệ: Lịch hẹn thuộc về 1 User (Bệnh nhân)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Lịch hẹn thuộc về 1 Bác sĩ
    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}