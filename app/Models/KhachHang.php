<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;
      protected $fillable = [
        'avatar',
        'cmt_mat_truoc',
        'cmt_mat_sau',
        'cmnd',
        'ho_chieu',
        'full_name',
        'phone',
        'email',
        'birthday',
        'gioi_tinh',
        'ngay_cap_cmnd',
        'noi_cap_cmnd',
        'thanh_pho',
        'huyen',
        'xa',
        'address',
        'stk',
        'ngan_hang',
        'nghe_nghiep',
        'noi_lam_viec',
        'ma_van_tay',
        'note',
    ];

    // Nếu bạn dùng kiểu date cho birthday/ngay_cap_cmnd
    protected $casts = [
        'birthday' => 'date',
        'ngay_cap_cmnd' => 'date',
    ];
}
