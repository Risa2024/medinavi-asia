<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
     // データベースに保存を許可するカラムを指定
     protected $fillable = [
        'name',
        'image_path',
        'currency_code',
        'price',
        'description',
        'category',
        'country'
    ];

    // 特別な型変換が必要なカラムを指定
    protected $casts = [
        'country' => 'array' // JSONデータを配列として扱う
    ];
}
