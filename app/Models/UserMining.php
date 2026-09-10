<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMining extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'claim_time',
        'status',
        'is_claimed',
    ];

    protected $casts = [
        'claim_time' => 'integer',
    ];

    /**
     * Status constants
     */
    const STATUS_PROCESS = 'process';
    const STATUS_ENDED = 'ended';

    /**
     * Get the user that owns this mining
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the mining plan for this user mining
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(MiningPlan::class, 'plan_id');
    }

    /**
     * Check if mining is in process
     */
    public function isProcess(): bool
    {
        return $this->status === self::STATUS_PROCESS;
    }

    /**
     * Check if mining has ended
     */
    public function isEnded(): bool
    {
        return $this->status === self::STATUS_ENDED;
    }

    /**
     * Check if mining can be claimed
     */
    public function canClaim(): bool
    {
        return $this->isProcess() && time() >= $this->claim_time;
    }

    /**
     * Check if this mining reward has already been claimed.
     */
    public function isClaimed(): bool
    {
        return $this->is_claimed;
    }

    /**
     * Get remaining time in seconds
     */
    public function getRemainingTimeAttribute(): int
    {
        if ($this->isEnded()) {
            return 0;
        }

        return max(0, $this->claim_time - time());
    }

    /**
     * Scope for process status
     */
    public function scopeProcess()
    {
        return $this->where('status', self::STATUS_PROCESS);
    }

    /**
     * Scope for ended status
     */
    public function scopeEnded()
    {
        return $this->where('status', self::STATUS_ENDED);
    }

    /**
     * Scope for claimable minings
     */
    public function scopeClaimable()
    {
        return $this->where('status', self::STATUS_PROCESS)
                    ->where('claim_time', '<=', time());
    }
}
