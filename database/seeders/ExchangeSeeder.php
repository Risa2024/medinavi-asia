<?php

namespace Database\Seeders;

use App\Models\Exchange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exchanges = [
            [
                'currency_code' => 'IDR',  // インドネシア・ルピア
                'rate_to_jpy' => 0.0092,   // 1IDR = 0.0092円
                'updated_date' => now(),
            ],
            [
                'currency_code' => 'THB',  // タイ・バーツ
                'rate_to_jpy' => 3.9,      // 1THB = 3.9円
                'updated_date' => now(),
            ],
            [
                'currency_code' => 'MYR',  // マレーシア・リンギット
                'rate_to_jpy' => 30.2,     // 1MYR = 30.2円
                'updated_date' => now(),
            ],
            [
                'currency_code' => 'VND',  // ベトナム・ドン
                'rate_to_jpy' => 0.0058,   // 1VND = 0.0058円
                'updated_date' => now(),
            ],
            [
                'currency_code' => 'PHP',  // フィリピン・ペソ
                'rate_to_jpy' => 2.31,     // 1PHP = 2.31円
                'updated_date' => now(),
            ],
            [
                'currency_code' => 'SGD',  // シンガポール・ドル
                'rate_to_jpy' => 103.5,    // 1SGD = 103.5円
                'updated_date' => now(),
            ],
        ];

        foreach ($exchanges as $exchange) {
            Exchange::create($exchange);
        }
    }
}
