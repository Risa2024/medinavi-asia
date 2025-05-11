<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class GeoController extends Controller
{
    public function getCountry(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        if (!$lat || !$lng) {
            return response()->json(['country' => null, 'country_id' => null]);
        }

        // 簡易的な範囲判定（本番は外部API推奨）
        $countries = [
            [
                'name' => 'インドネシア',
                'id' => Country::where('name', 'インドネシア')->value('id'),
                'lat_min' => -11, 'lat_max' => 6, 'lng_min' => 95, 'lng_max' => 141
            ],
            [
                'name' => 'タイ',
                'id' => Country::where('name', 'タイ')->value('id'),
                'lat_min' => 5, 'lat_max' => 21, 'lng_min' => 97, 'lng_max' => 106
            ],
            [
                'name' => 'マレーシア',
                'id' => Country::where('name', 'マレーシア')->value('id'),
                'lat_min' => 0.8, 'lat_max' => 7.5, 'lng_min' => 99, 'lng_max' => 120
            ],
            [
                'name' => 'ベトナム',
                'id' => Country::where('name', 'ベトナム')->value('id'),
                'lat_min' => 8, 'lat_max' => 24, 'lng_min' => 102, 'lng_max' => 110
            ],
        ];

        foreach ($countries as $country) {
            if ($lat >= $country['lat_min'] && $lat <= $country['lat_max'] && $lng >= $country['lng_min'] && $lng <= $country['lng_max']) {
                return response()->json([
                    'country' => $country['name'],
                    'country_id' => $country['id']
                ]);
            }
        }
        return response()->json(['country' => null, 'country_id' => null]);
    }
}
