<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    use HasFactory;
      protected $fillable = [
        'ten_dich_vu',
        'don_vi',
        'don_gia',
        'mo_ta',
    ];

    /**
     * Quan hệ nhiều-nhiều với ToaNha
     */
    public function toaNhas()
    {
        return $this->belongsToMany(NhaTros::class, 'toa_nha_dich_vus')
            ->withTimestamps();
    }
}
