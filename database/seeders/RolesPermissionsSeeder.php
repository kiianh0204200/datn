<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ],
        ];

        foreach ($permissionByRoles['administrator'] as $permission) {
            foreach ($abilities as $ability) {
                Permission::create(['name' => $ability . ' ' . $permission]);
            }
        }

        foreach ($permissionByRoles as $role => $permissions) {
            $full_permissions_list = [];
            foreach ($abilities as $ability) {
                foreach ($permissions as $permission) {
                    $full_permissions_list[] = $ability . ' ' . $permission;
                }
            }
            Role::create(['name' => $role])->syncPermissions($full_permissions_list);
        }

        User::find(1)->assignRole('administrator');
        User::find(2)->assignRole('employee');
    }
}
