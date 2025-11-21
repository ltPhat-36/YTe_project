<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    // Quan hệ: 1 Chuyên khoa có nhiều Bác sĩ
    public function doctors() {
        return $this->hasMany(Doctor::class);
    }
}