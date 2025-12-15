{{--
Komponen Status Sesi Autentikasi
Menampilkan pesan status sesi (seperti sukses login, logout, atau reset password).
Props:
- status: Pesan status yang akan ditampilkan.
--}}
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif