<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Support\Facades\Auth;

class AccountsTable extends Component
{
    public $selectedAccountType = '';
    public $selectedFilter = '';

    // Applied filters (used in query to filter accounts table)
    public $accountType = '';
    public $filter = '';

    public $accountTypes = [];

    public function mount()
    {
        $this->accountTypes = AccountType::orderBy('name')->get();
    }

    public function applyFilters()
    {
        $this->accountType = $this->selectedAccountType;
        $this->filter = $this->selectedFilter;
    }

    public function resetFilters()
    {
        $this->selectedAccountType = '';
        $this->selectedFilter = '';
        $this->accountType = '';
        $this->filter = '';
    }

    public function render()
    {
        $accounts = Account::with(['user', 'accountType']) //renders all of the users springco accounts
            ->when($this->filter === 'unassigned', function ($q) {
                $q->whereNull('user_id');
            }, function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->when($this->accountType, function ($q) {
                $q->where('account_type_id', $this->accountType);
            })
            ->latest()
            ->get();

        return view('livewire.dashboard.accounts-table', [
            'accounts' => $accounts,
        ]);
    }
}
