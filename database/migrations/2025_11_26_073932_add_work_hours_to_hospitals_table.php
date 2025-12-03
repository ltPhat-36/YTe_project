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
    Schema::table('hospitals', function (Blueprint $table) {
        // Thêm cột work_hours kiểu text, cho phép null
        $table->text('work_hours')->nullable()->after('address'); 
    });
}

public function down(): void
{
    Schema::table('hospitals', function (Blueprint $table) {
        $table->dropColumn('work_hours');
    });
}
};
