<?php

namespace Database\Seeders;

use App\Models\DichVu;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'Thêm người dùng',
            'Sửa người dùng',
            'Xóa người dùng',
            'Xem người dùng',
            'Thêm quyền',
            'Sửa quyền',
            'Xóa quyền',
            'Xem quyền',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions($permissions);

Role::firstOrCreate(['name' => 'nguoi-thue-tro']);

        // Gán Super Admin cho User ID 1
        $admin = User::find(1);
        if ($admin) {
            $admin->assignRole('Super Admin');
        }


        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super-Admin',
                'username' => 'SupperAdmin',
                'password' => Hash::make('password123'), // Đổi mật khẩu mạnh hơn
            ]
        );

        $superAdmin->assignRole('Super Admin');
    }
}
