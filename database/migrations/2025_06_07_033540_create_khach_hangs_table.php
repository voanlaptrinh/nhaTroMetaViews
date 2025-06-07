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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('cmt_mat_truoc')->nullable();
            $table->string('cmt_mat_sau')->nullable();
            $table->string('cmnd')->nullable();
            $table->string('ho_chieu')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gioi_tinh')->nullable();
            $table->string('ngay_cap_cmnd')->nullable();
            $table->string('noi_cap_cmnd')->nullable();
            $table->string('thanh_pho')->nullable();
            $table->string('huyen')->nullable(); //Quận huyện
            $table->string('xa')->nullable(); //Xã phường
            $table->string('address')->nullable(); //Địa chỉ đầy đủ
            $table->string('stk')->nullable(); //số tài khoản
            $table->string('ngan_hang')->nullable(); 
            $table->string('nghe_nghiep')->nullable(); 
            $table->string('noi_lam_viec')->nullable(); 
            $table->string('ma_van_tay')->nullable(); 
            $table->string('note')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
