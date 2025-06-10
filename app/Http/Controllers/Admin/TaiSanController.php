<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaiSan;
use Illuminate\Http\Request;

class TaiSanController extends Controller
{
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
        return view('admin.tai_sans.index', compact('taiSans'));
    }

    public function create()
    {
        return view('admin.tai_sans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_tai_san' => 'required|unique:tai_sans',
            'ten_tai_san' => 'required',
        ]);

        TaiSan::create($request->all());

        return redirect()->route('tai-sans.index')->with('success', 'Thêm tài sản thành công');
    }

    public function edit($id)
    {
        $taiSan = TaiSan::findOrFail($id);
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

        return redirect()->route('tai-sans.index')->with('success', 'Cập nhật tài sản thành công');
    }

    public function destroy($id)
    {
        TaiSan::findOrFail($id)->delete();
        return redirect()->route('tai-sans.index')->with('success', 'Xóa tài sản thành công');
    }
}
