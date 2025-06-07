<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonViTinh extends Model
{
    use HasFactory;
    protected $fillable = [
        'ma_don_vi',
        'ten_day_du',
        'mo_ta',
    ];
}
