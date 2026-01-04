<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\WithdrawAccount;
use App\Livewire\ViewInterest;

Route::get('/', function () {
    return view('auth.register');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/create-account', fn () => view('create-account'))->name('create-account');

    Route::get('/fund', fn () => view('fund-account'));

    Route::get('/withdraw', WithdrawAccount::class)->name('withdraw');

    Route::get('/interest', ViewInterest::class)->name('interest');
});
