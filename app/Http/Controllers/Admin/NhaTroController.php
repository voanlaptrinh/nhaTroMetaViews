<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\NhaTros;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class NhaTroController extends Controller
{
    public function index()
    {
        $nhaTros = NhaTros::with('dichVus')->latest()->get();
        return view('admin.nha_tro.index', compact('nhaTros'));
    }

    public function create()
    {
        $dichVus = DichVu::all();
        return view('admin.nha_tro.create', compact('dichVus'));
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'ten_toa_nha' => 'required|string|max:255',
            'ma_toa_nha' => 'nullable|string|max:255|unique:nha_tros,ma_toa_nha',
            'dia_chi' => 'nullable|string|max:255',
            'phuong' => 'nullable|string|max:255',
            'quan' => 'nullable|string|max:255',
            'thanh_pho' => 'nullable|string|max:255',
            'so_tang' => 'nullable|integer|min:0',
            'so_phong_tang' => 'nullable|integer|min:0',
            'dien_tich' => 'nullable|integer|min:0',
            'chu_so_huu' => 'nullable|string|max:255',
            'mo_ta' => 'nullable|string',
            'status' => 'required|in:Hoạt động,Ngưng hoạt động',
            'quoc_gia' => 'nullable|string|max:255',
            'dich_vu_ids' => 'nullable|array',
            'dich_vu_ids.*' => 'exists:dich_vus,id',
        ], $this->messages());

        $nhaTro = NhaTros::create([
            'ten_toa_nha' => $request->ten_toa_nha,
            'ma_toa_nha' => $request->ma_toa_nha,
            'dia_chi' => $request->dia_chi,
            'phuong' => $request->phuong,
            'quan' => $request->quan,
            'thanh_pho' => $request->thanh_pho,
            'status' => $request->status ?? 'Hoạt động',
            'quoc_gia' => $request->quoc_gia ?? 'Việt Nam',
            'so_tang' => $request->so_tang,
            'so_phong_tang' => $request->so_phong_tang,
            'dien_tich' => $request->dien_tich,
            'chu_so_huu' => $request->chu_so_huu,
            'mo_ta' => $request->mo_ta,
        ]);

        if ($request->has('dich_vu_ids')) {
            $nhaTro->dichVus()->attach($request->dich_vu_ids);
        }
        dd($request->dich_vu_ids);

        return redirect()->route('nha_tro.index')->with('success', 'Thêm nhà trọ thành công');
    }

    public function edit($id)
    {
        $nhaTro = NhaTros::with('dichVus')->findOrFail($id);
        $dichVus = DichVu::all();
        return view('admin.nha_tro.edit', compact('nhaTro', 'dichVus'));
    }

    public function update(Request $request, $id)
    {
        $nhaTro = NhaTros::findOrFail($id);

        $validatedData = $request->validate([
            'ten_toa_nha' => 'required|string|max:255',
            'ma_toa_nha' => [
                'nullable', 'string', 'max:255',
                Rule::unique('nha_tros', 'ma_toa_nha')->ignore($nhaTro->id),
            ],
            'dia_chi' => 'nullable|string|max:255',
            'phuong' => 'nullable|string|max:255',
            'quan' => 'nullable|string|max:255',
            'thanh_pho' => 'nullable|string|max:255',
            'so_tang' => 'nullable|integer|min:0',
            'so_phong_tang' => 'nullable|integer|min:0',
            'dien_tich' => 'nullable|integer|min:0',
            'chu_so_huu' => 'nullable|string|max:255',
            'mo_ta' => 'nullable|string',
            'status' => 'required|in:Hoạt động,Ngưng hoạt động',
            'quoc_gia' => 'nullable|string|max:255',
            'dich_vu_ids' => 'nullable|array',
            'dich_vu_ids.*' => 'exists:dich_vus,id',
        ], $this->messages());

        $nhaTro->update([
            'ten_toa_nha' => $request->ten_toa_nha,
            'ma_toa_nha' => $request->ma_toa_nha,
            'dia_chi' => $request->dia_chi,
            'phuong' => $request->phuong,
            'quan' => $request->quan,
            'thanh_pho' => $request->thanh_pho,
            'status' => $request->status ?? 'Hoạt động',
            'quoc_gia' => $request->quoc_gia ?? 'Việt Nam',
            'so_tang' => $request->so_tang,
            'so_phong_tang' => $request->so_phong_tang,
            'dien_tich' => $request->dien_tich,
            'chu_so_huu' => $request->chu_so_huu,
            'mo_ta' => $request->mo_ta,
        ]);

        $nhaTro->dichVus()->sync($request->dich_vu_ids ?? []);

        return redirect()->route('nha_tro.index')->with('success', 'Cập nhật nhà trọ thành công');
    }

    public function destroy($id)
    {
        $nhaTro = NhaTros::findOrFail($id);
        $nhaTro->delete();
        return redirect()->route('nha_tro.index')->with('success', 'Xóa nhà trọ thành công');
    }
     private function messages()
    {
        return [
            'ten_toa_nha.required' => 'Vui lòng nhập tên tòa nhà.',
            'ten_toa_nha.max' => 'Tên tòa nhà không được vượt quá 255 ký tự.',

            'ma_toa_nha.unique' => 'Mã tòa nhà đã tồn tại.',
            'ma_toa_nha.max' => 'Mã tòa nhà không được vượt quá 255 ký tự.',

            'so_tang.integer' => 'Số tầng phải là số.',
            'so_tang.min' => 'Số tầng không được nhỏ hơn 0.',
            'so_phong_tang.integer' => 'Số tầng phải là số.',
            'so_phong_tang.min' => 'Số tầng không được nhỏ hơn 0.',

            'dien_tich.integer' => 'Diện tích phải là số.',
            'dien_tich.min' => 'Diện tích không được nhỏ hơn 0.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',

            'dich_vu_ids.array' => 'Dịch vụ phải là danh sách hợp lệ.',
            'dich_vu_ids.*.exists' => 'Dịch vụ được chọn không tồn tại.',
        ];
    }
}
