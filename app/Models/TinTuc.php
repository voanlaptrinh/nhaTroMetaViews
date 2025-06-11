<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
     protected $fillable = [
        'tieu_de',
        'slug',
        'mo_ta_ngan',
        'noi_dung',
        'hinh_anh',
        'tac_gia',
        'trang_thai',
    ];
}
