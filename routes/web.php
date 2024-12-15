<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShowDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:web')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store')
        ->middleware('throttle:60,1');

    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store')
        ->middleware('throttle:60,1');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('/', ShowDashboardController::class)->name('dashboard');

    Route::resource('records', RecordController::class);
});
