<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
