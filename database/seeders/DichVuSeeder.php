<?php

namespace Database\Seeders;

use App\Models\DichVu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DichVuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $dichVus = [
          
            ['ten_dich_vu' => 'Tiền điện', 'don_vi' => 'kWh', 'don_gia' => 3500],
            ['ten_dich_vu' => 'Tiền nước', 'don_vi' => 'm³', 'don_gia' => 20000],
            ['ten_dich_vu' => 'Tiền vệ sinh', 'don_vi' => 'tháng', 'don_gia' => 50000],
            ['ten_dich_vu' => 'Tiền internet', 'don_vi' => 'tháng', 'don_gia' => 100000],
            ['ten_dich_vu' => 'Tiền phí quản lý', 'don_vi' => 'tháng', 'don_gia' => 30000],
            ['ten_dich_vu' => 'Tiền gửi xe', 'don_vi' => 'tháng', 'don_gia' => 100000],
            ['ten_dich_vu' => 'Tiền phí dịch vụ', 'don_vi' => 'tháng', 'don_gia' => 70000],
            ['ten_dich_vu' => 'Tiền phí giặt sấy', 'don_vi' => 'kg', 'don_gia' => 10000],
            
        ];

        foreach ($dichVus as $dichVu) {
            DichVu::updateOrCreate(
                ['ten_dich_vu' => $dichVu['ten_dich_vu']],
                $dichVu
            );
        }
    }
}
