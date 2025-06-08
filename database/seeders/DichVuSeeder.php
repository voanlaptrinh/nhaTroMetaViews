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
            [
                'ma_don_vi' => 'm3',
                'ten_day_du' => 'Mét khối',
                'mo_ta' => 'Đơn vị đo thể tích, dùng cho nước',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_don_vi' => 'kWh',
                'ten_day_du' => 'Kilowatt giờ',
                'mo_ta' => 'Đơn vị đo điện năng tiêu thụ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_don_vi' => 'nguoi',
                'ten_day_du' => 'Người',
                'mo_ta' => 'Tính theo đầu người sử dụng dịch vụ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_don_vi' => 'goi',
                'ten_day_du' => 'Gói dịch vụ',
                'mo_ta' => 'Phí cố định theo gói/tháng',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('dich_vus')->insert([
            [
                'ten_dich_vu' => 'Nước sạch',
                'ma_dich_vu' => 'nuoc_sach',
                'don_vi_tinh_id' => 1, // m3
                'don_gia' => 15000,
                'mo_ta' => 'Tính theo công tơ nước',
                'kieu_tinh' => 'cong_to',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_dich_vu' => 'Điện sinh hoạt',
                'ma_dich_vu' => 'dien_sinh_hoat',
                'don_vi_tinh_id' => 2, // kWh
                'don_gia' => 3000,
                'mo_ta' => 'Tính theo công tơ điện',
                'kieu_tinh' => 'cong_to',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_dich_vu' => 'Nước giếng',
                'ma_dich_vu' => 'nuoc_gieng',
                'don_vi_tinh_id' => 3, // người
                'don_gia' => 20000,
                'mo_ta' => 'Tính theo đầu người',
                'kieu_tinh' => 'dau_nguoi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ten_dich_vu' => 'Phí quản lý',
                'ma_dich_vu' => 'phi_quan_ly',
                'don_vi_tinh_id' => 4, // gói
                'don_gia' => 100000,
                'mo_ta' => 'Phí cố định hàng tháng',
                'kieu_tinh' => 'co_dinh',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
