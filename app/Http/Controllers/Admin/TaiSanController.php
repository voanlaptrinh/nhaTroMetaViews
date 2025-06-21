<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\TaiSan;
use Illuminate\Http\Request;

class TaiSanController extends Controller
{ public function __construct()
    {
        // Kiểm tra quyền của người dùng để tạo, sửa, xóa hợp đồng
        $this->middleware('can:Xem tài sản')->only(['index']);
        $this->middleware('can:Thêm tài sản')->only(['create', 'store']);
        $this->middleware('can:Sửa tài sản')->only(['edit', 'update']);
        $this->middleware('can:Xóa tài sản')->only(['destroy']);
    }
    public function index(Request $request)
    {
        
        $query = TaiSan::query();

        if ($request->filled('ten_tai_san')) {
            $query->where('ten_tai_san', 'like', '%' . $request->ten_tai_san . '%');
        }

        if ($request->filled('tinh_trang')) {
            $query->where('tinh_trang', $request->tinh_trang);
        }

        $taiSans = $query->paginate(10); // hoặc get() nếu không cần phân trang
        LogHelper::ghi('Xem danh sách tài sản', 'Tài Sản', 'Xem danh sách tài sản trong quản trị viên');
        return view('admin.tai_sans.index', compact('taiSans'));
    }

    public function create()
    {
        LogHelper::ghi('Vào form tạo tài sản', 'Tài Sản', 'Vào form tạo tài sản trong quản trị viên');
        return view('admin.tai_sans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_tai_san' => 'required|unique:tai_sans',
            'ten_tai_san' => 'required',
        ]);

        TaiSan::create($request->all());
        LogHelper::ghi('Thêm tài sản mới', 'Tài Sản', 'Thêm tài sản mới trong quản trị viên');
        return redirect()->route('tai-sans.index')->with('success', 'Thêm tài sản thành công');
    }

    public function edit($id)
    {
        $taiSan = TaiSan::findOrFail($id);
        LogHelper::ghi('Vào form sửa tài sản', 'Tài Sản', 'Vào form sửa tài sản trong quản trị viên');
        return view('admin.tai_sans.edit', compact('taiSan'));
    }

    public function update(Request $request, $id)
    {
        $taiSan = TaiSan::findOrFail($id);

        $request->validate([
            'ma_tai_san' => 'required|unique:tai_sans,ma_tai_san,' . $taiSan->id,
            'ten_tai_san' => 'required',
        ]);

        $taiSan->update($request->all());

        LogHelper::ghi('Cập nhật tài sản với id ' . $taiSan->id, 'Tài Sản', 'Cập nhật tài sản trong quản trị viên');
        return redirect()->route('tai-sans.index')->with('success', 'Cập nhật tài sản thành công');
    }

    public function destroy($id)
    {
        $taiSan = TaiSan::findOrFail($id);
        $taiSan->delete();
        LogHelper::ghi('Xóa tài sản với id ' . $taiSan->id, 'Tài Sản', 'Xóa tài sản trong quản trị viên');
        return redirect()->route('tai-sans.index')->with('success', 'Xóa tài sản thành công');
    }
}
