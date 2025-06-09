<?php

namespace Database\Seeders;

use App\Models\TaiSan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaiSanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $tinhTrangOptions = ['Mới', 'Đang sử dụng', 'Hỏng', 'Thanh lý'];

        $danhSachTaiSan = [
            ['Tivi Samsung 43 inch', 6500000],
            ['Máy lạnh LG Inverter 1.5HP', 7500000],
            ['Tủ lạnh Toshiba 2 cánh', 5200000],
            ['Giường gỗ 1m6x2m', 2800000],
            ['Nệm cao su 1m6x2m', 1800000],
            ['Bàn học sinh gỗ ép', 700000],
            ['Ghế nhựa có lưng tựa', 150000],
            ['Máy giặt Electrolux 8kg', 6900000],
            ['Bếp gas đơn', 300000],
            ['Kệ sách 5 tầng', 850000],
        ];

        foreach ($danhSachTaiSan as $index => [$ten, $giaTri]) {
            TaiSan::create([
                'ma_tai_san'   => 'TS' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'ten_tai_san'  => $ten,
                'ngay_mua'     => now()->subDays(rand(30, 365)),
                'gia_tri'      => $giaTri,
                'tinh_trang'   => $tinhTrangOptions[array_rand($tinhTrangOptions)],
                'ghi_chu'      => fake()->optional()->sentence(),
            ]);
        }
    }
}
