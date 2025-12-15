<!-- Accounts Table Blade View -->
<div class="p-6">

    <!-- Top Controls -->
<div class="flex items-center justify-between mb-6">

    <!-- Filters -->
    <div class="flex space-x-3 items-center">

        <!-- Account Type -->
        <select
            wire:model="selectedAccountType"
            class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option value="">All Account Types</option>
            @foreach ($accountTypes as $type)
                <option value="{{ $type->id }}">
                    {{ $type->name }}
                </option>
            @endforeach
        </select>

        <!-- Customer Filter -->
        <select
            wire:model="selectedFilter"
            class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option value="">All Records</option>
            <option value="unassigned">Accounts Without Customer</option>
        </select>

        <!-- Apply Button -->
        <button
            wire:click="applyFilters"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium"
        >
            Filter
        </button>

        <!-- Reset Button -->
        <button
            wire:click="resetFilters"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium"
        >
            Reset
        </button>

        <!-- Create Account -->
        <a href="/create-account"
           class="bg-green-700 hover:bg-green-900 text-white px-4 py-2 rounded-md text-sm font-medium">
            Create Account
        </a>
    </div>

    <!-- Action Buttons -->
    <div class="flex space-x-3">
        <a href="/fund"
           class="bg-green-400 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
            Fund
        </a>

        <a href="/withdraw"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
            Withdraw
        </a>

        <a href="/interest"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
            View Interest
        </a>
    </div>
</div>

    <!-- Accounts Table Itself-->
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Account Number</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Balance</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Created At</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($accounts as $account)
                    <tr>
                        <td class="px-6 py-4 text-sm">
                            {{ $account->account_number }}
                        </td>

                        <td class="px-6 py-4 text-sm font-medium">
                            ₦{{ number_format($account->balance, 2) }}
                        </td>

                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $account->status === 'ACTIVE'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ $account->status }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $account->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No accounts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
