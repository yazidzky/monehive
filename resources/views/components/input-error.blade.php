{{--
Komponen Pesan Error Input
Menampilkan daftar pesan error validasi untuk sebuah field.
Props:
- messages: Array pesan error yang akan ditampilkan.
--}}
@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif