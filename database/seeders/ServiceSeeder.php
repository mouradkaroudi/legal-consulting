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
                'slug' => 'الخدمات-الإنسانية'
            ],
            [
                'name' => 'الخدمات الإجتماعية',
                'slug' => 'الخدمات-الإجتماعية'
            ],
            [
                'name' => 'الخدمات الإلكترونية',
                'slug' => 'الخدمات-الإلكترونية'
            ],
            [
                'name' => 'خدمات التدريب',
                'slug' => 'خدمات-التدريب'
            ],
        ];

        \App\Models\Service::insert($services);
    }
}
