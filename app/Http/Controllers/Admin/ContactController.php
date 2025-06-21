<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\LienHe;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        // Kiểm tra quyền của người dùng để tạo, sửa, xóa hợp đồng
        $this->middleware('can:Xem liên hệ')->only(['index']);
      
    }
    public function index(Request $request)
    {
        $query = LienHe::query();

        if ($request->filled('ten')) {
            $query->where('ten', 'like', '%' . $request->ten . '%');
        }

        if ($request->filled('ngay_tao')) {
            $query->whereDate('created_at', $request->ngay_tao);
        }
        LogHelper::ghi('Xem danh sách liên hệ', 'Liên Hệ', 'Xem danh sách liên hệ trong quản trị viên');
        $dsLienHe = $query->latest()->paginate(10);

        return view('admin.lien_he.index', compact('dsLienHe'));
    }
}
