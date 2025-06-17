<?php

use App\Models\Unit;
use App\Models\Customer;
use App\Models\UnitGroup;

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Ambil semua unit lengkap dengan unit group dan customer-nya
        $units = Unit::with('unitGroup', 'customers')->get();

        // Ambil customer berdasarkan role
        $customers = $user->role === 'marketing'
            ? Customer::where('user_id', $user->id)->get()
            : Customer::all();

        return view('dashboard', [
            'user' => $user,
            'units' => $units,
            'unit_groups' => $units->pluck('unitGroup')->unique('id')->values(), // hanya grup unik
            'customers' => $customers,
            'customers_model' => Customer::class,
        ]);
    })->name('dashboard');

    Route::get('/marketing', [AccountController::class, 'listMarketing'])->name('marketing');
    Route::get('/marketing/create', [AccountController::class, 'indexMarketing'])->name('marketing.create');
    Route::post('/marketing/store', [AccountController::class, 'storeMarketing'])->name('marketing.store');

    Route::middleware(CheckRole::class . ':admin')->group(function () {
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

    Route::post('/customer/change/status/booking/{id}', [CustomerController::class, 'changeStatusBooking'])->name('customers.change.booking');
    Route::post('/customer/change/status/dp/{id}', [CustomerController::class, 'changeStatusDP'])->name('customers.change.dp');

    Route::post('/customer/approve/{id}', [CustomerController::class, 'validateCustomer'])->name('customers.approve');


});
