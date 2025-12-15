<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class ViewInterest extends Component
{
    public $accounts;

    public function mount() //function to mount the view interest view (to display it)
    {
        $this->accounts = Account::with('accountType')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($account) {
                $rate = $account->accountType->interest_rate;
                $min  = $account->accountType->min_balance;

                $interest = $account->balance >= $min
                    ? ($account->balance * $rate) / 100
                    : 0;

                $account->calculated_interest = $interest;

                return $account;
            });
    }

    public function render() //to redner the view interest view
{
    return view('livewire.view-interest')
        ->layout('layouts.app');
}
}
