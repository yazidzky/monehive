<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BudgetController extends Controller
{
    /**
     * Menampilkan daftar anggaran (Budget) dan realisasi pengeluaran per kategori.
     * Mengambil data transaksi bulan ini dan membandingkannya dengan kategori.
     */
    public function index(): View
    {
        // 1. Ambil user yang login (Autentifikasi)
        $user = Auth::user();
        $month = (int) date('n');
        $year = (int) date('Y');

        // 2. Query untuk menghitung total pengeluaran per kategori bulan ini
        // (Database Aggregation)
        $expenseByCategory = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereMonth('occurred_at', $month)
            ->whereYear('occurred_at', $year)
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category:id,name') // Eager loading relasi kategori
            ->get();

        // 3. Hitung total semua pengeluaran
        $totalExpense = (float) $expenseByCategory->sum('total');

        // 4. Map data untuk dioper ke View (Frontend)
        // Menghitung persentase kontribusi per kategori
        $items = $expenseByCategory->map(function ($row) use ($totalExpense) {
            $percent = $totalExpense > 0 ? min(100, round(((float) $row->total / $totalExpense) * 100)) : 0;
            return [
                'name' => $row->category->name,
                'percent' => $percent,
            ];
        });

        return view('budgets.index', [
            'budgetItems' => $items,
            'month' => $month,
            'year' => $year,
        ]);
    }
}
