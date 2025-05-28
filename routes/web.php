<?php

use App\Http\Controllers\CustomerController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AccountController;
use App\Http\Middleware\CheckRole;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');

    Route::middleware(CheckRole::class . ':admin')->group(function () {
        Route::get('/marketing', [AccountController::class, 'listMarketing'])->name('marketing');
        Route::get('/marketing/create', [AccountController::class, 'indexMarketing'])->name('marketing.create');
        Route::post('/marketing/store', [AccountController::class, 'storeMarketing'])->name('marketing.store');
        /* TODO: Delete this */
        /* Route::get('/referral', [AccountController::class, 'listReferral'])->name('referral'); */
        /* Route::get('/referral/create', [AccountController::class, 'indexReferral'])->name('referral.create'); */
        /* Route::post('/referral/store', [AccountController::class, 'storeReferral'])->name('referral.store'); */
    });
    Route::get('/unit-group', [UnitController::class, 'index'])->name('unit-group.index');
    Route::get('/unit/{unitGroupId}', [UnitController::class, 'indexUnit'])->name('unit.index');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/customer/detail/{id}', [CustomerController::class, 'show'])->name('customer.detail');
    Route::get('/api/unit-groups/{id}/units', [CustomerController::class, 'getUnits']);


});
