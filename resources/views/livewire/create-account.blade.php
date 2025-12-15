<!-- To create an account -->

<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">

    <h2 class="text-lg font-semibold mb-4">Create New Account</h2>

    @if (session()->has('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="createAccount">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Account Type</label>
            <select wire:model="account_type_id" class="w-full border rounded px-3 py-2">
                <option value="">Select account type</option>
                @foreach ($accountTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('account_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Create Account
        </button>
    </form>
</div>
