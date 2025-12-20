<!DOCTYPE html>
{{--
Layout Tamu (Guest)
Layout ini digunakan untuk halaman publik seperti Login, Register, Forgot Password.
Ciri khas: Tampilan sederhana, terpusat di tengah layar.
--}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MoneHive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#4f46e5">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen flex items-center justify-center">

    {{ $slot }}

</body>

</html>
