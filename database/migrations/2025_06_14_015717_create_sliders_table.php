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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
             $table->string('title')->nullable();               // Tiêu đề slide (hiển thị hoặc SEO)
    $table->string('subtitle')->nullable();            // Phụ đề hoặc mô tả ngắn
    $table->string('image')->nullable();               // Ảnh slider (đường dẫn)
    $table->string('link')->nullable();                // Link chuyển đến khi click
    $table->boolean('active')->default(true);          // Có hiển thị không
    $table->integer('position')->default(0);           // Thứ tự hiển thị
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
