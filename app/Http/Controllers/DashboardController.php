<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman Dashboard utama.
     * Mengumpulkan ringkasan data keuangan user.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Mengambil total pemasukan, pengeluaran, dan saldo dompet
        $income = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');
        $expense = Transaction::where('user_id', $user->id)->where('type', 'expense')->sum('amount');
        $balance = Wallet::where('user_id', $user->id)->sum('balance');

        // Data spending per kategori untuk Chart (Visualisasi)
        $byCategory = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category:id,name')
            ->get()
            ->mapWithKeys(function ($row) {
                return [$row->category->name => (float) $row->total];
            })
            ->toArray();

        // Kirim data ke View Dashboard
        return view('dashboard', [
            'totalIncome' => (float) $income,
            'totalExpense' => (float) $expense,
            'totalBalance' => (float) $balance,
            'spendingData' => $byCategory,
        ]);
    }
}

