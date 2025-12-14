@extends('layouts.app')

@section('content')

<h1 class="text-[32px] font-semibold mt-0 mb-8">Profit & Loss</h1>

{{-- GRID 3x2 --}}
<div class="grid grid-cols-3 grid-rows-2 gap-6 mb-14 items-stretch">

    {{-- (1) INCOME --}}
    <div class="bg-white rounded-2xl p-6 shadow">
        <p class="flex items-center gap-2 text-sm mb-2">
            <span class="text-green-500 text-lg">▲</span>
            <span class="text-gray-500">Total Income</span>
        </p>
        <p class="text-[22px] font-normal">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>

    </div>

    {{-- (2) EXPENSE --}}
    <div class="bg-white rounded-2xl p-6 shadow">
        <p class="flex items-center gap-2 text-sm mb-2">
            <span class="text-red-500 text-lg">▼</span>
            <span class="text-gray-500">Total Expense</span>
        </p>
        <p class="text-[22px] font-normal">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
    </div>

    {{-- (3 & 6) DONUT (span 2 rows) --}}
    <div class="bg-white rounded-2xl p-6 shadow row-span-2 flex items-center justify-center">
    <div class="relative w-[240px] h-[240px]">
        <canvas id="donutChart"></canvas>

        <!-- TOTAL TENGAH -->
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <p class="text-sm text-gray-400">Total Spending</p>
            <p id="totalSpendingText" class="text-xl font-semibold">
                Rp 0
            </p>
        </div>
    </div>
</div>


    {{-- (4 & 5) BALANCE (span 2 cols) --}}
    <div class="bg-white rounded-2xl p-6 shadow col-span-2">
        <p class="text-gray-500 mb-1">Total Balance</p>
        <p class="text-[34px] font-normal">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
    </div>

</div>

<h2 class="text-[26px] font-semibold mb-8">Spending By Category</h2>

@php
    $food = $spendingData['Food'] ?? 0;
    $transport = $spendingData['Transport'] ?? 0;
    $utilities = $spendingData['Utilities'] ?? 0;
@endphp

<div class="grid grid-cols-3 gap-8">
    <div class="bg-[#4B5C66] text-white rounded-3xl p-10 flex flex-col items-center">
        <p class="text-xl mb-6">Food</p>
        <img src="{{ asset('images/food.png') }}" class="w-24 h-24 mb-6">
        <p class="text-lg">Rp {{ number_format($food, 0, ',', '.') }}</p>
    </div>

    <div class="bg-yellow-400 text-white rounded-3xl p-10 flex flex-col items-center">
        <p class="text-xl mb-6">Transport</p>
        <img src="{{ asset('images/transport.png') }}" class="w-24 h-24 mb-6">
        <p class="text-lg">Rp {{ number_format($transport, 0, ',', '.') }}</p>
    </div>

    <div class="bg-red-400 text-white rounded-3xl p-10 flex flex-col items-center">
        <p class="text-xl mb-6">Utilities</p>
        <img src="{{ asset('images/utilities.png') }}" class="w-24 h-24 mb-6">
        <p class="text-lg">Rp {{ number_format($utilities, 0, ',', '.') }}</p>
    </div>
</div>

<script>
    const spendingData = @json($spendingData);

    const totalSpending = Object.values(spendingData)
        .reduce((sum, value) => sum + value, 0);

    const formatRupiah = (number) => {
        return 'Rp ' + number.toLocaleString('id-ID');
    };
</script>


{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('donutChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(spendingData),
            datasets: [{
                data: Object.values(spendingData),
                backgroundColor: [
                    '#4B5C66', // Food
                    '#FACC15', // Transport
                    '#EF4444'  // Utilities
                ],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Tampilkan total di tengah grafik
    document.getElementById('totalSpendingText').innerText =
        formatRupiah(totalSpending);
</script>


@endsection
