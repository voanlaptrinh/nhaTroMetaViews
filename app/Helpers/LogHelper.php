<?php
namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogHelper
{
    public static function ghi(string $hanhDong, string $doiTuong, string $moTa = null)
    {
        Log::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'hanh_dong' => $hanhDong,
            'doi_tuong' => $doiTuong,
            'mo_ta' => $moTa,
            'ip' => Request::ip(),
            'trinh_duyet' => Request::header('User-Agent'),
        ]);
    }
}
