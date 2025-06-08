<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'nha_tro_id',
        'ten_phong',
        'ma_phong',
        'dien_tich',
        'so_khach',
        'loai_phong',
        'gia_thue',
        'da_thue',
        'images',
        'ghi_chu',
        'status',
    ];



    public function tang()
    {
        return $this->belongsTo(Tangs::class);
    }

    // public function hopDongThue()
    // {
    //     return $this->hasMany(HopDongThue::class);
    // }
    protected $casts = [
        'da_thue' => 'boolean',
        'images' => 'array',
    ];
    public function congViecs()
    {
        return $this->hasMany(CongViec::class, 'phong_id');
    }
    public function nhaTro()
    {
        return $this->belongsTo(NhaTros::class);
    }
}
