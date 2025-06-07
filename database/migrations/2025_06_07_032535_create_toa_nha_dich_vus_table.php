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
                $table->foreignId('toa_nha_id')->constrained('nha_tros')->onDelete('cascade');
    $table->foreignId('dich_vu_id')->constrained('dich_vus')->onDelete('cascade');
            $table->timestamps();
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
