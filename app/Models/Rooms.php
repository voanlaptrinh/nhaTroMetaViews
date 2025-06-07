<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    
 protected $fillable = [
        'tang_id', 'ten_phong', 'ma_phong', 'dien_tich', 'loai_phong',
        'gia_thue', 'da_thue', 'ghi_chu', 'images'
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
        'gia_thue' => 'decimal:2',
    ];
public function congViecs()
{
    return $this->hasMany(CongViec::class, 'phong_id');
}

}
