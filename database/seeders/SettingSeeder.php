<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$settings = [
			["option" => "digital_office_direct_registration", "value" => true],
			["option" => "digital_office_registration_fee", "value" => 0],
			["option" => "order_min_fee", "value" => 0],
			["option" => "order_max_fee", "value" => 0],
			["option" => "order_percentage_fee", "value" => 0],
			["option" => "registration_open", "value" => true],
			["option" => "balance_hold_duration", "value" => 0],
			["option" => "balance_min_withdrawals", "value" => 0],
		];

		\App\Models\Setting::insert($settings);
	}
}
