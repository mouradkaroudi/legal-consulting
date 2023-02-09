<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $services = [
            [
                'name' => 'الخدمات الإنسانية',
                'slug' => 'human-services'
            ],
            [
                'name' => 'الخدمات الإجتماعية',
                'slug' => 'social-services'
            ],
            [
                'name' => 'الخدمات الإلكترونية',
                'slug' => 'e-services'
            ],
            [
                'name' => 'خدمات التدريب',
                'slug' => 'training-services'
            ],
        ];

        foreach($services as $service) {
            \App\Models\Service::create($service);
        }
        
    }
}
