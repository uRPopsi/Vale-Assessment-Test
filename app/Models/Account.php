<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Account extends Model
{
    protected $fillable = [
        'user_id',
        'account_type_id',
        'account_number',
        'balance',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function interestHistory(): HasMany
    {
        return $this->hasMany(InterestHistory::class);
    }

    public function credit(float $amount): void
{
    DB::transaction(function () use ($amount) {
        $before = $this->balance;
        $after  = $before + $amount;

        $this->update(['balance' => $after]);

        $this->transactions()->create([
            'transaction_type' => 'CREDIT',
            'amount'           => $amount,
            'balance_before'   => $before,
            'balance_after'    => $after,
            'reference'        => 'CR-' . strtoupper(Str::random(10)),
        ]);
    });
}

public function debit(float $amount): bool
{
    if ($this->balance < $amount) {
        return false;
    }

    DB::transaction(function () use ($amount) {
        $before = $this->balance;
        $after  = $before - $amount;

        $this->update(['balance' => $after]);

        $this->transactions()->create([
            'transaction_type' => 'DEBIT',
            'amount'           => $amount,
            'balance_before'   => $before,
            'balance_after'    => $after,
            'reference'        => 'DR-' . strtoupper(Str::random(10)),
        ]);
    });

    return true;
}

}
