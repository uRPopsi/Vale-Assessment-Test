<!-- The Component For Account Withdrawal -->

<div class="max-w-xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-xl font-semibold mb-4">Withdraw Funds</h2>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="withdraw" class="space-y-4">

        <div>
            <label class="block text-sm font-medium mb-1">Select Account</label>
            <select wire:model="account_id" class="w-full border rounded p-2">
                <option value="">-- Select Account --</option>
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}">
                        {{ $account->accountType->name }} — {{ $account->account_number }}
                    </option>
                @endforeach
            </select>
            @error('account_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        @if (!is_null($currentBalance))
            <div class="text-sm text-gray-700">
                Current Balance: <strong>₦{{ number_format($currentBalance, 2) }}</strong>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium mb-1">Amount to Withdraw</label>
            <input type="number" wire:model="amount" class="w-full border rounded p-2" />
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">
            Withdraw
        </button>
    </form>
</div>
