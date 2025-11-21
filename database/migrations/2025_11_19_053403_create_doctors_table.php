<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('cascade');
            $table->string('name');
            $table->string('avatar')->nullable();
            
            // --- CÁC CỘT MỚI ĐỂ GIỐNG ẢNH ---
            $table->text('treatments')->nullable(); // Chuyên trị (ví dụ: Phẫu thuật nội soi...)
            $table->longText('experience')->nullable(); // Kinh nghiệm (lưu dạng HTML list)
            // --------------------------------

            $table->text('bio')->nullable(); // Giới thiệu
            $table->integer('price')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};