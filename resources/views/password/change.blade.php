@extends('layouts.app')

@section('content')

<h1 class="text-[32px] font-semibold mt-0 mb-12">
    Profile
</h1>

<div class="flex gap-24 items-start">

    {{-- KIRI: PROFIL --}}
    <div class="flex flex-col items-center">

        {{-- AVATAR --}}
        <div class="w-48 h-48 rounded-full bg-gray-300 flex items-center justify-center mb-8">
            <svg class="w-28 h-28 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5z"/>
                <path d="M12 14c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
            </svg>
        </div>

        {{-- USER INFO --}}
        <p class="text-xl font-semibold">
            {{ explode('@', Auth::user()->email)[0] }}
        </p>
        <p class="text-gray-500">
            {{ Auth::user()->email }}
        </p>

    </div>

    {{-- KANAN: FORM CHANGE PASSWORD --}}
    <div class="flex-1 max-w-xl">

        <h2 class="text-2xl font-semibold mb-8">
            Change Password
        </h2>

        <form class="space-y-6">

            <input
                type="email"
                placeholder="Masukkan Email"
                class="w-full bg-gray-200 rounded-full py-4 px-6 placeholder-white text-white focus:outline-none"
            >

            <input
                type="password"
                placeholder="Masukkan Password Lama"
                class="w-full bg-gray-200 rounded-full py-4 px-6 placeholder-white text-white focus:outline-none"
            >

            <input
                type="password"
                placeholder="Masukkan Password Baru"
                class="w-full bg-gray-200 rounded-full py-4 px-6 placeholder-white text-white focus:outline-none"
            >

            <input
                type="password"
                placeholder="Konfirmasi Password Baru"
                class="w-full bg-gray-200 rounded-full py-4 px-6 placeholder-white text-white focus:outline-none"
            >

            <button
                type="submit"
                class="mt-8 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-4 px-16 rounded-full">
                Save
            </button>

        </form>

    </div>

</div>

@endsection
