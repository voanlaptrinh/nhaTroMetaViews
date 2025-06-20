<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\DonViTinh;
use Illuminate\Http\Request;

class DichVuController extends Controller
{
     public function __construct()
    {
        // Kiểm tra quyền của người dùng để tạo, sửa, xóa hợp đồng
        $this->middleware('can:Xem dịch vụ')->only(['index']);
        $this->middleware('can:Thêm dịch vụ')->only(['create', 'store']);
        $this->middleware('can:Sửa dịch vụ')->only(['edit', 'update']);
        $this->middleware('can:Xóa dịch vụ')->only(['destroy']);
    }
    public function index()
    {
        $dichVus = DichVu::with('donViTinh')->paginate(10);
        LogHelper::ghi('Xem danh sách dịch vụ', 'Dịch Vụ', 'Xem danh sách dịch vụ trong quản trị viên');

        return view('admin.dich_vu.index', compact('dichVus'));
    }

    public function create()
    {
        $donViTinhs = DonViTinh::all();
        LogHelper::ghi('Vào form tạo dịch vụ', 'Dịch Vụ', 'Vào form tạo dịch vụ trong quản trị viên');
        $maDichVuDaTonTai = DichVu::pluck('ma_dich_vu')->toArray();
        return view('admin.dich_vu.create', compact('donViTinhs', 'maDichVuDaTonTai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_dich_vu' => 'required|string|max:255',
            'ma_dich_vu' => 'required|unique:dich_vus,ma_dich_vu',
            'don_vi_tinh_id' => 'nullable|exists:don_vi_tinhs,id',

        ], [
            'ten_dich_vu.required' => 'Vui lòng nhập tên dịch vụ.',
            'ten_dich_vu.string' => 'Tên dịch vụ phải là chuỗi ký tự.',
            'ten_dich_vu.max' => 'Tên dịch vụ không được vượt quá 255 ký tự.',

            'ma_dich_vu.required' => 'Vui lòng nhập mã dịch vụ.',
            'ma_dich_vu.unique' => 'Mã dịch vụ đã tồn tại, vui lòng chọn mã khác.',

            'don_vi_tinh_id.exists' => 'Đơn vị tính không hợp lệ.',


        ]);


        DichVu::create($request->all());
        LogHelper::ghi('Thêm dịch vụ mới', 'Dịch Vụ', 'Thêm dịch vụ mới trong quản trị viên');
        return redirect()->route('dichvu.index')->with('success', 'Thêm dịch vụ thành công');
    }

    public function edit($id)
    {
        $dichvu = DichVu::find($id);
        $donViTinhs = DonViTinh::all();
        $maDichVuDaTonTai = DichVu::where('id', '!=', $dichvu->id)->pluck('ma_dich_vu')->toArray();
        LogHelper::ghi('Vào form sửa dịch vụ', 'Dịch Vụ', 'Vào form sửa dịch vụ trong quản trị viên');
        return view('admin.dich_vu.edit', compact('dichvu', 'donViTinhs', 'maDichVuDaTonTai'));
    }

    public function update(Request $request, $id)
    {
        $dichVu = DichVu::find($id);
        $request->validate([
            'ten_dich_vu' => 'required|string|max:255',
            'ma_dich_vu' => 'required|unique:dich_vus,ma_dich_vu,' . $dichVu->id,
            'don_vi_tinh_id' => 'nullable|exists:don_vi_tinhs,id',

        ], [
            'ten_dich_vu.required' => 'Vui lòng nhập tên dịch vụ.',
            'ten_dich_vu.string' => 'Tên dịch vụ phải là chuỗi ký tự.',
            'ten_dich_vu.max' => 'Tên dịch vụ không được vượt quá 255 ký tự.',
            'ma_dich_vu.required' => 'Vui lòng nhập mã dịch vụ.',
            'ma_dich_vu.unique' => 'Mã dịch vụ đã tồn tại, vui lòng chọn mã khác.',
            'don_vi_tinh_id.exists' => 'Đơn vị tính không hợp lệ.',

        ]);


        $dichVu->update($request->all());
        LogHelper::ghi('Cập nhật dịch vụ với Id là ' . $dichVu->id, 'Dịch Vụ', 'Cập nhật dịch vụ trong quản trị viên');
        return redirect()->route('dichvu.index')->with('success', 'Cập nhật dịch vụ thành công');
    }

    public function destroy($id)
    {
        $dichVu = DichVu::find($id);
        $maKhongChoXoa = ['dien_sinh_hoat', 'nuoc', 'mang'];

        if (in_array($dichVu->ma_dich_vu, $maKhongChoXoa)) {
            return redirect()->route('dichvu.index')
                ->with('error', 'Không thể xóa dịch vụ quan trọng: ' . $dichVu->ma_dich_vu);
        }
        $dichVu->delete();
        LogHelper::ghi('Xóa dịch vụ với Id là ' . $dichVu->id, 'Dịch Vụ', 'Xóa dịch vụ trong quản trị viên');
        return redirect()->route('dichvu.index')->with('success', 'Xóa dịch vụ thành công');
    }
}
