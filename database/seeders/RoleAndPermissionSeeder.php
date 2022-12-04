<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // digital office employees permissions
        Permission::create(['name' => 'manage-employees']);
        Permission::create(['name' => 'manage-office']);
        Permission::create(['name' => 'manage-messages']);
        Permission::create(['name' => 'manage-orders']);
        Permission::create(['name' => 'send-invites']);
        Permission::create(['name' => 'manage-notifications']);
        Permission::create(['name' => 'view-balance']);

        $officeEmployeeRole = Role::create(['name' => 'OfficeEmployee']);

        $officeEmployeeRole->givePermissionTo([
            'manage-messages',
            'manage-orders'
        ]);

    }
}
