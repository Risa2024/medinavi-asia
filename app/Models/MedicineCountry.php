<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 薬と国の中間テーブルモデル
 *
 * このモデルは多対多リレーションシップを管理する中間テーブル。
 * 薬（Medicine）と国（Country）の関連付けに加えて、
 * 各国ごとの価格と通貨コードも保持してる。
 */
class MedicineCountry extends Model
{
    /**
     * 使用するテーブル名を指定
     *
     * デフォルトでは「medicine_countries」となるが、
     * 実際のテーブル名は「medicines_country」のため明示的に指定した。
     */
    protected $table = 'medicines_country';

    /**
     * 一括代入可能な属性
     *
     * これらのフィールドはモデル作成時に一度に代入できる。
     * medicines_countryテーブルの各カラムに対応してる。
     */
    protected $fillable = [
        'medicine_id',   // 薬ID（medicinesテーブルの外部キー）
        'country_id',    // 国ID（countriesテーブルの外部キー）
        'price',         // 各国での薬の価格
        'currency_code'  // 価格に対応する通貨コード（例：IDR, MYR, THB,VND）
    ];

    /**
     * この関連付けが所属する薬を取得
     *
     * この中間テーブルレコードに関連する薬（Medicine）モデルを取得する。
     * belongsToリレーションは「所属する」関係を表していく。
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
     * この中間テーブルレコードに関連する国（Country）モデルを取得。
     * belongsToリレーションは「所属する」関係を表している。
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
