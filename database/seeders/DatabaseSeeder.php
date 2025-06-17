<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AboutUs;
use App\Models\WebConfig;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(DichVuSeeder::class);
         $this->call(TaiSanSeeder::class);
         $this->call(PermissionSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         WebConfig::create([
            // Thông tin cơ bản
            'site_name' => 'Nhà trọ metaa',
            'site_slogan' => 'Nơi an cư lý tưởng cho sinh viên và người đi làm',
            'key' => 'nhatro-metaa',
            'language' => 'vi',
            'timezone' => 'Asia/Ho_Chi_Minh',

            // Liên hệ
            'email' => 'lienhe@nhatro.com',
            'hotline' => '0909 000 111',
            'phone' => '028 1234 5678',
            'zalo_number' => '0909000111',
            'address' => '123 Đường Trọ, Quận 9, TP. Hồ Chí Minh',
            'google_map_embed' => '<iframe src="https://maps.google.com/..."></iframe>',

            // Mạng xã hội
            'facebook_url' => 'https://facebook.com/nhatro.metaa',
            'zalo_url' => 'https://zalo.me/0909000111',
            'youtube_url' => 'https://youtube.com/@nhatro.metaa',
            'tiktok_url' => 'https://tiktok.com/@nhatro.metaa',
            'instagram_url' => 'https://instagram.com/nhatro.metaa',
            'linkedin_url' => null,
            'twitter_url' => null,

            // SEO
            'meta_title' => 'Nhà trọ metaa - Giải pháp nhà trọ toàn diện',
            'meta_keywords' => 'nhà trọ, phòng trọ giá rẻ, phòng trọ sinh viên',
            'meta_description' => 'Hệ thống nhà trọ uy tín, sạch đẹp, an ninh cho sinh viên và người đi làm.',

            // Scripts
            'script_header' => null,
            'script_footer' => null,
            'google_analytics_id' => 'G-XXXXXXXXXX',
            'facebook_pixel_id' => '1234567890',
            'chat_widget_script' => '<script>/* chat widget code */</script>',

            // Favicon & logo
            'logo' => '',
            'favicon_16' => '',
            'favicon_32' => '',
            'favicon_144' => '',
            'favicon_192' => '',
            'favicon_114' => '',
            'favicon_120' => '',
            'favicon_152' => '',
            'favicon_180' => '',
            'favicon_57' => '',
            'favicon_60' => '',
            'favicon_72' => '',
            'favicon_76' => '',
        ]);
        
        AboutUs::create([
            'title' => 'Về chúng tôi',
            'description' => 'Chúng tôi là công ty hàng đầu trong lĩnh vực...',
            'content' => '<p>Chào mừng đến với công ty chúng tôi...</p>',
            'image' => '',
            'mission_title' => 'Sứ mệnh của chúng tôi',
            'mission' => 'Mang đến giá trị bền vững cho khách hàng.',
            'vision_title' => 'Tầm nhìn',
            'vision' => 'Trở thành doanh nghiệp hàng đầu khu vực.',
            'active' => true,
        ]);
    }
}
