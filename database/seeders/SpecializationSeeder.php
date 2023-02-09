<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            [
                'name' => 'عام',
                'slug' => 'general',
                'profession_id' => 2
            ],
            [
                'name' => 'الإصابات الشخصية',
                'slug' => 'personal-injuries',
                'profession_id' => 2
            ],
            [
                'name' => 'التخطيط العقاري',
                'slug' => 'real-estate-planning',
                'profession_id' => 2
            ]
        ];

        foreach($specializations as $specialization) {
            \App\Models\Specialization::create($specialization);
        }

    }
}
