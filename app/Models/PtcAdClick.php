<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PtcAdClick extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_INVALID = 'invalid';

    protected $fillable = [
        'ptc_ad_id',
        'user_id',
        'currency_id',
        'reward',
        'status',
        'clicked_at',
        'completed_at',
    ];

    protected $casts = [
        'reward' => 'decimal:8',
        'clicked_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function ptcAd(): BelongsTo
    {
        return $this->belongsTo(PtcAd::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
