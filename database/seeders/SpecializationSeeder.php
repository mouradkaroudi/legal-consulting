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
                'slug' => '',
                'profession_id' => 2
            ],
            [
                'name' => 'الإصابات الشخصية',
                'slug' => '',
                'profession_id' => 2
            ],
            [
                'name' => 'التخطيط العقاري',
                'slug' => '',
                'profession_id' => 2
            ]
        ];

        foreach($specializations as $specialization) {
            \App\Models\Specialization::create($specialization);
        }

    }
}
