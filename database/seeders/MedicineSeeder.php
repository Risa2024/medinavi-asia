<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            [
                'name' => 'Panadol Paracetamol (10錠)',
                'description' => <<<'EOD'
Panadol Paracetamol（パナドール パラセタモール）は、頭痛、歯痛、筋肉痛や風邪に伴う発熱など、さまざまな痛みや発熱に効果のある解熱鎮痛剤です。
主成分であるパラセタモール（アセトアミノフェン）は、胃への負担が少なく、比較的副作用が少ない成分として広く使用されています。
Panadolは世界90か国以上で販売されている信頼性の高いブランドで、大人用・子ども用、速効性のあるActiFastタイプ、溶解タイプなど様々なバリエーションが用意されています。
EOD,
                'category' => '解熱鎮痛薬',
                'image_path' => 'medicines/W36szVydBh642O2N8eZRimftSXtIKYHWxzoMXaCY.jpg',
                'countries' => [
                    'タイ' => 336,
                    'インドネシア' => 1400,
                    'マレーシア' => 9,
                    'ベトナム' => null
                ]
            ],
            [
                'name' => 'Panadol Extra (10錠)',
                'description' => <<<'EOD'
Panadol Extra（パナドール・エクストラ）は、頭痛、歯痛、筋肉痛、月経痛、風邪による発熱や倦怠感など、さまざまな不快な痛みに効果を発揮する解熱鎮痛剤です。
主成分であるパラセタモール（アセトアミノフェン）に加えて、カフェインが配合されており、鎮痛効果を高めつつ、眠気やだるさを抑える作用があります。
EOD,
                'category' => '解熱鎮痛薬',
                'image_path' => 'medicines/XqYxBAAgLB8GyEh5E1PTSwMvmLnLLJZESBlO4Agd.jpg',
                'countries' => [
                    'タイ' => null,
                    'インドネシア' => 13400,
                    'マレーシア' => 13,
                    'ベトナム' => null
                ]
            ],
            [
                'name' => 'Panadol Cold & Flu (10錠)',
                'description' => <<<'EOD'
Panadol Cold & Flu（パナドール コールド＆フル）は、風邪の諸症状に対応する総合感冒薬です。解熱鎮痛成分であるパラセタモール（アセトアミノフェン）に加えて、鼻水や鼻づまり、くしゃみ、咳などの症状を和らげる複数の成分が配合されています。
複数の成分が組み合わされていることで、風邪の初期症状からしっかりケアできるのが特徴です。症状に応じて「Day（昼用）」と「Night（夜用）」が分かれているパッケージもあり、眠くならないタイプと安眠サポートタイプの使い分けが可能です。
EOD,
                'category' => '解熱鎮痛薬',
                'image_path' => 'medicines/vEHTunr5RfzYtZKo8yW6THPpIItpx5g2Ros8syBu.jpg',
                'countries' => [
                    'タイ' => null,
                    'インドネシア' => 18000,
                    'マレーシア' => null,
                    'ベトナム' => null
                ]
            ],
            [
                'name' => 'Diapet (10錠)',
                'description' => <<<'EOD'
Diapet（ディアペット）は、インドネシアの伝統的なハーブ製剤「ジャムゥ（Jamu）」として広く使用されている植物由来の下痢止めです。
医薬品ではありませんが、グアバ葉やウコンなどの天然成分が、腸内の毒素を吸収し、便の回数を減らす効果があるとされています。
EOD,
                'category' => '下痢止め',
                'image_path' => 'medicines/93OyfRwgZvQNCjTLU6NVffDRxo72olC6m8K3wwLC.jpg',
                'countries' => [
                    'タイ' => null,
                    'インドネシア' => 3000,
                    'マレーシア' => null,
                    'ベトナム' => null
                ]
            ],
            [
                'name' => 'Trackangin (1包)',
                'description' => <<<'EOD'
Tolak Angin（トラックアンギン）は、インドネシアのSido Muncul社が製造するハーブ系の健康補助食品です。主に「masuk angin（風邪の初期症状や体調不良）」の緩和を目的として使用されます。
主な成分には、ショウガ、ミント、フェンネル、クミン、クローブの葉、ハチミツなどが含まれています。
これらの天然成分が組み合わさることで、消化不良、膨満感、吐き気、頭痛、発熱、喉の渇きなどの症状の緩和が期待できます。
EOD,
                'category' => '風邪薬',
                'image_path' => 'medicines/rhJAzC8QnzfrlpaDz6Xrj08rDgiqzmcKm1kxuqFd.jpg',
                'countries' => [
                    'タイ' => null,
                    'インドネシア' => 9000,
                    'マレーシア' => 7,
                    'ベトナム' => null
                ]
            ],
            [
                'name' => 'Bodrex (10錠)',
                'description' => <<<'EOD'
Bodrex（ボドレックス）は、インドネシアで広く使用されている解熱鎮痛薬です。主成分はパラセタモール（アセトアミノフェン）で、頭痛、発熱、筋肉痛などの症状に効果があります。
インドネシアの家庭では常備薬として親しまれています。
EOD,
                'category' => '解熱鎮痛薬',
                'image_path' => 'medicines/NKRfMrJg3aKCgWxG5EAWDz4CdwUZrHRfDYWe1rmX.jpg',
                'countries' => [
                    'タイ' => null,
                    'インドネシア' => 5000,
                    'マレーシア' => null,
                    'ベトナム' => null
                ]
            ],
            [
                'name' => 'Daitabs (10錠)',
                'description' => <<<'EOD'
Daitabs（ダイタブス）は、インドネシアで販売されている解熱鎮痛薬です。主成分はパラセタモール（アセトアミノフェン）で、頭痛、発熱、筋肉痛などの症状に効果があります。
比較的安価で入手しやすい薬として知られています。
EOD,
                'category' => '解熱鎮痛薬',
                'image_path' => 'medicines/93OyfRwgZvQNCjTLU6NVffDRxo72olC6m8K3wwLC.jpg',
                'countries' => [
                    'タイ' => null,
                    'インドネシア' => 4000,
                    'マレーシア' => null,
                    'ベトナム' => null
                ]
            ]
        ];

        foreach ($medicines as $medicineData) {
            // 薬情報を作成
            $medicine = Medicine::create([
                'name' => $medicineData['name'],
                'description' => $medicineData['description'],
                'category' => $medicineData['category'],
                'image_path' => $medicineData['image_path']
            ]);

            // 国と価格の関連付け
            foreach ($medicineData['countries'] as $countryName => $price) {
                $country = Country::where('name', $countryName)->first();
                if ($country && $price !== null) {
                    $medicine->countries()->attach($country->id, [
                        'price' => $price,
                        'currency_code' => $country->currency_code
                    ]);
                }
            }
        }
    }
}
