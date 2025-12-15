<?php

namespace App\Livewire;

// app/Http/Livewire/CreateAccount.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CreateAccount extends Component
{
    public $account_type_id;
    public $accountTypes;

    public function mount()
    {
        $this->accountTypes = AccountType::orderBy('name')->get();
    }

public function createAccount() //function to create a new account for the user
{
    $user = Auth::user();

    if ($user->accounts()->count() >= 5) {
        session()->flash('error', 'You cannot have more than 5 accounts.');
        return;
    }

    $this->validate([
        'account_type_id' => 'required|exists:account_types,id',
    ]);

    // Prevent duplicate account types
    if ($user->accounts()->where('account_type_id', $this->account_type_id)->exists()) {
        session()->flash('error', 'You already have this account type.');
        return;
    }

    DB::transaction(function () use ($user) {
        $type = AccountType::findOrFail($this->account_type_id);

        Account::create([ //Send the record to the database
            'user_id' => $user->id,
            'account_type_id' => $type->id,
            'account_number' => $type->name . '-' . strtoupper(Str::random(10)),
            'balance' => 0,
            'status' => 'ACTIVE',
        ]);
    });

    session()->flash('success', 'Account created successfully.'); //Success message

    return redirect()->route('dashboard');
}

    public function render() //function to render the create account view
    {
        return view('livewire.create-account');
    }
}
