<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',

            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',

            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // create roles and assign created permissions

        // Super Admin role with all permissions
        $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        // Customer role
        $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'Customer']);

        // User role with permissions
        // $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'User']);

        // $rolePermissions = [
        //     'user_edit',
        //     'user_show',
        //     'user_delete',
        // ];

        // foreach ($rolePermissions as $permission) {
        //     $role->givePermissionTo($permission);
        // }

        // // Staff role with permissions
        // $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'Staff']);

        // $rolePermissions = [
        //     'user_show',
        // ];

        // foreach ($rolePermissions as $permission) {
        //     $role->givePermissionTo($permission);
        // }
    }
}
