<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // User
    Route::get('/me', fn () => auth()->user());

    // Accounts
    Route::get('/accounts', [AccountController::class, 'index']);
    Route::post('/accounts', [AccountController::class, 'store']);

    // Transactions
    Route::post('/accounts/{account}/fund', [TransactionController::class, 'fund']);
    Route::post('/accounts/{account}/withdraw', [TransactionController::class, 'withdraw']);

    // Interest
    Route::get('/accounts/{account}/interest', [AccountController::class, 'interest']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
