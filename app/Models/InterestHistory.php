<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestHistory extends Model
{
    protected $fillable = [
        'account_id',
        'interest_rate',
        'interest_amount',
        'balance_at_calculation',
        'calculated_at',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

