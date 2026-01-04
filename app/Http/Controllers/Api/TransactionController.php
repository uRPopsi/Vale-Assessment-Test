<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function fund(Request $request, Account $account)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);

        $account->credit($request->amount);

        return response()->json(['message' => 'Account funded']);
    }

    public function withdraw(Request $request, Account $account)
    {
        $request->validate(['amount' => 'required|numeric|min:1']);

        if (! $account->debit($request->amount)) {
            return response()->json(['message' => 'Insufficient balance'], 422);
        }

        return response()->json(['message' => 'Withdrawal successful']);
    }
}

