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
        Schema::create('toa_nha_dich_vus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nha_tro_id');
            $table->unsignedBigInteger('dich_vu_id');
            $table->timestamps();
            $table->foreign('nha_tro_id')->references('id')->on('nha_tros')->onDelete('cascade');
            $table->foreign('dich_vu_id')->references('id')->on('dich_vus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toa_nha_dich_vus');
    }
};
