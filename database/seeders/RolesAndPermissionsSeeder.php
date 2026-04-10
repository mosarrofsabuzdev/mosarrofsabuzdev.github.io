<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'manage crm',
            'manage operations',
            'manage finance',
            'manage settings',
            'view intelligence',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $owner = Role::firstOrCreate(['name' => 'owner']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        $owner->syncPermissions($permissions);
        $manager->syncPermissions(['view dashboard', 'manage crm', 'manage operations', 'manage finance', 'view intelligence']);
        $staff->syncPermissions(['view dashboard', 'manage operations']);
    }
}
