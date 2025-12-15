<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WithdrawAccount extends Component
{
    public $account_id;
    public $amount;
    public $accounts;
    public $currentBalance = null;

    protected $rules = [
        'account_id' => 'required|exists:accounts,id',
        'amount' => 'required|numeric|min:1',
    ];

    public function mount() //function to display that particular accounts balance
    {
        $this->accounts = Account::with('accountType')
            ->where('user_id', Auth::id())
            ->get();
    }

    public function updatedAccountId() //function to update the account balance
    {
        $account = Account::where('id', $this->account_id)
            ->where('user_id', Auth::id())
            ->first();

        $this->currentBalance = $account?->balance;
    }

    public function withdraw() //function to withdraw from a selected account
    {
        $this->validate();

        $account = Account::where('id', $this->account_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($this->amount > $account->balance) {
            $this->addError(
                'amount',
                'Insufficient balance for this withdrawal.'
            );
            return;
        }

        $before = $account->balance;
        $after  = $before - $this->amount;

        $account->update(['balance' => $after]);

        Transaction::create([ //to store the transaction record in the database
            'account_id'       => $account->id,
            'transaction_type' => 'DEBIT',
            'amount'           => $this->amount,
            'balance_before'   => $before,
            'balance_after'    => $after,
            'reference'        => 'WD-' . strtoupper(Str::random(10)),
        ]);

        session()->flash('success', 'Withdrawal successful.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.withdraw-account')
            ->layout('layouts.app');
    }
}
