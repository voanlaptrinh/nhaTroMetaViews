<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiSanRieng extends Model
{
    use HasFactory;
        protected $fillable = ['tai_san_chung_rieng_id', 'tai_san_id'];

   public function taiSanChungRieng()
{
    return $this->belongsTo(TaiSanChungRieng::class);
}

public function taiSan()
{
    return $this->belongsTo(TaiSan::class);
}

}
