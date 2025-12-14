@extends('layouts.app')

@section('content')
<h1 class="text-[28px] font-semibold mb-6">Add Transaction</h1>

<form action="{{ route('transactions.store') }}" method="POST" class="bg-white p-6 rounded-2xl shadow w-full max-w-lg">
    @csrf

    <label class="block mb-2 text-sm font-medium">Type</label>
    <select name="type" class="w-full border p-3 rounded mb-4">
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-2 text-sm font-medium">Amount</label>
            <input type="number" name="amount" class="w-full border p-3 rounded mb-4">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium">Category</label>
            <select name="category_id" class="w-full border p-3 rounded mb-4">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block mb-2 text-sm font-medium">Wallet</label>
            <select name="wallet_id" class="w-full border p-3 rounded mb-4">
                @foreach($wallets as $w)
                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium">Date</label>
            <input type="date" name="date" class="w-full border p-3 rounded mb-4">
        </div>
    </div>

    <label class="block mb-2 text-sm font-medium">Notes</label>
    <textarea name="note" class="w-full border p-3 rounded mb-6"></textarea>

    <div class="flex gap-3">
        <button class="px-5 py-2 bg-yellow-400 text-white rounded-full">Save Transaction</button>
        <a href="{{ route('transactions.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 rounded-full">Cancel</a>
    </div>
</form>
@endsection
