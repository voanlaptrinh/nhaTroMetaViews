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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Nếu có đăng nhập
        $table->string('hanh_dong');        // Ví dụ: "xem", "tạo", "xóa"
        $table->string('doi_tuong')->nullable(); // Ví dụ: "liên hệ", "tài sản"
        $table->text('mo_ta')->nullable();  // Diễn giải hành động
        $table->string('ip')->nullable();   // IP người dùng
          $table->string('trinh_duyet')->nullable(); // Tên trình duyệt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
