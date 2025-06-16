<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    use HasFactory;
     protected $fillable = [
        // Nhóm 1: Thông tin cơ bản
        'site_name',
        'site_slogan',
        'key',
        'language',
        'timezone',

        // Nhóm 2: Liên hệ
        'email',
        'hotline',
        'phone',
        'zalo_number',
        'address',
        'google_map_embed',

        // Nhóm 3: Mạng xã hội
        'facebook_url',
        'zalo_url',
        'youtube_url',
        'tiktok_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',

        // Nhóm 4: SEO
        'meta_title',
        'meta_keywords',
        'meta_description',

        // Nhóm 5: Script
        'script_header',
        'script_footer',
        'google_analytics_id',
        'facebook_pixel_id',
        'chat_widget_script',

        // Nhóm 6: Ảnh SEO và favicon
        'logo',
        'favicon_16',
        'favicon_32',
        'favicon_144',
        'favicon_192',
        'favicon_114',
        'favicon_120',
        'favicon_152',
        'favicon_180',
        'favicon_57',
        'favicon_60',
        'favicon_72',
        'favicon_76',
    ];
}
