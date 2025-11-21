<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên bệnh nhân
            $table->string('email')->unique();
            
            // --- THÊM DÒNG NÀY ĐỂ SỬA LỖI ---
            $table->timestamp('email_verified_at')->nullable(); 
            // --------------------------------

            $table->string('phone')->nullable(); // Số điện thoại
            $table->string('password');
            $table->string('role')->default('user'); // 'user', 'doctor', 'admin'
            $table->rememberToken();
            $table->timestamps();
        });

        // Tạo thêm bảng password_reset_tokens (mặc định của Laravel) để tránh lỗi khác
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tạo thêm bảng sessions (mặc định của Laravel)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};