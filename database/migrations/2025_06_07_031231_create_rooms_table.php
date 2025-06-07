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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tang_id')->constrained('tangs')->onDelete('cascade');
            $table->string('ten_phong');
            $table->string('ma_phong')->unique();
            $table->integer('dien_tich')->nullable();
            $table->integer('so_khach_toi_da')->nullable();
            $table->enum('loai_phong', ['van_phong', 'can_ho', 'phong_cho_thue', 'khac'])->default('khac');
            $table->decimal('gia_thue', 15, 2)->nullable(); // VND
            $table->boolean('da_thue')->default(false);
            $table->json('images')->nullable();//Ảnh demo phòng trọ
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
