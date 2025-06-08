<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NhaTros;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomController extends Controller
{
     public function index()
    {
        $rooms = Rooms::with('nhaTro')->latest()->paginate(10);
        return view('admin.phong_tro.index', compact('rooms'));
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

$validated['images'] = $images;
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
$images = is_array($room->images) ? $room->images : json_decode($room->images, true) ?? [];

if ($request->hasFile('images')) {
    foreach ($request->file('images') as $img) {
        $fileName = time() . '_' . $img->getClientOriginalName();
        $img->move(public_path('rooms'), $fileName);
        $images[] = 'rooms/' . $fileName;
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
