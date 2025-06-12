<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\NhaTros;
use App\Models\Rooms;
use App\Models\TaiSan;
use App\Models\TaiSanChung;
use App\Models\TaiSanChungRieng;
use App\Models\TaiSanRieng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaiSanChungRiengController extends Controller
{
    public function index(Request $request)
{
    $query = TaiSanChungRieng::with(['nhaTro', 'room', 'taiSanChungs.taiSan', 'taiSanRiengs.taiSan']);

    if ($request->filled('ten_toa_nha')) {
        $query->whereHas('nhaTro', function ($q) use ($request) {
            $q->where('ten_toa_nha', 'like', '%' . $request->ten_toa_nha . '%');
        });
    }

    if ($request->filled('ma_phong')) {
        $query->whereHas('room', function ($q) use ($request) {
            $q->where('ma_phong', 'like', '%' . $request->ma_phong . '%');
        });
    }

    $list = $query->paginate(20);
    LogHelper::ghi('Xem danh sách tài sản chung riêng', 'Tài Sản Chung Riêng', 'Xem danh sách tài sản chung riêng trong quản trị viên');
    return view('admin.tai_san_chung_riengs.index', compact('list'));
}


    public function create()
    {
        $nhaTros = NhaTros::all();
          // Lấy ID các phòng đã được sử dụng trong bảng tài_sản_chung_riêng
    $usedRoomIds = TaiSanChungRieng::whereNotNull('room_id')->pluck('room_id')->toArray();

    // Ban đầu chưa chọn nhà trọ, nên lấy tất cả phòng chưa dùng
    $rooms = Rooms::whereNotIn('id', $usedRoomIds)->with('nhaTro')->get();

        $taiSans = TaiSan::all();
        LogHelper::ghi('Vào form tạo tài sản chung riêng', 'Tài Sản Chung Riêng', 'Vào form tạo tài sản chung riêng trong quản trị viên');
        return view('admin.tai_san_chung_riengs.create', compact('nhaTros', 'rooms', 'taiSans'));
    }

   public function store(Request $request)
{
    $request->validate([
        'nha_tro_id' => 'required|exists:nha_tros,id',
        'room_id' => 'nullable|exists:rooms,id',
        'tai_san_chung_ids' => 'nullable|array',
        'tai_san_chung_ids.*' => 'exists:tai_sans,id',
        'tai_san_rieng_ids' => 'nullable|array',
        'tai_san_rieng_ids.*' => 'exists:tai_sans,id',
    ]);

  
        // Tạo mới bản ghi tài sản chung riêng
        $tscr = TaiSanChungRieng::create([
            'nha_tro_id' => $request->nha_tro_id,
            'room_id' => $request->room_id
        ]);

        // Gán tài sản chung (nhiều tài sản)
        if ($request->filled('tai_san_chung_ids')) {
            foreach ($request->tai_san_chung_ids as $taiSanId) {
                TaiSanChung::create([
                    'tai_san_chung_rieng_id' => $tscr->id,
                    'tai_san_id' => $taiSanId,
                ]);
            }
        }

        // Gán tài sản riêng (nhiều tài sản)
        if ($request->filled('tai_san_rieng_ids')) {
            foreach ($request->tai_san_rieng_ids as $taiSanId) {
                TaiSanRieng::create([
                    'tai_san_chung_rieng_id' => $tscr->id,
                    'tai_san_id' => $taiSanId,
                ]);
            }
        }
        LogHelper::ghi('Thêm tài sản chung riêng mới', 'Tài Sản Chung Riêng', 'Thêm tài sản chung riêng mới trong quản trị viên');
      
        return redirect()->route('tai_san_chung_riengs.index')->with('success', 'Thêm mới thành công!');
   
}

    public function edit($id)
    {
        $taiSanChungRieng = TaiSanChungRieng::with(['taiSanChungs', 'taiSanRiengs'])->findOrFail($id);
        $nhaTros = NhaTros::all();
        $rooms = Rooms::with('nhaTro')->get();
        $taiSans = TaiSan::all();
        LogHelper::ghi('Vào form sửa tài sản chung riêng', 'Tài Sản Chung Riêng', 'Vào form sửa tài sản chung riêng trong quản trị viên');
        return view('admin.tai_san_chung_riengs.edit', compact('taiSanChungRieng', 'nhaTros', 'rooms', 'taiSans'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $tscr = TaiSanChungRieng::findOrFail($id);
            $tscr->update($request->only(['nha_tro_id', 'room_id']));

            // Xóa tài sản cũ
            TaiSanChung::where('tai_san_chung_rieng_id', $tscr->id)->delete();
            TaiSanRieng::where('tai_san_chung_rieng_id', $tscr->id)->delete();

            // Thêm lại
            foreach ($request->tai_san_chung_ids ?? [] as $taiSanId) {
                TaiSanChung::create([
                    'tai_san_chung_rieng_id' => $tscr->id,
                    'tai_san_id' => $taiSanId
                ]);
            }

            foreach ($request->tai_san_rieng_ids ?? [] as $taiSanId) {
                TaiSanRieng::create([
                    'tai_san_chung_rieng_id' => $tscr->id,
                    'tai_san_id' => $taiSanId
                ]);
            }

            DB::commit();
            LogHelper::ghi('Cập nhật tài sản chung riêng với id ' . $tscr->id, 'Tài Sản Chung Riêng', 'Cập nhật tài sản chung riêng trong quản trị viên');
            return redirect()->route('tai_san_chung_riengs.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $tscr = TaiSanChungRieng::findOrFail($id);
        $tscr->delete();
        LogHelper::ghi('Xóa tài sản chung riêng với id ' . $tscr->id, 'Tài Sản Chung Riêng', 'Xóa tài sản chung riêng trong quản trị viên');
        return redirect()->route('tai_san_chung_riengs.index')->with('success', 'Đã xóa thành công');
    }
}
