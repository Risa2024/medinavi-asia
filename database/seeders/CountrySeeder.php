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
                'code' => 'ID',
                'currency_code' => 'IDR'
            ],
            [
                'name' => 'タイ',
                'emoji' => '🇹🇭',
                'code' => 'TH',
                'currency_code' => 'THB'
            ],
            [
                'name' => 'マレーシア',
                'emoji' => '🇲🇾',
                'code' => 'MY',
                'currency_code' => 'MYR'
            ],
            [
                'name' => 'ベトナム',
                'emoji' => '🇻🇳',
                'code' => 'VN',
                'currency_code' => 'VND'
            ]
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
