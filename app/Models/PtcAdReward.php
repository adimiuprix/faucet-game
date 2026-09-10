<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PtcAdReward extends Model
{
    protected $fillable = [
        'ptc_ad_id',
        'currency_id',
        'reward',
        'budget',
        'spent',
    ];

    protected $casts = [
        'reward' => 'decimal:8',
        'budget' => 'decimal:8',
        'spent' => 'decimal:8',
    ];

    public function ptcAd(): BelongsTo
    {
        return $this->belongsTo(PtcAd::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
