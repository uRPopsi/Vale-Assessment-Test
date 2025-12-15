<?php

// app/Http/Livewire/FundAccount.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FundAccount extends Component
{
    public $account_id;
    public $amount;
    public $accounts;

    public function mount()
    {
        $this->accounts = Account::where('user_id', Auth::id())->get();
    }

    public function fund()
    {
        $this->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $account = Account::where('id', $this->account_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $before = $account->balance;
        $after = $before + $this->amount;

        $account->update(['balance' => $after]);

        Transaction::create([
            'account_id' => $account->id,
            'transaction_type' => 'CREDIT',
            'amount' => $this->amount,
            'balance_before' => $before,
            'balance_after' => $after,
            'reference' => 'FUND-' . strtoupper(Str::random(10)),
        ]);

        session()->flash('success', 'Account funded successfully.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.fund-account');
    }
}
