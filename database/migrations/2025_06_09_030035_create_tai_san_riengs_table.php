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
        Schema::create('tai_san_riengs', function (Blueprint $table) {
            $table->id();
         $table->foreignId('tai_san_chung_rieng_id')->constrained('tai_san_chung_riengs')->onDelete('cascade');
    $table->foreignId('tai_san_id')->constrained('tai_sans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_san_riengs');
    }
};
