<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\DonViTinh;
use Illuminate\Http\Request;

class DichVuController extends Controller
{
    public function index()
    {
        $dichVus = DichVu::with('donViTinh')->paginate(10);
        return view('admin.dich_vu.index', compact('dichVus'));
    }

    public function create()
    {
        $donViTinhs = DonViTinh::all();
        return view('admin.dich_vu.create', compact('donViTinhs'));
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
        return redirect()->route('dichvu.index')->with('success', 'Thêm dịch vụ thành công');
    }

    public function edit($id)
    {
        $dichvu = DichVu::find($id);
        $donViTinhs = DonViTinh::all();
        return view('admin.dich_vu.edit', compact('dichvu', 'donViTinhs'));
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
        return redirect()->route('dichvu.index')->with('success', 'Cập nhật dịch vụ thành công');
    }

    public function destroy($id)
    {
        $dichVu = DichVu::find($id);
        $dichVu->delete();
        return redirect()->route('dichvu.index')->with('success', 'Xóa dịch vụ thành công');
    }
}
