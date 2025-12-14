@extends('layouts.app')

@section('content')
<div x-data="{ open:false }" class="mb-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-[28px] font-semibold">Budget</h1>
        <button @click="open = !open" type="button" class="px-5 py-2 bg-yellow-400 text-white rounded-full">+ Add Categories</button>
    </div>

    <div x-show="open" x-cloak class="bg-white p-4 rounded shadow w-full max-w-lg mb-4">
        <form method="POST" action="{{ route('categories.store') }}" class="grid grid-cols-1 gap-4">
            @csrf
            <input type="text" name="name" placeholder="Category name" class="border p-2 rounded" required>
            <div class="flex gap-3">
                <button class="px-4 py-2 bg-yellow-400 text-white rounded-full">Add</button>
                <button type="button" @click="open=false" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full">Cancel</button>
            </div>
        </form>
    </div>
</div>
<p class="font-semibold mb-2">Categories</p>
@forelse($budgetItems as $item)
    <div class="bg-white p-6 rounded shadow w-full max-w-lg mb-4">
        <div class="flex items-center justify-between mb-2">
            <h2 class="font-semibold">{{ $item['name'] }}</h2>
            <p class="text-sm text-gray-600">{{ $item['percent'] }}%</p>
        </div>
        <div class="w-full bg-gray-200 h-3 rounded">
            <div class="h-3 rounded bg-yellow-400" style="width: {{ $item['percent'] }}%"></div>
        </div>
    </div>
@empty
    <p class="text-gray-500">Belum ada budget untuk bulan ini.</p>
@endforelse
@endsection
