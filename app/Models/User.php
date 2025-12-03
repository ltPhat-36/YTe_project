<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        // --- THÊM MỚI ---
        'avatar',
        'address',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- QUAN TRỌNG: Định nghĩa quan hệ 1-1 với bảng Doctors ---
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}