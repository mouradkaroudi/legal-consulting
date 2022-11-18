<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            CountriesSeeder::class,
            CitySeeder::class
        ]);

        $users = \App\Models\User::factory(6)->create();

        // Profiles
        
        \App\Models\Profile::factory()->create([
            'user_id' => 1
        ]);
        \App\Models\Profile::factory()->create([
            'user_id' => 2
        ]);
        \App\Models\Profile::factory()->create([
            'user_id' => 3
        ]);
        \App\Models\Profile::create([
            'user_id' => 4
        ]);
        // ==============
        
        // Digital offices and employees
        // 1
        $digitalOffice1 = \App\Models\DigitalOffice::create([
            'user_id' => 1,
            'name' => 'مكتب المحامي د عبدالله العجلان',
            'status' => 'busy'
        ]);

        $digitalOffice1Employee = DigitalOfficeEmployee::create([
            'office_id' => $digitalOffice1->id,
            'user_id' => 2
        ]);

        $digitalOffice1Employee->assignRole(Role::findByName('OfficeEmployee'));

        //
        $digitalOffice2 = \App\Models\DigitalOffice::create([
            'user_id' => 2,
            'name' => 'شركة الجبيري للمحاماة',
            'status' => 'available'
        ]);

        $digitalOffice2Employees = DigitalOfficeEmployee::create([
            'office_id' => $digitalOffice2->id,
            'user_id' => 3
        ]);
        $digitalOffice2Employees->assignRole(Role::findByName('OfficeEmployee'));
        
        //
        $digitalOffice3 = \App\Models\DigitalOffice::create([
            'user_id' => 4,
            'name' => 'مكتب المحامي محمد العليوي للمحاماة والاستشارات القانونية'
        ]);

    }
}
