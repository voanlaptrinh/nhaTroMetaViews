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
        Schema::create('tin_tucs', function (Blueprint $table) {
            $table->id();
              $table->string('tieu_de');
    $table->string('slug')->unique();
    $table->text('mo_ta_ngan')->nullable();
    $table->longText('noi_dung');
    $table->string('hinh_anh')->nullable(); // Đường dẫn ảnh đại diện
    $table->string('tac_gia')->nullable(); // Admin nào viết
    $table->enum('trang_thai', ['nhap', 'hien_thi'])->default('hien_thi'); // Trạng thái hiển thị
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_tucs');
    }
};
