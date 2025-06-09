<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiSan extends Model
{
    use HasFactory;
     protected $fillable = [
        'ma_tai_san',
        'ten_tai_san',
        'ngay_mua',
        'gia_tri',
        'tinh_trang',
        'ghi_chu'
    ];

    public function taiSanChung()
    {
        return $this->hasMany(TaiSanChung::class);
    }

    public function taiSanRieng()
    {
        return $this->hasMany(TaiSanRieng::class);
    }
}
