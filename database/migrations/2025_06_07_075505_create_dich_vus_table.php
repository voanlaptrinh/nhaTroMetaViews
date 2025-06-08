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
        Schema::create('dich_vus', function (Blueprint $table) {
            $table->id();
            $table->string('ten_dich_vu');
            $table->string('ma_dich_vu')->unique();
            $table->unsignedBigInteger('don_vi_tinh_id')->nullable();
            $table->foreign('don_vi_tinh_id')->references('id')->on('don_vi_tinhs')->onDelete('set null');
            $table->enum('kieu_tinh', ['cong_to', 'dau_nguoi', 'co_dinh'])->default('cong_to'); //cong_to	Tính theo số đo công tơ (số điện, số nước, MB Internet...)
            //dau_nguoi	Tính theo số người trong phòng
            //co_dinh	Mức giá cố định hàng tháng (VD: phí quản lý, rác...)
            $table->integer('don_gia')->default(0); // Giá cơ bản mặc định
            $table->text('mo_ta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dich_vus');
    }
};
