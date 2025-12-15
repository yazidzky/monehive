<!DOCTYPE html>
{{--
Layout Utama Aplikasi (Authenticated)
Layout ini digunakan untuk halaman-halaman yang membutuhkan login.
Struktur:
1. Header (Logo & Branding)
2. Sidebar (Navigasi Utama)
3. Main Content (Konten Dinamis)
--}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MoneHive</title>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] {
            display: none !important
        }
    </style>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-[Poppins] bg-gray-50">

    {{-- HEADER UTAMA --}}
    <header class="h-20 flex items-center px-8 bg-white">
        <div class="flex items-center">
            {{-- Logo Aplikasi --}}
            <img src="{{ asset('images/logo-m.png') }}" class="w-[60px] h-[60px]" alt="Logo">

            <span class="text-2xl font-semibold text-gray-900 -ml-2">
                oneHive
            </span>
        </div>
    </header>


    <div class="flex gap-6 px-6 pb-6">

        {{-- SIDEBAR --}}
        <aside class="w-[280px] bg-yellow-400 rounded-[40px] flex flex-col pt-6 pb-8 relative z-20">


            {{-- TOP --}}
            <div>

                {{-- MENU --}}
                <nav class="space-y-4 px-6 text-white font-medium">

                    <!-- DASHBOARD -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl
   {{ request()->routeIs('dashboard')
    ? 'bg-white text-yellow-500'
    : 'text-white hover:bg-yellow-300' }}">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10" />
                        </svg>

                        Dashboard
                    </a>


                    <!-- TRANSACTION -->
                    <a href="{{ route('transactions.index') }}"
                        class="flex items-center gap-4 px-5 py-4 rounded-2xl {{ request()->routeIs('transactions.index') ? 'bg-white text-yellow-500' : 'text-white hover:bg-yellow-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7h13M8 12h13M8 17h13M3 7h.01M3 12h.01M3 17h.01" />
                        </svg>
                        Transaction
                    </a>

                    <!-- TRANSACTION CREATE -->
                    <a href="{{ route('transactions.create') }}"
                        class="flex items-center gap-4 px-5 py-4 rounded-2xl {{ request()->routeIs('transactions.create') ? 'bg-white text-yellow-500' : 'text-white hover:bg-yellow-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Transaction Create
                    </a>

                    <!-- WALLETS -->
                    <a href="{{ route('wallets.index') }}"
                        class="flex items-center gap-4 px-5 py-4 rounded-2xl {{ request()->routeIs('wallets.index') ? 'bg-white text-yellow-500' : 'text-white hover:bg-yellow-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 11h4v6h-4z" />
                        </svg>
                        Wallets
                    </a>

                    <!-- BUDGETS -->
                    <a href="{{ route('budgets.index') }}"
                        class="flex items-center gap-4 px-5 py-4 rounded-2xl {{ request()->routeIs('budgets.index') ? 'bg-white text-yellow-500' : 'text-white hover:bg-yellow-300' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 3a1 1 0 011 1v16a1 1 0 01-2 0V4a1 1 0 011-1z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a1 1 0 011 1v12a1 1 0 01-2 0V8a1 1 0 011-1z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 11a1 1 0 011 1v8a1 1 0 01-2 0v-8a1 1 0 011-1z" />
                        </svg>
                        Budgets
                    </a>

                    <!-- PROFILE -->
                    <a href="{{ route('profile') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl
   {{ request()->routeIs('profile')
    ? 'bg-white text-yellow-500'
    : 'text-white hover:bg-yellow-300' }}">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        Profile
                    </a>


                </nav>

            </div>

            {{-- LOGOUT BAWAH --}}
            <div class="px-6 pb-6 mt-auto">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="flex items-center gap-4 text-white px-5 py-4 w-full rounded-2xl hover:bg-yellow-300">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h4" />
                        </svg>

                        Log Out
                    </button>
                </form>

            </div>


        </aside>

        {{-- MAIN CONTENT (Konten Dinamis) --}}
        {{-- Bagian ini akan diisi oleh view lain menggunakan @section('content') --}}
        <main class="flex-1 px-12 pt-6 pb-10">
            {{-- PAGE CONTENT --}}
            @yield('content')

        </main>

    </div>

</body>

</html>