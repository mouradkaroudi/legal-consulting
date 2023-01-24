<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DigitalOffice;
use App\Models\Service;
use Illuminate\Database\Seeder;
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
			CitySeeder::class,
			AdminSeeder::class,
			ServiceSeeder::class,
			ProfessionSeeder::class,
			SpecializationSeeder::class,
			SettingSeeder::class,
		]);

		$users = \App\Models\User::factory(6)->create();

		$users->slice(0, 2)->each(function ($user) {
			$randService = Service::inRandomOrder()->first();

			$randServiceProfession = $randService
			->professions()
			->inRandomOrder()
			->first();

			\App\Models\DigitalOffice::create([
				"user_id" => $user->id,
				"name" => "مكتب " . $user->name,
				"status" => DigitalOffice::AVAILABLE,
				"service_id" => $randService->id,
				"profession_id" => $randServiceProfession->id,
			])
				->employees()
				->create([
					"user_id" => $user->id,
				]);

			// create profiles
			\App\Models\Profile::factory()->create([
				"user_id" => $user->id,
			]);
		});

		$users->slice(3, 5)->each(function ($user) {
			// create profiles
			\App\Models\Profile::factory()->create([
				"user_id" => $user->id,
			]);

			$employee = \App\Models\DigitalOffice::inRandomOrder()
				->first()
				->employees()
				->create([
					"user_id" => $user->id,
				]);

			$defaultRolePermissions = Role::findByName("OfficeEmployee")->permissions;
			
			$employee->givePermissionTo($defaultRolePermissions->pluck('name')->all());
				
		});
	}
}
