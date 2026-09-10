<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'currency_id', 'amount', 'status', 'transaction_id'])]
class Payment extends Model
{
    protected $casts = [
        'amount' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function latestPayments($limit = 10)
    {
        return self::with('user', 'currency')->success()->latest()->take($limit)->get();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
}
