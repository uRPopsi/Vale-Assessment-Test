<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountType;

class AccountTypeSeeder extends Seeder
{
    public function run() //seeder function that will autocreate a table containing the 5 different types of accounts
    {
        $types = [
            ['name' => 'FLEX',   'interest_rate' => 2.5, 'min_balance' => 20000],
            ['name' => 'DELUXE', 'interest_rate' => 3.5, 'min_balance' => 20000],
            ['name' => 'VIVA',   'interest_rate' => 6.0, 'min_balance' => 20000],
            ['name' => 'PIGGY',  'interest_rate' => 9.2, 'min_balance' => 20000],
            ['name' => 'SUPA',   'interest_rate' => 10.0,'min_balance' => 20000],
        ];

        foreach ($types as $type) {
            AccountType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
