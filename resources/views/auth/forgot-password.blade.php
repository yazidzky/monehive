<!DOCTYPE html>
{{--
Halaman Lupa Password
Form untuk meminta link reset password via email.
--}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password | MoneHive</title>
    @vite('resources/css/app.css')
</head>

<body class="font-[Poppins] bg-white">

    <div class="min-h-screen grid grid-cols-2">

        {{-- LEFT CONTAINER --}}
        <div class="flex flex-col justify-center px-20">

            {{-- LOGO --}}
            <div class="flex items-center mb-10">
                <img src="{{ asset('images/logo-m.png') }}" class="w-20 h-20 -mr-2" alt="MoneHive Logo">
                <span class="text-3xl font-semibold text-yellow-500">
                    oneHive
                </span>
            </div>

            {{-- TITLE --}}
            <h1 class="text-4xl font-normal text-gray-900 mb-2">
                Forgot Password?
            </h1>
            <p class="text-gray-500 mb-10">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- FORM --}}
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6 w-[420px]">
                @csrf

                {{-- EMAIL --}}
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-500">
                        👤
                    </span>
                    <input type="email" name="email" :value="old('email')" required autofocus
                        placeholder="Email Address" class="w-full pl-14 pr-5 py-4 rounded-full bg-yellow-200/70
                              placeholder-gray-600 focus:outline-none">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />

                {{-- BUTTON ROW --}}
                <div class="flex items-center gap-6 mt-6">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500
                               text-white font-semibold
                               px-10 py-4 rounded-full w-full">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                {{-- BACK TO LOGIN --}}
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-yellow-500 text-sm">
                        Back to Login
                    </a>
                </div>

            </form>
        </div>

        {{-- RIGHT CONTAINER --}}
        <div class="relative overflow-hidden">

            {{-- YELLOW BACKGROUND SHAPE --}}
            <img src="{{ asset('images/background-login.png') }}" class="absolute inset-0 w-full h-full object-cover"
                alt="Background">

            {{-- ILLUSTRATION --}}
            <img src="{{ asset('images/login-illustration.png') }}"
                class="absolute right-10 top-1/2 -translate-y-1/2 w-[420px]" alt="Illustration">
        </div>

    </div>

</body>

</html>