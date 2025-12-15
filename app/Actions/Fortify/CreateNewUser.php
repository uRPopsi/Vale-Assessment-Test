<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */

public function create(array $input)
{
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
    ])->validate();

    $user = User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ]);

    // 🔹 Fetch FLEX account type
    $flexType = AccountType::where('name', 'FLEX')->firstOrFail();

    // Creates FLEX account automatically
    Account::create([
        'user_id' => $user->id,
        'account_type_id' => $flexType->id,
        'account_number' => 'FLEX-' . strtoupper(Str::random(10)),
        'balance' => 0,
        'status' => 'ACTIVE',
    ]);

    return $user;
}
}
