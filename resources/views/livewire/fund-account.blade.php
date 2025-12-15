<!-- The Component That Funds Accounts -->

<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">

    <h2 class="text-lg font-semibold mb-4">Fund Account</h2>

    <form wire:submit.prevent="fund">

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Select Account</label>
            <select wire:model="account_id" class="w-full border rounded px-3 py-2">
                <option value="">Select account</option>
                @foreach ($accounts as $account)
                    <option value="{{ $account->id }}">
                        {{ $account->account_number }}
                    </option>
                @endforeach
            </select>
            @error('account_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Amount</label>
            <input type="number" wire:model="amount" class="w-full border rounded px-3 py-2">
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Fund
        </button>
    </form>
</div>
