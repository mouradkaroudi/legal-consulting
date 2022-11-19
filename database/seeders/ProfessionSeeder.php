<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            [
                'name' => 'موثق',
                'slug' => 'موثق',
                'service_id' => 1
            ],
            [
                'name' => 'محامي',
                'slug' => 'محامي',
                'service_id' => 1
            ],
            [
                'name' => 'تجهيز المعاملات',
                'slug' => 'تجهيز-المعاملات',
                'service_id' => 3
            ],
        ];

        \App\Models\Profession::insert($professions);

    }
}
