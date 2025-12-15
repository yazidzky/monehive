@extends('layouts.app')

{{--
Halaman Profil Pengguna
Menampilkan informasi pengguna yang sedang login dan opsi manajemen akun.
Fitur:
- Menampilkan Email pengguna.
- Tombol Ganti Password.
- Tombol Logout.
--}}

@section('content')

    <h1 class="text-[32px] font-semibold mt-0 mb-12">
        Profile
    </h1>

    <div class="flex flex-col items-center">

        {{-- AVATAR --}}
        <div class="w-48 h-48 rounded-full bg-gray-300 flex items-center justify-center mb-8">
            <svg class="w-28 h-28 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5z" />
                <path d="M12 14c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" />
            </svg>
        </div>

        {{-- USER INFO --}}
        <p class="text-xl font-semibold">
            {{ explode('@', Auth::user()->email)[0] }}
        </p>
        <p class="text-gray-500 mb-10">
            {{ Auth::user()->email }}
        </p>

        {{-- ACTION BUTTONS --}}
        <div class="flex flex-col gap-6 w-[300px]">

            {{-- CHANGE PASSWORD BUTTON --}}
            <a href="{{ route('password.change') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-4 rounded-full text-center block">
                Change Password
            </a>

            {{-- LOGOUT FORM --}}
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-4 rounded-full w-full">
                    Log Out
                </button>
            </form>


        </div>

    </div>

@endsection