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
        Schema::create('tangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toa_nha_id')->constrained('nha_tros')->onDelete('cascade');
            $table->integer('so_tang'); // Tầng số mấy
            $table->string('ten_tang')->nullable(); // VD: Tầng Trệt, Tầng 1, Tầng Hầm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tangs');
    }
};
