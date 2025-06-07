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
        Schema::create('cong_viecs', function (Blueprint $table) {
            $table->id();
             $table->foreignId('toa_nha_id')->constrained('nha_tros')->onDelete('cascade');
            $table->foreignId('phong_id')->constrained('rooms')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('muc_do', ['thap', 'trung_binh', 'cao', 'khac'])->default('khac'); // Mức độ ưu tiên
            $table->date('end_date'); // Hạn hoàn thành
            $table->foreignId('user_thuc_hien')->constrained('users')->onDelete('cascade');
            $table->json('images')->nullable(); // Ảnh đính kèm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cong_viecs');
    }
};
