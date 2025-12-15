<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi pengguna.
     * Bagian ini menangani logika Backend untuk halaman riwayat transaksi.
     */
    public function index(): View
    {
        // Mengambil data user yang sedang login (Autentifikasi)
        $user = Auth::user();

        // Mengambil data transaksi dari Database dengan relasi kategori dan dompet
        // Webservice / Query logic ada di sini
        $transactions = Transaction::with(['category', 'wallet'])
            ->where('user_id', $user->id)
            ->orderByDesc('occurred_at') // Urutkan dari yang terbaru
            ->paginate(10); // Pagination 10 item per halaman

        // Menghitung total pemasukan, pengeluaran, dan saldo
        $totalIncome = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('user_id', $user->id)->where('type', 'expense')->sum('amount');
        $totalBalance = Wallet::where('user_id', $user->id)->sum('balance');

        // Mengirim data ke Frontend (View)
        return view('transactions.index', [
            'transactions' => $transactions,
            'totalIncome' => (float) $totalIncome,
            'totalExpense' => (float) $totalExpense,
            'totalBalance' => (float) $totalBalance,
        ]);
    }

    /**
     * Menampilkan form untuk membuat transaksi baru.
     * Mengelola data kategori dan dompet untuk ditampilkan di Frontend.
     */
    public function create(): View
    {
        $user = Auth::user();

        // Mengambil daftar kategori dan wallet dari Database
        $categories = Category::where('user_id', $user->id)->orderBy('name')->get();
        $wallets = Wallet::where('user_id', $user->id)->orderBy('name')->get();

        // Logic otomatis: Buat wallet default jika belum ada (Backend logic)
        if ($wallets->count() === 0) {
            $wallets = collect([
                Wallet::create(['user_id' => $user->id, 'name' => 'Cash', 'balance' => 0]),
            ]);
        }

        // Logic otomatis: Buat kategori default jika belum ada
        if ($categories->count() === 0) {
            $categories = collect([
                Category::create(['user_id' => $user->id, 'name' => 'Salary', 'type' => 'income']),
                Category::create(['user_id' => $user->id, 'name' => 'Food', 'type' => 'expense']),
                Category::create(['user_id' => $user->id, 'name' => 'Transport', 'type' => 'expense']),
            ]);
        }

        return view('transactions.create', [
            'categories' => $categories,
            'wallets' => $wallets,
        ]);
    }

    /**
     * Menyimpan data transaksi baru ke Database.
     * Menghandle validasi input dan update saldo wallet.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validasi input dari Frontend
        $validated = $request->validate([
            'type' => ['required', 'in:income,expense'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'category_id' => ['required', 'exists:categories,id'],
            'wallet_id' => ['required', 'exists:wallets,id'],
            'date' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        // Menyimpan data transaksi (Backend -> Database)
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'wallet_id' => $validated['wallet_id'],
            'category_id' => $validated['category_id'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'occurred_at' => $validated['date'],
            'note' => $validated['note'] ?? null,
        ]);

        // Mengambil data wallet dan update saldo
        $wallet = Wallet::where('id', $validated['wallet_id'])->where('user_id', $user->id)->firstOrFail();

        // Logika update saldo berdasarkan tipe transaksi
        if ($validated['type'] === 'income') {
            $wallet->balance = $wallet->balance + $validated['amount'];
        } else {
            $wallet->balance = $wallet->balance - $validated['amount'];
        }

        $wallet->save();

        // Redirect kembali ke halaman index
        return redirect()->route('transactions.index')->with('status', 'Transaksi tersimpan');
    }
}
