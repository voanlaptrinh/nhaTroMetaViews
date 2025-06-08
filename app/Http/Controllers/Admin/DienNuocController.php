<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\DienNuocTheoPhong;
use App\Models\NhaTros;
use App\Models\Rooms;
use Illuminate\Http\Request;

class DienNuocController extends Controller
{
    public function index(Request $request)
    {
        $nhaTros = NhaTros::all();
        $selectedNhaTroId = $request->get('nha_tro_id');
        $thang = $request->get('thang');
        $nam = $request->get('nam');

        $dienNuocs = [];
        $canTao = false;
        $kieuTinhNuoc = 'cong_to'; // mặc định

        if ($selectedNhaTroId && $thang && $nam) {
            $dienNuocs = DienNuocTheoPhong::where('nha_tro_id', $selectedNhaTroId)
                ->where('thang', $thang)
                ->where('nam', $nam)
                ->get();

            $canTao = $dienNuocs->isEmpty();

            // Lấy dịch vụ nước của tòa nhà hiện tại
            $dichVuNuoc = DichVu::whereHas('nhaTros', function ($q) use ($selectedNhaTroId) {
                $q->where('nha_tro_id', $selectedNhaTroId);
            })->where('ma_dich_vu', 'nuoc')->first();

            $kieuTinhNuoc = $dichVuNuoc->kieu_tinh ?? 'cong_to';
        }

        return view('admin.diennuoc.index', compact(
            'nhaTros',
            'selectedNhaTroId',
            'thang',
            'nam',
            'dienNuocs',
            'canTao',
            'kieuTinhNuoc'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nha_tro_id' => 'required',
            'thang' => 'required|numeric',
            'nam' => 'required|numeric'
        ]);

        $rooms = Rooms::where('nha_tro_id', $request->nha_tro_id)->get();

        $dichVuNuoc = DichVu::where('ma_dich_vu', 'nuoc')->first();
        $kieuTinhNuoc = $dichVuNuoc->kieu_tinh ?? 'cong_to';

        foreach ($rooms as $room) {
            $soNuoc = 0;
            if ($kieuTinhNuoc === 'dau_nguoi') {
                $soNuoc = $room->so_khach ?? 1;
            } elseif ($kieuTinhNuoc === 'co_dinh') {
                $soNuoc = 1; // hoặc giá trị cố định khác
            }
            DienNuocTheoPhong::create([
                'nha_tro_id' => $request->nha_tro_id,
                'room_id' => $room->id,
                'thang' => $request->thang,
                'nam' => $request->nam,
                'chi_so_dien' => 0,
                'so_m3_nuoc' => 0,
                'so_nguoi' => $room->so_khach ?? 1,
            ]);
        }

        return redirect()->back()->with('success', 'Đã tạo dữ liệu điện nước cho tháng ' . $request->thang . '/' . $request->nam);
    }

    public function update(Request $request, $id)
    {
        // Lấy kiểu tính nước
        $dienNuoc = DienNuocTheoPhong::find($id);
        $dichVuNuoc = DichVu::where('ma_dich_vu', 'nuoc')->first();
        $kieuTinhNuoc = $dichVuNuoc->kieu_tinh ?? 'cong_to';
        // Validate dữ liệu đầu vào
        $request->validate([
            'chi_so_dien' => 'required|numeric|min:0',
            'so_nguoi'    => 'required|integer|min:0',
            // chỉ validate so_m3_nuoc nếu kiểu tính là cong_to
            'so_m3_nuoc'  => $kieuTinhNuoc === 'cong_to' ? 'required|numeric|min:0' : 'nullable',
        ]);

        // Tạo mảng dữ liệu cập nhật
        $data = [
            'chi_so_dien' => $request->chi_so_dien,
        ];

        // Xử lý theo kiểu tính nước
        if ($kieuTinhNuoc === 'cong_to') {
            $data['so_m3_nuoc'] = $request->so_m3_nuoc;
        } elseif ($kieuTinhNuoc === 'dau_nguoi') {
            $data['so_m3_nuoc'] = $request->so_m3_nuoc;
        } elseif ($kieuTinhNuoc === 'co_dinh') {
            $data['so_m3_nuoc'] = 1;
        }

        // Nếu bảng DienNuocTheoPhong có trường nha_tro_id bắt buộc, bạn cần đảm bảo giữ nguyên hoặc gán đúng:
        // Nếu update không đổi tòa nhà thì không cần gán lại.
        // Nếu cần, thêm dòng sau:
        // $data['nha_tro_id'] = $dienNuoc->nha_tro_id;

        // Cập nhật dữ liệu
        $dienNuoc->update($data);

        return back()->with('success', 'Cập nhật thành công.');
    }
}
