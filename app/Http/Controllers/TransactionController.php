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
    public function index(): View
    {
        $user = Auth::user();
        $transactions = Transaction::with(['category', 'wallet'])
            ->where('user_id', $user->id)
            ->orderByDesc('occurred_at')
            ->paginate(10);

        $totalIncome = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('user_id', $user->id)->where('type', 'expense')->sum('amount');
        $totalBalance = Wallet::where('user_id', $user->id)->sum('balance');

        return view('transactions.index', [
            'transactions' => $transactions,
            'totalIncome' => (float) $totalIncome,
            'totalExpense' => (float) $totalExpense,
            'totalBalance' => (float) $totalBalance,
        ]);
    }

    public function create(): View
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)->orderBy('name')->get();
        $wallets = Wallet::where('user_id', $user->id)->orderBy('name')->get();

        if ($wallets->count() === 0) {
            $wallets = collect([
                Wallet::create(['user_id' => $user->id, 'name' => 'Cash', 'balance' => 0]),
            ]);
        }

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

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'type' => ['required', 'in:income,expense'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'category_id' => ['required', 'exists:categories,id'],
            'wallet_id' => ['required', 'exists:wallets,id'],
            'date' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'wallet_id' => $validated['wallet_id'],
            'category_id' => $validated['category_id'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'occurred_at' => $validated['date'],
            'note' => $validated['note'] ?? null,
        ]);

        $wallet = Wallet::where('id', $validated['wallet_id'])->where('user_id', $user->id)->firstOrFail();

        if ($validated['type'] === 'income') {
            $wallet->balance = $wallet->balance + $validated['amount'];
        } else {
            $wallet->balance = $wallet->balance - $validated['amount'];
        }

        $wallet->save();

        return redirect()->route('transactions.index')->with('status', 'Transaksi tersimpan');
    }
}
