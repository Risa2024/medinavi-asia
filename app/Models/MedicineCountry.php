<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 薬と国の中間テーブルモデル
 * 
 * このモデルは多対多リレーションシップを管理する中間テーブルを表します。
 * 薬（Medicine）と国（Country）の関連付けに加えて、
 * 各国ごとの価格と通貨コードも保持します。
 */
class MedicineCountry extends Model
{
    /**
     * 使用するテーブル名を指定
     * 
     * デフォルトでは「medicine_countries」となりますが、
     * 実際のテーブル名は「medicines_country」のため明示的に指定しています。
     */
    protected $table = 'medicines_country';
    
    /**
     * 一括代入可能な属性
     * 
     * これらのフィールドはモデル作成時に一度に代入できます。
     * medicines_countryテーブルの各カラムに対応しています。
     */
    protected $fillable = [
        'medicine_id',   // 薬ID（medicinesテーブルの外部キー）
        'country_id',    // 国ID（countriesテーブルの外部キー）
        'price',         // 各国での薬の価格
        'currency_code'  // 価格に対応する通貨コード（例：IDR, MYR, THB）
    ];

    /**
     * この関連付けが所属する薬を取得
     * 
     * この中間テーブルレコードに関連する薬（Medicine）モデルを取得します。
     * belongsToリレーションは「所属する」関係を表します。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    /**
     * この関連付けが所属する国を取得
     * 
     * この中間テーブルレコードに関連する国（Country）モデルを取得します。
     * belongsToリレーションは「所属する」関係を表します。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
