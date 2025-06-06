<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Medicine extends Model
{
    // データベースに保存を許可するカラムを指定
    protected $fillable = [
        'name',
        'image_path',
        'description',
        'category'
    ];

    // 特別な型変換が必要なカラムを指定
    protected $casts = [
        'country' => 'array' // JSONデータを配列として扱う
    ];

    /**
     * この薬に関連する国を取得
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'medicines_country')
            ->withPivot(['price', 'currency_code'])
            ->withTimestamps();
    }

    /**
     * この薬のお気に入り情報を取得
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * 特定の国でのみ販売されている薬をフィルタリングするスコープ
     * scopeInCountryは特殊な名前で、Medicine::inCountry('JP')のように使える
     */
    public function scopeInCountry($query, $countryCode)
    {
        \Log::info('scopeInCountry呼び出し', [
            'country_id' => $countryCode
        ]);

        if ($countryCode) {
            \Log::info('国別フィルタリング条件', [
                'condition' => "countries.id = {$countryCode} AND medicines_country.price > 0"
            ]);

            return $query->whereHas('countries', function($q) use ($countryCode) {//whereHas('countries')は「国テーブルと関連づけられているか」をチェック
                $q->where('countries.id', $countryCode)//where('countries.id', $countryCode)は「指定された国コードと一致するか」をチェック
                  ->where('medicines_country.price', '>', 0);//where('medicines_country.price', '>', 0)は「その国での価格が0より大きいか」（実際に販売されているか）をチェック
            });
        }
        return $query;
    }
}
//MedicineControllerで次のように使ってる
//if ($countryId) {
//    $baseQuery->inCountry($countryId);
//}
