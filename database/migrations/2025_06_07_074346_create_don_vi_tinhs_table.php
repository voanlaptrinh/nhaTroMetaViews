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
        Schema::create('don_vi_tinhs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_vi')->unique();        // Ví dụ: m3, kWh, người, Mbps
            $table->string('ten_day_du')->nullable();     // Ví dụ: Mét khối, Kilowatt giờ, Đầu người
            $table->string('mo_ta')->nullable();          // Mô tả chi tiết
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_vi_tinhs');
    }
};
