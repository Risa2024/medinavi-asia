<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'currency_code'
    ];

    /**
     * この国で販売されている薬を取得
     */
    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'medicines_country')
            ->withPivot(['price', 'currency_code'])
            ->withTimestamps();
    }
}
