<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NhaTros;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Rooms::query()->with('nhaTro');

        if ($request->filled('nha_tro_id')) {
            $query->where('nha_tro_id', $request->nha_tro_id);
        }

        if ($request->filled('ten_phong')) {
            $query->where('ten_phong', 'like', '%' . $request->ten_phong . '%');
        }

        if ($request->filled('loai_phong')) {
            $query->where('loai_phong', $request->loai_phong);
        }

        if ($request->filled('status')) {
            if ($request->status === 'da_thue') {
                $query->where('da_thue', true);
            } elseif ($request->status === 'trong') {
                $query->where('da_thue', false);
            }
        }

        $rooms = $query->paginate(10);

        // Lấy danh sách nhà trọ để đưa vào form select
        $nhaTros = NhaTros::all();

        return view('admin.phong_tro.index', compact('rooms', 'nhaTros'));
    }

    public function create()
    {
        $nhaTros = NhaTros::all();
        return view('admin.phong_tro.create', compact('nhaTros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nha_tro_id' => 'required|exists:nha_tros,id',
            'ten_phong' => 'required|string|max:255',
            'ma_phong' => 'nullable|string|max:255',
            'dien_tich' => 'nullable|integer|min:0',
            'so_khach' => 'nullable|integer|min:1',
            'loai_phong' => 'required|in:van_phong,can_ho,phong_cho_thue,khac',
            'gia_thue' => 'nullable|integer|min:0',
            'status' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'ghi_chu' => 'nullable|string',
        ], [
            'ten_phong.required' => 'Tên phòng không được để trống.',
            'nha_tro_id.required' => 'Vui lòng chọn nhà trọ.',
            'loai_phong.in' => 'Loại phòng không hợp lệ.',
            'images.*.image' => 'Ảnh không đúng định dạng.',
        ]);
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $fileName = time() . '_' . $img->getClientOriginalName();
                $img->move(public_path('rooms'), $fileName); // Lưu vào public/rooms
                $images[] = 'rooms/' . $fileName; // Lưu đường dẫn tương đối
            }
        }

        $validated['images'] =json_encode($images) ;
        Rooms::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Thêm phòng thành công.');
    }

    public function edit(Rooms $room)
    {
        $nhaTros = NhaTros::all();

        return view('admin.phong_tro.edit', compact('room', 'nhaTros'));
    }

    public function update(Request $request, Rooms $room)
    {
        $validated = $request->validate([
            'nha_tro_id' => 'required|exists:nha_tros,id',
            'ten_phong' => 'required|string|max:255',
            'ma_phong' => 'nullable|string|max:255',
            'dien_tich' => 'nullable|integer|min:0',
            'so_khach' => 'nullable|integer|min:1',
            'loai_phong' => 'required|in:van_phong,can_ho,phong_cho_thue,khac',
            'gia_thue' => 'nullable|integer|min:0',
            'status' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'ghi_chu' => 'nullable|string',
        ]);
       $images = $request->input('existing_images', []);
$images = is_array($images) ? $images : [];

if ($request->hasFile('images')) {
    foreach ($request->file('images') as $img) {
        if ($img->isValid()) {
            $fileName = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('rooms'), $fileName);
            $images[] = 'rooms/' . $fileName;
        }
    }
}


        $validated['images'] = json_encode($images); // nếu cột là TEXT hoặc JSON

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Cập nhật phòng thành công.');
    }

    public function destroy(Rooms $room)
    {
        $room->delete();
        return back()->with('success', 'Xóa phòng thành công.');
    }
    // App\Http\Controllers\RoomController.php
    public function getUsedRoomCodes($nha_tro_id)
    {
        $usedCodes = Rooms::where('nha_tro_id', $nha_tro_id)->pluck('ma_phong');
        return response()->json($usedCodes);
    }
}
