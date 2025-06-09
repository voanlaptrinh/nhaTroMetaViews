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
        Schema::create('tai_sans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_tai_san')->unique(); // Mã tài sản
            $table->string('ten_tai_san'); // Tên tài sản
            $table->date('ngay_mua')->nullable(); // Ngày mua
            $table->integer('gia_tri')->default(0); // Giá trị tài sản
            $table->string('tinh_trang')->default('Đang sử dụng'); // Tình trạng: mới, đang sử dụng, hỏng, thanh lý
            $table->text('ghi_chu')->nullable(); // 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_sans');
    }
};
