<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

#[Fillable(['unique_id', 'email', 'energy', 'referred_by', 'balance', 'claim_chance', 'next_claim'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $casts = [
        'energy' => 'integer',
        'next_claim' => 'integer',
    ];

    public function getUserEnergy(): int
    {
        return (int) ($this->energy ?? 0);
    }

    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'currency_users')->withPivot('balance')->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function faucetClaims()
    {
        return $this->hasMany(FaucetClaim::class);
    }

    public function userMinings()
    {
        return $this->hasMany(UserMining::class);
    }

    public function scopeLatestPayments($query, $limit = 10)
    {
        return $query->with(['payments' => function ($q) use ($limit) {
            $q->with('currency')->orderBy('created_at', 'desc')->limit($limit);
        }]);
    }

    public function getBalance(int $currencyId)
    {
        $currency = $this->currencies()
            ->wherePivot('currency_id', $currencyId)
            ->first();

        return $currency ? $currency->pivot->balance : 0;
    }

    public function getBalanceByCoin(string $coinName)
    {
        $currency = $this->currencies()
            ->where('coin', strtoupper($coinName))
            ->first();

        return $currency ? $currency->pivot->balance : 0;
    }

    public function getCurrencyWithBalance(string $coinName)
    {
        return $this->currencies()
            ->where('coin', strtoupper($coinName))
            ->first();
    }

    public function incrementBalance(int $currencyId, float|string $amount): bool
    {
        $userCurrency = $this->currencies()
            ->where('currency_id', $currencyId)
            ->first();

        if ($userCurrency) {
            // Update existing balance using DB increment for atomic operation
            DB::table('currency_users')
                ->where('user_id', $this->id)
                ->where('currency_id', $currencyId)
                ->update([
                    'balance' => DB::raw("balance + {$amount}"),
                    'updated_at' => now(),
                ]);
        } else {
            // Create new currency relation with initial balance
            $this->currencies()->attach($currencyId, [
                'balance' => $amount,
            ]);
        }

        return true;
    }

    public function decrementBalance(int $currencyId, float|string $amount): bool
    {
        $userCurrency = $this->currencies()
            ->where('currency_id', $currencyId)
            ->first();

        if (! $userCurrency) {
            return false; // Currency not found
        }

        $currentBalance = $userCurrency->pivot->balance;

        // Check if sufficient balance
        if (bccomp($currentBalance, $amount, 8) < 0) {
            return false; // Insufficient balance
        }

        // Decrement using DB raw for atomic operation
        DB::table('currency_users')
            ->where('user_id', $this->id)
            ->where('currency_id', $currencyId)
            ->update([
                'balance' => DB::raw("balance - {$amount}"),
                'updated_at' => now(),
            ]);

        return true;
    }

    public function decrementEnergy(int $amount): bool
    {
        // Check if sufficient balance
        if (bccomp($this->energy, $amount) < 0) {
            return false; // Insufficient balance
        }

        // Decrement using DB raw for atomic operation
        DB::table('users')
            ->where('id', $this->id)
            ->update([
                'energy' => DB::raw("energy - {$amount}"),
                'updated_at' => now(),
            ]);

        return true;
    }

    public function expirePlans(): void
    {
        $this->userMinings()
            ->where('claim_time', '<=', time())
            ->update(['status' => 'ended']);
    }
}
