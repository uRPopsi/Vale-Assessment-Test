<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'account_id',
        'transaction_type',
        'amount',
        'balance_before',
        'balance_after',
        'reference',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

