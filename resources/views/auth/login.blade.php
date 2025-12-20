<!DOCTYPE html>
{{--
Halaman Login
Form autentikasi pengguna masuk ke sistem.
Menggunakan layout custom split-screen (Logo/Form di kiri, Gambar di kanan).
--}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | MoneHive</title>
    <meta name="theme-color" content="#4f46e5">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            {{-- TITLE --}}
            <h1 class="text-4xl font-normal text-gray-900 mb-2">
                Welcome to MoneHive!
            </h1>
            <p class="text-gray-500 mb-10">
                Sign in to manage your finances smarter
            </p>

            {{-- FORM LOGIN (Autentifikasi) --}}
            {{-- Mengirim data ke route('login') via POST --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-6 w-[420px]">
                @csrf

                {{-- USERNAME / EMAIL --}}
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-500">
                        👤
                    </span>
                    <input type="email" name="email" autocomplete="username" placeholder="Username or Email" class="w-full pl-14 pr-5 py-4 rounded-full bg-yellow-200/70
                              placeholder-gray-600 focus:outline-none">
                </div>

                {{-- PASSWORD --}}
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-500">
                        🔒
                    </span>
                    <input type="password" name="password" autocomplete="current-password" placeholder="Password" class="w-full pl-14 pr-14 py-4 rounded-full bg-yellow-200/70
                              placeholder-gray-600 focus:outline-none">
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer">
                        👁
                    </span>
                </div>

                {{-- OTHER ACTIONS --}}
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <span>
                        Don’t have account?
                        <a href="/register" class="text-yellow-500">
                            Sign Up Please!
                        </a>
                    </span>
                    <a href="{{ route('password.request') }}" class="hover:underline">
                        Forgot Password?
                    </a>
                </div>

                {{-- BUTTON ROW --}}
                <div class="flex items-center gap-6 mt-6">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500
                               text-white font-semibold
                               px-20 py-4 rounded-full">
                        Login
                    </button>

                    <a href="/register" class="text-gray-800 text-lg">
                        Sign Up
                    </a>
                    <button id="pwaInstallBtn" type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-6 py-4 rounded-full hidden">
                        Install App
                    </button>
                </div>

            </form>
        </div>

        {{-- RIGHT CONTAINER (SAMA PERSIS DENGAN REGISTER) --}}
        <div class="relative overflow-hidden">

            {{-- YELLOW BACKGROUND SHAPE --}}
            <img src="{{ asset('images/background-login.png') }}" class="absolute inset-0 w-full h-full object-cover"
                alt="Background">

            {{-- ILLUSTRATION --}}
            <img src="{{ asset('images/login-illustration.png') }}"
                class="absolute right-10 top-1/2 -translate-y-1/2 w-[420px]" alt="Illustration">
        </div>

    </div>

    <script>
        let deferredPrompt;
        const installBtn = document.getElementById('pwaInstallBtn');
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            if (installBtn) installBtn.classList.remove('hidden');
        });
        installBtn?.addEventListener('click', async () => {
            if (!deferredPrompt) return;
            await deferredPrompt.prompt();
            deferredPrompt = null;
            installBtn.classList.add('hidden');
        });
        window.addEventListener('appinstalled', () => {
            deferredPrompt = null;
            if (installBtn) installBtn.classList.add('hidden');
        });
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.getRegistration().then((reg) => {
                if (!reg) {
                    navigator.serviceWorker.register('/service-worker.js').catch(() => {});
                }
            });
        }
    </script>
</body>

</html>
