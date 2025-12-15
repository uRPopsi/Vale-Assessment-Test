<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    // ✅ Fields that can be mass-assigned
    protected $fillable = [
        'user_id',
        'account_type_id',
        'account_number',
        'balance',
        'status',
    ];

    // ✅ Casts
    protected $casts = [
        'balance' => 'decimal:2',
    ];

    // ---------------------------
    // Relationships
    // ---------------------------

    /**
     * The user who owns this account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The account type (FLEX, DELUXE, etc.)
     */
    public function type()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }

    /**
     * Transactions for this account
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Optional: Interest history
     */
    public function interestHistory()
    {
        return $this->hasMany(InterestHistory::class);
    }

    /**
     * Credit account
     */
    public function credit($amount)
    {
        $this->balance += $amount;
        $this->save();
    }

    /**
     * Debit account (returns false if insufficient)
     */
    public function debit($amount)
    {
        if (!$this->hasSufficientBalance($amount)) {
            return false;
        }

        $this->balance -= $amount;
        $this->save();

        return true;
    }
}
