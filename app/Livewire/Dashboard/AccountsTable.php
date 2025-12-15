<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Support\Facades\Auth;

class AccountsTable extends Component
{
    public $accountType = '';
    public $accountTypes;

    public function mount()
    {
        // Loads all account types dynamically (FLEX, DELUXE, etc.)
        $this->accountTypes = AccountType::orderBy('name')->get();
    }

    public function render()
    {
        $accounts = Account::where('user_id', Auth::id())
            ->with('type')
            ->when($this->accountType, function ($query) {
                $query->where('account_type_id', $this->accountType);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.dashboard.accounts-table', [
            'accounts' => $accounts
        ]);
    }
}
