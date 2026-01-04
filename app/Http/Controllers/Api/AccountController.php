<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index()
    {
        return auth()->user()->accounts()->with('accountType')->get();
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->accounts()->count() >= 5) {
            return response()->json(['message' => 'Max 5 accounts allowed'], 422);
        }

        $request->validate([
            'account_type_id' => 'required|exists:account_types,id',
        ]);

        $account = Account::create([
            'user_id' => $user->id,
            'account_type_id' => $request->account_type_id,
            'account_number' => strtoupper(Str::random(12)),
            'balance' => 0,
            'status' => 'ACTIVE',
        ]);

        return response()->json($account, 201);
    }

    public function interest(Account $account)
    {
        if ($account->user_id !== auth()->id()) {
    return response()->json(['message' => 'Unauthorized'], 403);
}

        if ($account->balance < 20000) {
            return response()->json(['interest' => 0]);
        }

        $rate = $account->accountType->interest_rate;
        $interest = ($rate / 100) * $account->balance;

        return response()->json([
            'interest' => round($interest, 2),
        ]);
    }
}

