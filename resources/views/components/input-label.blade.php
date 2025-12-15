{{--
Komponen Label Input
Digunakan untuk label form field.
Props:
- value: Teks label (opsional). Jika tidak ada, slot akan digunakan.
--}}
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>