<!-- The Component That Displays Each Accounts Interest Rate Based On Their Current Amount -->
 
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-xl font-semibold mb-4">Account Interest Overview</h2>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-left">Account</th>
                <th class="border p-2 text-left">Balance (₦)</th>
                <th class="border p-2 text-left">Interest Rate (%)</th>
                <th class="border p-2 text-left">Interest Amount (₦)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($accounts as $account)
                <tr>
                    <td class="border p-2">
                        {{ $account->accountType->name }} — {{ $account->account_number }}
                    </td>
                    <td class="border p-2">
                        {{ number_format($account->balance, 2) }}
                    </td>
                    <td class="border p-2">
                        {{ $account->accountType->interest_rate }}
                    </td>
                    <td class="border p-2">
                        {{ number_format($account->calculated_interest, 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border p-4 text-center text-gray-500">
                        No accounts found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="mt-4 text-sm text-gray-600">
        * Interest is calculated only for accounts with a minimum balance of ₦20,000.
    </p>
</div>
