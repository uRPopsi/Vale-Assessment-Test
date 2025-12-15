<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { //User will enter the sign up page upon visiting the root URL
    return view('auth.register');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// route to go to the create an account page
Route::middleware(['auth'])->group(function () {
    Route::get('/create-account', function () {
        return view('create-account');
    })->name('create-account');
});

// route to go to the funding account page
Route::get('/fund', function () {
    return view('fund-account');
})->middleware('auth');
