<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

#[Fillable([
    'coin',
    'status',
    'faucet_reward',
    'image'
])]

class Currency extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'currency_users')->withPivot('balance')->withTimestamps();
    }

    public function faucetClaims()
    {
        return $this->hasMany(FaucetClaim::class);
    }

    public function miningPlans()
    {
        return $this->hasMany(MiningPlan::class, 'reward_currency_id');
    }
}
