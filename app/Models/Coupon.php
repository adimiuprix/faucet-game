<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'code',
    'reward',
    'energy_reward',
    'expired_at',
])]
class Coupon extends Model
{
    protected $casts = [
        'reward' => 'decimal:2',
        'energy_reward' => 'integer',
        'expired_at' => 'datetime',
    ];
}