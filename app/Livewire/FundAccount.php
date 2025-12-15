<?php

// app/Http/Livewire/FundAccount.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FundAccount extends Component
{
    public $account_id;
    public $amount;
    public $accounts;

    public function mount()
    {
        $this->accounts = Account::where('user_id', Auth::id())->get();
    }

public function fund() //function to fund a selected account
{
    $this->validate([
        'account_id' => 'required|exists:accounts,id',
        'amount' => 'required|numeric|min:1',
    ]);

    DB::transaction(function () { //send the record to the database
        $account = Account::where('id', $this->account_id)
            ->where('user_id', Auth::id())
            ->where('status', 'ACTIVE')
            ->lockForUpdate()
            ->firstOrFail();

        $before = $account->balance;
        $after = $before + $this->amount;

        $account->update(['balance' => $after]);

        $account->transactions()->create([
            'transaction_type' => 'CREDIT',
            'amount' => $this->amount,
            'balance_before' => $before,
            'balance_after' => $after,
            'reference' => 'FUND-' . strtoupper(Str::random(12)),
        ]);
    });

    session()->flash('success', 'Account funded successfully.'); //success message

    return redirect()->route('dashboard');
}


    public function render() //to render the fund account view
    {
        return view('livewire.fund-account');
    }
}
