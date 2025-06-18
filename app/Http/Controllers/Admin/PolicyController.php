<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\Policie;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
     public function index()
    {
        $policies = Policie::latest()->get();
        return view('admin.policies.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.policies.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
    ]);

    // Mặc định là false nếu không được gửi lên
    $data = $request->only('title', 'content');
    $data['active'] = $request->has('active');

    Policie::create($data);
LogHelper::ghi('Đã thêm mới 1 chính sách ', 'Chính sách', 'Thêm mới chính sách trong quản trị viên');
    return redirect()->route('policies.index')->with('success', 'Thêm chính sách thành công');
}


    public function edit(Policie $policy)
    {
        return view('admin.policies.edit', compact('policy'));
    }

   public function update(Request $request, Policie $policy)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
    ]);

    $data = $request->only('title', 'content');
    $data['active'] = $request->has('active');

    $policy->update($data);
LogHelper::ghi('Đã sửa mới 1 chính sách ' . $policy->title, 'Chính sách', 'Sửa mới chính sách trong quản trị viên');

    return redirect()->route('policies.index')->with('success', 'Cập nhật chính sách thành công');
}


    public function destroy(Policie $policy)
    {
        $policy->delete();
LogHelper::ghi('Đã xóa mới 1 chính sách ' . $policy->title, 'Chính sách', 'Xóa chính sách trong quản trị viên');

        return redirect()->route('policies.index')->with('success', 'Xóa chính sách thành công');
    }
};
