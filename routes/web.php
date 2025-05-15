<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/marketing/create', [AccountController::class, 'indexMarketing'])->name('marketing.create');
    Route::post('/marketing/store', [AccountController::class, 'storeMarketing'])->name('marketing.store');
    Route::get('/referral/create', [AccountController::class, 'indexReferral'])->name('referral.create');
    Route::post('/referral/store', [AccountController::class, 'storeReferral'])->name('referral.store');
});
