<?php

namespace App\Livewire;

// app/Http/Livewire/CreateAccount.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateAccount extends Component
{
    public $account_type_id;
    public $accountTypes;

    public function mount()
    {
        $this->accountTypes = AccountType::orderBy('name')->get();
    }

    public function createAccount()
    {
        $user = Auth::user();

        if ($user->accounts()->count() >= 5) {
            session()->flash('error', 'You cannot have more than 5 accounts.');
            return;
        }

        $this->validate([
            'account_type_id' => 'required|exists:account_types,id',
        ]);

        Account::create([
            'user_id' => $user->id,
            'account_type_id' => $this->account_type_id,
            'account_number' => strtoupper(Str::random(12)),
            'balance' => 0,
            'status' => 'ACTIVE',
        ]);

        session()->flash('success', 'Account created successfully.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.create-account');
    }
}
