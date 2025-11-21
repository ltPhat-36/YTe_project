<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_appointments_table.php
public function up(): void
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Người đặt
        $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // Đặt bác sĩ nào
        $table->date('appointment_date'); // Ngày khám
        $table->time('appointment_time'); // Giờ khám
        $table->text('symptoms')->nullable(); // Triệu chứng bệnh
        
        // Trạng thái: pending (chờ duyệt), confirmed (đã duyệt), completed (đã khám), cancelled (hủy)
        $table->string('status')->default('pending'); 
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
