<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaucetClaim extends Model
{
    use HasFactory;

    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'currency_id',
        'reward_amount',
        'energy_used',
        'status',
    ];

    protected $casts = [
        'reward_amount' => 'decimal:8',
        'energy_used'   => 'integer',
    ];

    /**
     * Get the user that owns the faucet claim
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the currency of the faucet claim
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Scope for completed claims
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope for pending claims
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for rejected claims
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope for claims by specific user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for claims by specific currency
     */
    public function scopeByCurrency($query, $currencyId)
    {
        return $query->where('currency_id', $currencyId);
    }

    /**
     * Scope for claims within date range
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('claimed_at', [$startDate, $endDate]);
    }

    /**
     * Scope for recent claims
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('claimed_at', 'desc')->limit($limit);
    }

    /**
     * Check if claim is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if claim is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if claim is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Get formatted reward amount
     */
    public function getFormattedRewardAttribute(): string
    {
        return number_format($this->reward_amount, 8);
    }
}
