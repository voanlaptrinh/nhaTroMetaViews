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
            'Thêm vai trò',
            'Sửa vai trò',
            'Xóa vai trò',
            'Xem vai trò',
            'Thêm dịch vụ',
            'Xem dịch vụ',
            'Sửa dịch vụ',
            'Xóa dịch vụ',
            'Thêm nhà trọ',
            'Sửa nhà trọ',
            'Xóa nhà trọ',
            'Xem nhà trọ',
            'Thêm tài sản trọ',
            'Sửa tài sản trọ',
            'Xóa tài sản trọ',
            'Xem tài sản trọ',
            'Xem phòng trọ',
            'Sửa phòng trọ',
            'Thêm phòng trọ',
            'Xóa phòng trọ',
            'Thêm tài sản',
            'Sửa tài sản',
            'Xóa tài sản',
            'Xem tài sản',
            'Xem khách hàng',
            'Thêm khách hàng',
            'Sửa khách hàng',
            'Xóa khách hàng',
            'Thêm tin tức',
            'Xem tin tức',
            'Sửa tin tức',
            'Xóa tin tức',
            'Xem liên hệ',
            'Thêm chính sách',
            'Xem chính sách',
            'Sửa chính sách',
            'Xóa chính sách',
            'Thêm slider',
            'Xem slider',
            'Sửa slider',
            'Xóa slider',
            'Thêm cảm nghĩ',
            'Xem cảm nghĩ',
            'Sửa cảm nghĩ',
            'Xóa cảm nghĩ',
            'Cài đặt web',
            'Về chúng tôi'


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
