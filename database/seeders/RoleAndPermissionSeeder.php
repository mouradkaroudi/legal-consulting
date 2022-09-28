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
        // office owners permissions
        Permission::create(['name' => 'manage-employees']);
        Permission::create(['name' => 'manage-office']);

        // $adminRole = Role::create(['name' => 'Admin']);
        // $financialAdminRole = Role::create(['name' => 'FinancialAdmin']);
        // $usersAdminRole = Role::create(['name' => 'UsersAdmin']);

        $officeOwnerRole = Role::create(['name' => 'OfficeOwner']);
        // $officeEmployeeRole = Role::create(['name' => 'OfficeEmployeeOwner']);
        $beneficiaryRole = Role::create(['name' => 'Beneficiary']);

        $officeOwnerRole->givePermissionTo([
            'manage-employees',
            'manage-office'
        ]);

    }
}
