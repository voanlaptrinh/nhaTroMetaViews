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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
               $table->string('name');            // Tên người dùng
    $table->string('position')->nullable();  // Chức vụ
    $table->string('image')->nullable();     // Đường dẫn ảnh
    $table->text('message');          // Nội dung cảm nghĩ
    $table->boolean('active')->default(true); // Hiển thị hay không
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
