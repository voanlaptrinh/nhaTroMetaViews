<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiSanChungRieng extends Model
{
    use HasFactory;
    
    protected $fillable = ['nha_tro_id', 'room_id', 'tai_san_chung_id', 'tai_san_rieng_id'];

   public function nhaTro()
{
    return $this->belongsTo(NhaTros::class);
}

public function room()
{
    return $this->belongsTo(Rooms::class);
}

public function taiSanChungs()
{
    return $this->hasMany(TaiSanChung::class);
}

public function taiSanRiengs()
{
    return $this->hasMany(TaiSanRieng::class);
}

}
