<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create select_favourite permission
        $permission = Permission::create(['name' => 'select_favourite', 'guard_name' => 'web']);

        // Assign permission to roles
        $adminRole = Role::where('name', 'Admin')->first();
        $employeeRole = Role::where('name', 'Employee')->first();
        $customerRole = Role::where('name', 'Customer')->first();

        if ($adminRole) {
            $adminRole->givePermissionTo($permission);
        }
        if ($employeeRole) {
            $employeeRole->givePermissionTo($permission);
        }
        if ($customerRole) {
            $customerRole->givePermissionTo($permission);
        }
    }
}
