<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PtcAd extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'url',
        'timer',
        'view_max',
        'total_views',
        'status',
        'ad_type',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'timer'       => 'integer',
        'view_max'    => 'integer',
        'total_views' => 'integer',
        'starts_at'   => 'datetime',
        'ends_at'     => 'datetime',
    ];

    // === Relations ===

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rewards(): HasMany
    {
        return $this->hasMany(PtcAdReward::class);
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(PtcAdClick::class);
    }

    /**
     * Ambil reward config untuk coin tertentu
     */
    public function rewardForCurrency(int $currencyId): ?PtcAdReward
    {
        return $this->rewards()->where('currency_id', $currencyId)->first();
    }

    // === Scopes ===

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where(function ($q) {
                         $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
                     })
                     ->where(function ($q) {
                         $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
                     })
                     ->where(function ($q) {
                         $q->where('view_max', 0)
                           ->orWhereColumn('total_views', '<', 'view_max');
                     });
    }

    public function scopeForCurrency($query, int $currencyId)
    {
        return $query->whereHas('rewards', fn ($q) =>
            $q->where('currency_id', $currencyId)->where('budget', '>', 0)
              ->whereColumn('spent', '<', 'budget')
        );
    }

    // === Helpers ===

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function hasReachedMaxViews(): bool
    {
        return $this->view_max > 0 && $this->total_views >= $this->view_max;
    }
}
