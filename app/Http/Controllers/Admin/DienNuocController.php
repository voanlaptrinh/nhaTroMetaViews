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

        if ($selectedNhaTroId && $thang && $nam) {
            $dienNuocs = DienNuocTheoPhong::where('nha_tro_id', $selectedNhaTroId)
                ->where('thang', $thang)
                ->where('nam', $nam)
                ->get();

            $canTao = $dienNuocs->isEmpty();
        }
     $dichVuNuoc = DichVu::where('ma_dich_vu', 'nuoc')->first();
        $kieuTinhNuoc = $dichVuNuoc->kieu_tinh ?? 'cong_to';
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

    public function update(Request $request, DienNuocTheoPhong $dienNuoc)
    {
        $dichVuNuoc = DichVu::where('ma_dich_vu', 'nuoc')->first();
        $kieuTinhNuoc = $dichVuNuoc->kieu_tinh ?? 'cong_to';

        $data = [
            'so_dien'  => $request->input('so_dien'),
            'so_nguoi' => $request->input('so_nguoi'),
        ];

        if ($kieuTinhNuoc === 'cong_to') {
            $data['so_nuoc'] = $request->input('so_nuoc');
        } elseif ($kieuTinhNuoc === 'dau_nguoi') {
            $data['so_nuoc'] = $request->input('so_nguoi'); // tính theo số người
        } elseif ($kieuTinhNuoc === 'co_dinh') {
            $data['so_nuoc'] = 1;
        }

        $dienNuoc->update($data);

        return back()->with('success', 'Cập nhật thành công.');
    }
}
