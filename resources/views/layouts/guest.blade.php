<!DOCTYPE html>
{{--
Layout Tamu (Guest)
Layout ini digunakan untuk halaman publik seperti Login, Register, Forgot Password.
Ciri khas: Tampilan sederhana, terpusat di tengah layar.
--}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description"
        content="MoneHive - Aplikasi manajemen keuangan personal untuk melacak transaksi, mengelola dompet, dan mengatur budget">
    <title>MoneHive - Personal Finance Manager</title>

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#4f46e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="MoneHive">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Install Button Styles */
        #installButton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 14px 28px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            z-index: 1000;
            display: none;
            border: none;
            transition: all 0.3s ease;
            animation: slideIn 0.5s ease-out;
        }

        #installButton:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.4);
        }

        #installButton:active {
            transform: translateY(0);
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Icon styling inside button */
        #installButton svg {
            display: inline-block;
            vertical-align: middle;
            margin-right: 8px;
        }
    </style>

    <!-- PWA Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js')
                    .then((registration) => {
                        console.log('Service Worker registered:', registration);
                    })
                    .catch((error) => {
                        console.log('Service Worker registration failed:', error);
                    });
            });
        }

        // PWA Install Prompt
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('beforeinstallprompt event triggered');
            e.preventDefault();
            deferredPrompt = e;

            // Show install button
            const installButton = document.getElementById('installButton');
            if (installButton) {
                installButton.style.display = 'block';
                console.log('Install button shown');
            }
        });

        function installPWA() {
            const installButton = document.getElementById('installButton');
            if (installButton) {
                installButton.style.display = 'none';
            }

            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('PWA installed successfully');
                    } else {
                        console.log('PWA installation dismissed');
                    }
                    deferredPrompt = null;
                });
            }
        }

        // Check if already installed
        window.addEventListener('appinstalled', () => {
            console.log('PWA was installed');
            const installButton = document.getElementById('installButton');
            if (installButton) {
                installButton.style.display = 'none';
            }
        });
    </script>
</head>

<body class="bg-white min-h-screen flex items-center justify-center">

    {{ $slot }}

    <!-- PWA Install Button -->
    <button id="installButton" onclick="installPWA()">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        Install Aplikasi
    </button>

</body>

</html>