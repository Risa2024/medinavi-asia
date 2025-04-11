<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'インドネシア',
                'emoji' => '🇮🇩',
                'currency_code' => 'IDR'
            ],
            [
                'name' => 'タイ',
                'emoji' => '🇹🇭',
                'currency_code' => 'THB'
            ],
            [
                'name' => 'マレーシア',
                'emoji' => '🇲🇾',
                'currency_code' => 'MYR'
            ],
            [
                'name' => 'ベトナム',
                'emoji' => '🇻🇳',
                'currency_code' => 'VND'
            ]
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
