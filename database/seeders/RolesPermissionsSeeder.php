<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilities = [
            'read',
            'create',
            'update',
            'delete'
        ];

        $permissionByRoles = [
            'administrator' => [
                'user management',
                'product management',
                'category management',
                'brand management',
                'blog management',
                'banner management',
                'role management',
                'permission management',
                'order management',
                'product option management',
                'report management',
                'customer management',
                'contact management',
                'voucher management',
            ],
            'employee' => [
                'product management',
                'category management',
                'brand management',
                'blog management',
                'banner management',
                'order management',
                'shipping management',
                'product option management',
                'employee management',
                'voucher management',
            ],
        ];

        // Tạo quyền nếu nó chưa tồn tại
        foreach ($permissionByRoles as $role => $permissions) {
            $full_permissions_list = [];
            foreach ($abilities as $ability) {
                foreach ($permissions as $permission) {
                    $permissionName = $ability . ' ' . $permission;
                    Permission::firstOrCreate(['name' => $permissionName]);
                    $full_permissions_list[] = $permissionName;
                }
            }

            // Tạo vai trò và gán quyền cho vai trò
            $roleInstance = Role::firstOrCreate(['name' => $role]);
            $roleInstance->syncPermissions($full_permissions_list);
        }

        // Gán vai trò cho người dùng
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('administrator');
        }

        $employeeUser = User::find(2);
        if ($employeeUser) {
            $employeeUser->assignRole('employee');
        }
    }
}
