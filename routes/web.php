<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest:web')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])
        ->name('login.create');
    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store')
        ->middleware('throttle:60,1');

    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store')
        ->middleware('throttle:60,1');
});
