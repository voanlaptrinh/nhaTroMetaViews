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
        Schema::create('nha_tros', function (Blueprint $table) {
            $table->id();
             $table->string('ten_toa_nha');
            $table->string('ma_toa_nha')->unique()->nullable(); // Mã định danh riêng
            $table->string('dia_chi')->nullable();
            $table->string('phuong')->nullable();
            $table->string('quan')->nullable();
            $table->string('thanh_pho')->nullable();
            $table->string('status');
            $table->string('quoc_gia')->default('Việt Nam');
            $table->integer('so_tang')->nullable(); // Tổng số tầng
            $table->integer('dien_tich')->nullable(); // m2
            $table->string('chu_so_huu')->nullable(); // Tên chủ sở hữu
            $table->text('mo_ta')->nullable(); // mô tả thêm
            $table->string('anh_dai_dien')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nha_tros');
    }
};
