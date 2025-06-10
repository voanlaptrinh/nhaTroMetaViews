<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToaNhaDichVu extends Model
{
    use HasFactory;
     protected $fillable = [
        'toa_nha_id',
        'dich_vu_id',
        'don_gia',
        'kieu_tinh'
    ];

    public function toaNha()
    {
        return $this->belongsTo(NhaTros::class);
    }

    public function dichVu()
    {
        return $this->belongsTo(DichVu::class);
    }
}
