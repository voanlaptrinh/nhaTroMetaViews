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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();                   // Tiêu đề chính (ví dụ: Về chúng tôi)
            $table->text('description')->nullable();               // Mô tả ngắn
            $table->longText('content')->nullable();               // Nội dung đầy đủ (HTML)
            $table->string('image')->nullable();                   // Ảnh chính (giới thiệu)
            $table->string('mission_title')->nullable();           // Tiêu đề sứ mệnh
            $table->text('mission')->nullable();                   // Nội dung sứ mệnh
            $table->string('vision_title')->nullable();            // Tiêu đề tầm nhìn
            $table->text('vision')->nullable();                    // Nội dung tầm nhìn
            $table->boolean('active')->default(true);              // Hiển thị/Ẩn
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
