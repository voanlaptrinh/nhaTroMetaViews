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
        Schema::create('phuong_tiens', function (Blueprint $table) {
            $table->id();
             $table->string('name'); // Tên dòng xe
            $table->string('bien_so'); // Biển số xe
            $table->enum('loai_phuong_tien', [
                'o_to', 'o_to_dien', 'xe_may', 'xe_may_dien', 'xe_dap', 'xe_dap_dien'
            ]);
            $table->string('ten_chu_xe'); // Theo đăng ký xe
            $table->foreignId('khach_hang_id')->constrained('khach_hangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phuong_tiens');
    }
};
