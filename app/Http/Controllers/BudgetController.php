<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BudgetController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $month = (int) date('n');
        $year = (int) date('Y');

        $expenseByCategory = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereMonth('occurred_at', $month)
            ->whereYear('occurred_at', $year)
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category:id,name')
            ->get();

        $totalExpense = (float) $expenseByCategory->sum('total');

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
