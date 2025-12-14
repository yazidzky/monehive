@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-[28px] font-semibold">Transaction</h1>
        <a href="{{ route('transactions.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-yellow-400 text-white shadow">
            + Add Transaction
        </a>
    </div>

<div class="grid grid-cols-3 gap-6 mb-6 items-center">
    <div class="bg-white rounded-2xl p-5 shadow flex flex-col justify-center min-h-[100px]">
        <p class="flex items-center gap-2 text-sm mb-2">
            <span class="text-green-500 text-lg">▲</span>
            <span class="text-gray-500">Total Income</span>
        </p>
        <p class="text-[20px] font-medium truncate">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow flex flex-col justify-center min-h-[100px]">
        <p class="flex items-center gap-2 text-sm mb-2">
            <span class="text-red-500 text-lg">▼</span>
            <span class="text-gray-500">Total Expense</span>
        </p>
        <p class="text-[20px] font-medium truncate">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
    </div>
    @php $balanceClass = ($totalIncome - $totalExpense) < 0 ? 'text-red-600' : 'text-gray-900'; @endphp
    <div class="bg-white rounded-2xl p-5 shadow flex flex-col justify-center min-h-[100px]">
        <p class="text-gray-500 text-sm mb-2">Total Balance</p>
        <p class="text-[20px] font-medium {{ $balanceClass }} truncate">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
    </div>
    </div>

<div class="bg-white shadow rounded-2xl overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 text-left text-sm">
            <tr>
                <th class="p-4">Date</th>
                <th class="p-4">Category</th>
                <th class="p-4">Wallet</th>
                <th class="p-4">Amount</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($transactions as $t)
            <tr class="border-b">
                <td class="p-4">{{ $t->occurred_at->format('Y-m-d') }}</td>
                <td class="p-4">{{ $t->category->name }}</td>
                <td class="p-4">{{ $t->wallet->name }}</td>
                <td class="p-4 {{ $t->type === 'expense' ? 'text-red-600' : 'text-green-600' }}">
                    {{ $t->type === 'expense' ? '-' : '+' }} Rp {{ number_format($t->amount, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
@endsection
