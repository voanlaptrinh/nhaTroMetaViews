<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhuongTien;
use App\Models\User;
use Illuminate\Http\Request;

class PhuongTienController extends Controller
{
    public function index(Request $request)
    {
        $query = PhuongTien::with('user');

        // Lọc theo user_id nếu có
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $phuongTiens = $query->latest()->paginate(20);
        $userId = $request->user_id;
        return view('admin.phuong_tien.index', compact('phuongTiens', 'userId'));
    }

    public function create(Request $request)
    {

        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'nguoi-thue-tro');
        })->get();

        $selectedUserId = $request->user_id; // Nếu tạo từ link có user_id

        return view('admin.phuong_tien.form', compact('users', 'selectedUserId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bien_so' => 'required|unique:phuong_tiens,bien_so',
            'loai_phuong_tien' => 'required',
            'ten_chu_xe' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        PhuongTien::create($request->all());

        return redirect()->route('admin.phuong-tien.index')->with('success', 'Thêm phương tiện thành công!');
    }

    public function edit(PhuongTien $phuongTien)
    {
        $users = User::all();
        return view('admin.phuong_tien.form', compact('phuongTien', 'users'));
    }

    public function update(Request $request, PhuongTien $phuongTien)
    {
        $request->validate([
            'name' => 'required',
            'bien_so' => 'required|unique:phuong_tiens,bien_so,' . $phuongTien->id,
            'loai_phuong_tien' => 'required',
            'ten_chu_xe' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $phuongTien->update($request->all());

        return redirect()->route('admin.phuong-tien.index')->with('success', 'Cập nhật phương tiện thành công!');
    }

    public function destroy(PhuongTien $phuongTien)
    {
        $phuongTien->delete();
        return redirect()->route('admin.phuong-tien.index')->with('success', 'Xóa phương tiện thành công!');
    }
}
