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
        // 対応国以外の場合は逆ジオコーディングAPIで国名を取得
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=5&addressdetails=1";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'medinavi-asia/1.0 (your-email@example.com)');
        $json = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);
        \Log::info('Nominatim API URL', ['url' => $url]);
        \Log::info('Nominatim API Response', ['json' => $json]);
        \Log::info('Nominatim cURL Error', ['error' => $curlError]);
        $countryName = null;
        if ($json) {
            $data = json_decode($json, true);
            \Log::info('Nominatim API Parsed', ['data' => $data]);
            if (isset($data['address']['country'])) {
                $countryName = $data['address']['country'];
            }
        }
        if (!$countryName) {
            $countryName = '国情報が取得できませんでした';
        }
        return response()->json(['country' => $countryName, 'country_id' => null]);
    }
}
