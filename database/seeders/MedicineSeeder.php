<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
{
    // 風邪薬①
    Medicine::create([
        'name' => 'ボドレックス / Bodrex',
        'currency_code' => 'IDR',
        'price' => 8000,
        'category' => '風邪薬',
        'country' => 'インドネシア',
        'description' => '風邪の諸症状（発熱・頭痛・鼻水）に対応した定番市販薬。現地では家庭に常備されている。'
    ]);

    // 風邪薬②
    Medicine::create([
        'name' => 'コルディン / COLDIN',
        'currency_code' => 'IDR',
        'price' => 7000,
        'category' => '風邪薬',
        'country' => 'インドネシア',
        'description' => 'くしゃみ・鼻水・頭痛などの風邪症状に対応。眠くなりにくい処方で人気。'
    ]);

    // 腹痛薬①
    Medicine::create([
        'name' => 'チャトコール / Charcoal Tablets',
        'currency_code' => 'THB',
        'price' => 30,
        'category' => '腹痛薬',
        'country' => 'タイ',
        'description' => 'お腹のガス・食あたり・下痢などに対応する活性炭の錠剤。副作用が少なく旅行者にも人気。'
    ]);

    // 腹痛薬②
    Medicine::create([
        'name' => 'スメクタ / Smecta',
        'currency_code' => 'IDR',
        'price' => 10000,
        'category' => '腹痛薬',
        'country' => 'インドネシア',
        'description' => '水様性下痢や軽い胃腸炎に使われる整腸薬。子どもでも服用可。'
    ]);

    // 腹痛薬③
    Medicine::create([
        'name' => 'ディアナチュラ / Diatabs',
        'currency_code' => 'IDR',
        'price' => 9000,
        'category' => '腹痛薬',
        'country' => 'インドネシア',
        'description' => '急な下痢に対応する市販薬。コンビニや薬局で手軽に購入可能。'
    ]);
}

    }
}
