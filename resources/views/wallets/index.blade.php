@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Dompet</h1>

@php
    $palette = [
        'bca' => 'bg-blue-500',
        'mandiri' => 'bg-slate-500',
        'bsi' => 'bg-emerald-500',
        'dana' => 'bg-yellow-400',
        'ovo' => 'bg-violet-500',
        'gopay' => 'bg-cyan-500',
        'cash' => 'bg-red-400',
    ];
    $fallback = ['bg-gray-500','bg-gray-400','bg-red-400','bg-yellow-400','bg-indigo-400'];
    $colorFor = function(string $name, int $index) use ($palette, $fallback) {
        $key = strtolower($name);
        foreach ($palette as $pname => $cls) {
            if (str_contains($key, $pname)) {
                return $cls;
            }
        }
        return $fallback[$index % count($fallback)];
    };
@endphp
<div class="flex gap-4 flex-wrap">
    @forelse($wallets as $w)
        <div class="rounded-2xl px-6 py-4 text-white shadow {{ $colorFor($w->name, $loop->index) }}">
            <h2 class="text-sm">{{ $w->name }}</h2>
            <p class="text-lg mt-2">Rp {{ number_format($w->balance, 0, ',', '.') }}</p>
        </div>
    @empty
        <div class="bg-white p-4 rounded-2xl shadow">
            <h2 class="text-gray-500 text-sm">Belum ada dompet</h2>
            <p class="text-lg mt-2">Rp 0</p>
        </div>
    @endforelse

    <div class="bg-gray-200 rounded-2xl px-6 py-4 shadow">
        <form method="POST" action="{{ route('wallets.store') }}" class="space-y-3">
            @csrf
            <p class="text-sm font-medium text-gray-700">Tambah Dompet</p>
            <input type="text" name="name" placeholder="Nama Dompet..." class="w-56 border p-2 rounded bg-gray-50" required>
            <input type="number" name="balance" placeholder="Nominal Awal..." class="w-56 border p-2 rounded bg-gray-50" required>
            <button class="px-4 py-2 bg-yellow-400 text-white rounded-full">Tambah</button>
        </form>
    </div>
</div>
@endsection
