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
        Schema::create('web_configs', function (Blueprint $table) {
            $table->id();
            // Nhóm 1: Thông tin cơ bản
            $table->string('site_name')->nullable();
            $table->string('site_slogan')->nullable();
            $table->string('key')->nullable();
            $table->string('language')->default('vi');
            $table->string('timezone')->default('Asia/Ho_Chi_Minh');

            // Nhóm 2: Liên hệ
            $table->string('email')->nullable();
            $table->string('hotline')->nullable();
            $table->string('phone')->nullable();
            $table->string('zalo_number')->nullable();
            $table->string('address')->nullable();
            $table->text('google_map_embed')->nullable();

            // Nhóm 3: Mạng xã hội
            $table->string('facebook_url')->nullable();
            $table->string('zalo_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();

            // Nhóm 4: SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            // Nhóm 5: Script
            $table->text('script_header')->nullable();
            $table->text('script_footer')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->string('facebook_pixel_id')->nullable();
            $table->text('chat_widget_script')->nullable();

            // Nhóm 6: Ảnh seo
            $table->string('logo')->nullable();
            $table->string('favicon_16')->nullable();
            $table->string('favicon_32')->nullable();
            $table->string('favicon_144')->nullable();
            $table->string('favicon_192')->nullable();
            $table->string('favicon_114')->nullable();
            $table->string('favicon_120')->nullable();
            $table->string('favicon_152')->nullable();
            $table->string('favicon_180')->nullable();
            $table->string('favicon_57')->nullable();
            $table->string('favicon_60')->nullable();
            $table->string('favicon_72')->nullable();
            $table->string('favicon_76')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_configs');
    }
};
