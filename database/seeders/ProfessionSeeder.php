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
                'slug' => 'legalized',
                'service_id' => 1
            ],
            [
                'name' => 'محامي',
                'slug' => 'lawyer',
                'service_id' => 1
            ],
            [
                'name' => 'تجهيز المعاملات',
                'slug' => 'processing-transactions',
                'service_id' => 3
            ],
        ];

        foreach($professions as $profession) {
            \App\Models\Profession::create($profession);
        }

    }
}
