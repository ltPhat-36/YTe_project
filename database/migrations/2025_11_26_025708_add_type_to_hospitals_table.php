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
        // Thêm cột type sau cột name
        $table->string('type')->nullable()->after('name')->comment('Loại hình: Cong, Tu, PhongKham...');
    });
}

public function down(): void
{
    Schema::table('hospitals', function (Blueprint $table) {
        $table->dropColumn('type');
    });
}
};
