<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $fillable = [
        'currency_code',
        'rate_to_jpy',
        'updated_date',
    ];

    protected $casts = [
        'updated_date' => 'date',
        'rate_to_jpy' => 'float',
    ];
}
