<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $countries = [
            [
                'name' => 'الأردن',
                'citizenship' => 'أردني',
                'country_code' => 'JO',
                'currency_code' => '',
            ],
            [
                'name' => ' الإمارات العربية المتحدة',
                'citizenship' => 'اماراتي',
                'country_code' => 'AE',
                'currency_code' => '',
            ],
            [
                'name' => 'البحرين',
                'citizenship' => 'بحريني',
                'country_code' => 'BH',
                'currency_code' => '',
            ],
            [
                'name' => 'الجزائر',
                'citizenship' => 'جزائري',
                'country_code' => 'DZ',
                'currency_code' => '',
            ],
            [
                'name' => 'السعودية',
                'citizenship' => 'سعودي',
                'country_code' => 'SA',
                'currency_code' => '',
            ],
            [
                'name' => 'السودان',
                'citizenship' => 'سوداني',
                'country_code' => 'SD',
                'currency_code' => '',
            ],
            [
                'name' => 'العراق',
                'citizenship' => 'عراقي',
                'country_code' => 'IQ',
                'currency_code' => ''
            ],
            [
                'name' => 'الكويت',
                'citizenship' => 'كويتي',
                'country_code' => 'KW',
                'currency_code' => '',
            ],
            [
                'name' => 'المغرب',
                'citizenship' => 'مغربي',
                'country_code' => 'MA',
                'currency_code' => '',
            ],
            [
                'name' => 'اليمن',
                'citizenship' => 'يمني',
                'country_code' => 'YE',
                'currency_code' => '',
            ],
            [
                'name' => 'تونس',
                'citizenship' => 'تونسي',
                'country_code' => 'TN',
                'currency_code' => '',
            ],
            [
                'name' => 'سوريا',
                'citizenship' => 'سوري',
                'country_code' => 'SY',
                'currency_code' => '',
            ],
            [
                'name' => 'عمان',
                'citizenship' => 'عماني',
                'country_code' => 'OM',
                'currency_code' => '',
            ],
            [
                'name' => 'فلسطين',
                'citizenship' => 'فلسطيني',
                'country_code' => 'PS',
                'currency_code' => '',
            ],
            [
                'name' => 'لبنان',
                'citizenship' => 'لبناني',
                'country_code' => 'LB',
                'currency_code' => '',
            ],
            [
                'name' => 'ليبيا',
                'citizenship' => 'ليبي',
                'country_code' => 'LY',
                'currency_code' => '',
            ],
            [
                'name' => 'مصر',
                'citizenship' => 'مصري',
                'country_code' => 'EG',
                'currency_code' => '',
            ],
            [
                'name' => 'موريتانيا',
                'citizenship' => 'موريطاني',
                'country_code' => 'MR',
                'currency_code' => '',
            ]
        ];

        foreach( $countries as $country ) {
            Country::create($country);
        }

    }
}
