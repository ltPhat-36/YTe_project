<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'description',
        'logo',
        'hotline'
    ];

    // Quan hệ: 1 Bệnh viện có nhiều Bác sĩ
    public function doctors() {
        return $this->hasMany(Doctor::class);
    }
}