<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class TintucController extends Controller
{
 public function index(Request $request)
{
    $query = TinTuc::query();

    if ($request->filled('tieu_de')) {
        $query->where('tieu_de', 'like', '%' . $request->tieu_de . '%');
    }

    if ($request->filled('tac_gia')) {
        $query->where('tac_gia', 'like', '%' . $request->tac_gia . '%');
    }

    if ($request->filled('trang_thai')) {
        $query->where('trang_thai', $request->trang_thai);
    }

    $tinTucs = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.tin_tuc.index', compact('tinTucs'));
}

    public function create()
    {
        return view('admin.tin_tuc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta_ngan' => 'nullable|string',
            'noi_dung' => 'required',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('tieu_de', 'mo_ta_ngan', 'noi_dung', 'tac_gia', 'trang_thai');
        $data['slug'] = Str::slug($request->tieu_de);

        if ($request->hasFile('hinh_anh')) {
            $image = $request->file('hinh_anh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/tin_tuc'), $imageName);
            $data['hinh_anh'] = 'uploads/tin_tuc/' . $imageName;
        }

        TinTuc::create($data);

        return redirect()->route('tin_tuc.index')->with('success', 'Thêm tin tức thành công.');
    }

    public function edit(TinTuc $tinTuc)
    {
        return view('admin.tin_tuc.edit', compact('tinTuc'));
    }

    public function update(Request $request, TinTuc $tinTuc)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta_ngan' => 'nullable|string',
            'noi_dung' => 'required',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('tieu_de', 'mo_ta_ngan', 'noi_dung', 'tac_gia', 'trang_thai');
        $data['slug'] = Str::slug($request->tieu_de);

        if ($request->hasFile('hinh_anh')) {
            if ($tinTuc->hinh_anh && File::exists(public_path($tinTuc->hinh_anh))) {
                File::delete(public_path($tinTuc->hinh_anh));
            }
            $image = $request->file('hinh_anh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/tin_tuc'), $imageName);
            $data['hinh_anh'] = 'uploads/tin_tuc/' . $imageName;
        }

        $tinTuc->update($data);

        return redirect()->route('tin_tuc.index')->with('success', 'Cập nhật tin tức thành công.');
    }

    public function destroy(TinTuc $tinTuc)
    {
        if ($tinTuc->hinh_anh && File::exists(public_path($tinTuc->hinh_anh))) {
            File::delete(public_path($tinTuc->hinh_anh));
        }

        $tinTuc->delete();

        return redirect()->route('tin_tuc.index')->with('success', 'Xóa tin tức thành công.');
    }
}
