<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::view('/profile', 'profile')->middleware(['auth'])->name('profile');

// Breeze Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Transaksi
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
});

// Dompet
Route::get('/wallets', [WalletController::class, 'index'])
    ->middleware(['auth'])->name('wallets.index');
Route::post('/wallets', [WalletController::class, 'store'])
    ->middleware(['auth'])->name('wallets.store');

// Budget
Route::get('/budgets', [BudgetController::class, 'index'])
    ->middleware(['auth'])->name('budgets.index');
Route::post('/categories', [CategoryController::class, 'store'])
    ->middleware(['auth'])->name('categories.store');

Route::view('/change-password', 'password.change')
    ->middleware(['auth'])->name('password.change');


require __DIR__.'/auth.php';
