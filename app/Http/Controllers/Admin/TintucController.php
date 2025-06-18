<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
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
        LogHelper::ghi('Xem danh sách tin tức', 'Tin Tức', 'Xem danh sách tin tức trong quản trị viên');
        return view('admin.tin_tuc.index', compact('tinTucs'));
    }

    public function create()
    {
        LogHelper::ghi('Vào form tạo tin tức', 'Tin Tức', 'Vào form tạo tin tức trong quản trị viên');
        return view('admin.tin_tuc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta_ngan' => 'nullable|string',
            'noi_dung' => 'required',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'tieu_de.required' => 'Tiêu đề không được để trống.',
            'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'tieu_de.string' => 'Tiêu đề phải là một chuỗi ký tự.',

            'mo_ta_ngan.string' => 'Mô tả ngắn phải là một chuỗi ký tự.',

            'noi_dung.required' => 'Nội dung không được để trống.',

            'hinh_anh.image' => 'Tệp tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg hoặc gif.',

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
        LogHelper::ghi('Thêm tin tức mới', 'Tin Tức', 'Thêm tin tức mới trong quản trị viên');
        return redirect()->route('tin_tuc.index')->with('success', 'Thêm tin tức thành công.');
    }

    public function edit(TinTuc $tinTuc)
    {
        LogHelper::ghi('Vào form sửa tin tức', 'Tin Tức', 'Vào form sửa tin tức trong quản trị viên');
        return view('admin.tin_tuc.edit', compact('tinTuc'));
    }

    public function update(Request $request, TinTuc $tinTuc)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta_ngan' => 'nullable|string',
            'noi_dung' => 'required',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'tieu_de.required' => 'Tiêu đề không được để trống.',
            'tieu_de.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'tieu_de.max' => 'Tiêu đề không được vượt quá 255 ký tự.',

            'mo_ta_ngan.string' => 'Mô tả ngắn phải là chuỗi ký tự.',

            'noi_dung.required' => 'Nội dung không được để trống.',

            'hinh_anh.image' => 'Tệp tải lên phải là hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, gif.',
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
        LogHelper::ghi('Cập nhật tin tức với id ' . $tinTuc->id, 'Tin Tức', 'Cập nhật tin tức trong quản trị viên');
        return redirect()->route('tin_tuc.index')->with('success', 'Cập nhật tin tức thành công.');
    }

    public function destroy(TinTuc $tinTuc)
    {
        if ($tinTuc->hinh_anh && File::exists(public_path($tinTuc->hinh_anh))) {
            File::delete(public_path($tinTuc->hinh_anh));
        }

        $tinTuc->delete();
        LogHelper::ghi('Xóa tin tức với id ' . $tinTuc->id, 'Tin Tức', 'Xóa tin tức trong quản trị viên');
        return redirect()->route('tin_tuc.index')->with('success', 'Xóa tin tức thành công.');
    }
}
