<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $income = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');
        $expense = Transaction::where('user_id', $user->id)->where('type', 'expense')->sum('amount');
        $balance = Wallet::where('user_id', $user->id)->sum('balance');

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

        return view('dashboard', [
            'totalIncome' => (float) $income,
            'totalExpense' => (float) $expense,
            'totalBalance' => (float) $balance,
            'spendingData' => $byCategory,
        ]);
    }
}

