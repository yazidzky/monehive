<?php
/**
 * File Route Utama (Web)
 * Mendefinisikan route untuk halaman web yang diakses user melalui browser.
 * Berisi route untuk halaman publik, dashboard, dan manajemen fitur (transaksi, dompet, budget).
 */

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Halaman Utama (Frontend)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Frontend + Backend Data)
// Middleware 'auth' memastikan hanya user yang login yang bisa akses (Autentifikasi)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Halaman Profil (hanya view static)
Route::view('/profile', 'profile')->middleware(['auth'])->name('profile');

// Breeze Profile routes (Fitur bawaan untuk edit profil)
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Transaksi (Webservice Logic / CRUD)
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index'); // Lihat daftar
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create'); // Form tambah
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store'); // Simpan data (Backend)
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


require __DIR__ . '/auth.php';
