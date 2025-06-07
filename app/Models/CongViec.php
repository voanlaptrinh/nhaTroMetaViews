<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongViec extends Model
{
    use HasFactory;
     protected $fillable = [
        'toa_nha_id',
        'phong_id',
        'title',
        'description',
        'muc_do',
        'end_date',
        'user_thuc_hien',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'end_date' => 'date',
    ];

    public function toaNha()
    {
        return $this->belongsTo(NhaTros::class);
    }

    public function phong()
    {
        return $this->belongsTo(Rooms::class);
    }

    public function nhanVien()
    {
        return $this->belongsTo(User::class, 'user_thuc_hien');
    }
}
