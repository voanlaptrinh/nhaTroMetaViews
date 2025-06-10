<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    use HasFactory;
      protected $fillable = [
        'ten_dich_vu',
        'ma_dich_vu',
        'don_vi_tinh_id',
        'mo_ta',
        
    ];

    /**
     * Quan hệ nhiều-nhiều với ToaNha
     */
    // public function toaNhas()
    // {
    //     return $this->belongsToMany(NhaTros::class, 'toa_nha_dich_vus')
    //         ->withTimestamps();
    // }
    public function donViTinh()
    {
        return $this->belongsTo(DonViTinh::class, 'don_vi_tinh_id');
    }
    public function nhaTros()
{
    return $this->belongsToMany(NhaTros::class, 'toa_nha_dich_vus', 'dich_vu_id', 'nha_tro_id')->withTimestamps();
}
}
