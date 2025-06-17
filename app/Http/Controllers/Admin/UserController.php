<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
       $query = User::query()
        ->role('nguoi-thue-tro'); // chỉ lấy user có quyền này

    // Tìm kiếm theo tên
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Tìm kiếm theo email
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // Tìm kiếm theo trạng thái
    if ($request->filled('active')) {
        $query->where('active', $request->active); // active là true/false
    }

    $users = $query->paginate(20);

    return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string',
            'avatar' => 'nullable|image',
            'birthday' => 'nullable|date',
            'cmt_mat_truoc' => 'nullable|string',
            'cmt_mat_sau' => 'nullable|string',
            'cmnd' => 'nullable|string',
            'ho_chieu' => 'nullable|string',
            'gioi_tinh' => 'nullable|string',
            'ngay_cap_cmnd' => 'nullable|string',
            'noi_cap_cmnd' => 'nullable|string',
            'thanh_pho' => 'nullable|string',
            'huyen' => 'nullable|string',
            'xa' => 'nullable|string',
            'address' => 'nullable|string',
            'stk' => 'nullable|string',
            'ngan_hang' => 'nullable|string',
            'nghe_nghiep' => 'nullable|string',
            'noi_lam_viec' => 'nullable|string',
            'ma_van_tay' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $user = new User($validated);
        $user->password = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('avatars'), $filename);
            $user->avatar = 'avatars/' . $filename;
        }
        $user->assignRole('nguoi-thue-tro');
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string',
            'avatar' => 'nullable|image',
            'birthday' => 'nullable|date',
            'cmt_mat_truoc' => 'nullable|string',
            'cmt_mat_sau' => 'nullable|string',
            'cmnd' => 'nullable|string',
            'ho_chieu' => 'nullable|string',
            'gioi_tinh' => 'nullable|string',
            'ngay_cap_cmnd' => 'nullable|string',
            'noi_cap_cmnd' => 'nullable|string',
            'thanh_pho' => 'nullable|string',
            'huyen' => 'nullable|string',
            'xa' => 'nullable|string',
            'address' => 'nullable|string',
            'stk' => 'nullable|string',
            'ngan_hang' => 'nullable|string',
            'nghe_nghiep' => 'nullable|string',
            'noi_lam_viec' => 'nullable|string',
            'ma_van_tay' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $user->fill($validated);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('avatars'), $filename);
            $user->avatar = 'avatars/' . $filename;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
