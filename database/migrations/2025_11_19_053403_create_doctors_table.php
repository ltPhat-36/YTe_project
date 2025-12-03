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

            // QUAN TRỌNG: Đây là dòng tạo liên kết với bảng users
            // constrained() sẽ tự hiểu là nối với bảng 'users' nhờ vào tên cột 'user_id'
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('cascade');
            
            $table->string('name');
            $table->string('avatar')->nullable();
            
            // Các cột thông tin thêm
            $table->text('treatments')->nullable(); 
            $table->longText('experience')->nullable(); 
            $table->text('bio')->nullable(); 
            $table->integer('price')->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};