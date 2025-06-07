<?php

namespace Database\Seeders;

use App\Models\DichVu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DichVuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        DB::table('don_vi_tinhs')->insert([
    ['ma_don_vi' => 'm3', 'ten_day_du' => 'Mét khối', 'mo_ta' => 'Dùng cho dịch vụ nước'],
    ['ma_don_vi' => 'kWh', 'ten_day_du' => 'Kilowatt giờ', 'mo_ta' => 'Dùng cho điện'],
    ['ma_don_vi' => 'người', 'ten_day_du' => 'Đầu người', 'mo_ta' => 'Tính phí theo số người'],
    ['ma_don_vi' => 'Mbps', 'ten_day_du' => 'Megabit / giây', 'mo_ta' => 'Dùng cho internet'],
    ['ma_don_vi' => 'VND', 'ten_day_du' => 'Việt Nam Đồng', 'mo_ta' => 'Tiền tệ'],
]);
    }
}
