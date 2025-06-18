<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesControler extends Controller
{
     public function index()
    {
        // Get all roles with their permissions
        $roles = Role::with('permissions')->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    // Show the form to create a new role
    public function create()
    {
        // Get all permissions
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    // Store a newly created role
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array', // Kiểm tra nếu có ít nhất 1 quyền
        ]);

        // Tạo vai trò mới
        $role = Role::create(['name' => $request->name]);

        // Gán quyền cho vai trò, dùng tên quyền thay vì ID
        $permissions = Permission::whereIn('name', $request->permissions)->get();
        $role->givePermissionTo($permissions);
         LogHelper::ghi( Auth::user()->name . 'Đã tạo vai trò mới ' . $role->name, 'Vai trò', Auth::user()->name . 'Đã tạo vai trò mới ' . $role->name . 'trong quản trị viên');
        
        return redirect()->route('admin.roles.index')->with('success', 'Tạo vai trò và gán quyền thành công.');
    }

    
    // Show the form for editing the specified role
    public function edit(Role $role)
    {
        // Get all permissions
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // Update the specified role in storage
    public function update(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::whereIn('id', $request->permissions)->get();

        // Gán quyền cho vai trò
        $role->syncPermissions($permissions);
               LogHelper::ghi( Auth::user()->name . 'Đã cập nhật vai trò mới ' . $role->name, 'Vai trò', Auth::user()->name . 'Đã cập nhật vai trò mới ' . $role->name . 'trong quản trị viên');

        return redirect()->route('admin.roles.index')->with('success', 'Cập nhật vai trò thành công.');
    }

    // Remove the specified role from storage
    public function destroy(Role $role)
    {
        // Delete the role
        $role->delete();
                      LogHelper::ghi( Auth::user()->name . 'Đã xóa vai trò mới ' . $role->name, 'Vai trò', Auth::user()->name . 'Đã xóa vai trò ' . $role->name . 'trong quản trị viên');

        // Redirect back with success message
        return redirect()->route('admin.roles.index')->with('success', 'Xóa vai trò thành công.');
    }
}
