<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MiningPlan extends Model
{
    protected $fillable = [
        'plan_name',
        'cost',
        'cost_unit',
        'reward',
        'reward_currency_id',
        'duration'
    ];

    protected $casts = [
        'cost' => 'integer',
        'reward' => 'decimal:8',
        'duration' => 'integer',
    ];

    /**
     * Get the currency for this mining plan
     */
    public function rewardCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'reward_currency_id');
    }

    /**
     * Get all user minings for this plan
     */
    public function userMinings(): HasMany
    {
        return $this->hasMany(UserMining::class, 'plan_id');
    }

    /**
     * Get formatted reward amount
     */
    public function getFormattedRewardAttribute(): string
    {
        return number_format($this->reward, 8);
    }

    /**
     * Get duration in hours
     */
    public function getDurationInHoursAttribute(): float
    {
        return $this->duration / 3600;
    }

    /**
     * Get duration in days
     */
    public function getDurationInDaysAttribute(): float
    {
        return $this->duration / 86400;
    }
}
