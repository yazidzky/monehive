<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver Sesi Default
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan driver sesi default yang digunakan untuk
    | permintaan masuk. Laravel mendukung berbagai opsi penyimpanan untuk
    | menyimpan data sesi. Penyimpanan database adalah pilihan default yang bagus.
    |
    | Didukung: "file", "cookie", "database", "memcached",
    |            "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Masa Hidup Sesi
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan jumlah menit yang Anda inginkan agar sesi
    | diperbolehkan tetap diam sebelum kedaluwarsa. Jika Anda ingin mereka
    | kedaluwarsa segera setelah browser ditutup, maka Anda dapat
    | menunjukkannya melalui opsi konfigurasi expire_on_close.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Enkripsi Sesi
    |--------------------------------------------------------------------------
    |
    | Opsi ini memungkinkan Anda untuk dengan mudah menentukan bahwa semua data sesi Anda
    | harus dienkripsi sebelum disimpan. Semua enkripsi dilakukan
    | secara otomatis oleh Laravel dan Anda dapat menggunakan sesi seperti biasa.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Lokasi File Sesi
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan driver sesi "file", file sesi ditempatkan
    | di disk. Lokasi penyimpanan default ditentukan di sini; namun, Anda
    | bebas menyediakan lokasi lain di mana file tersebut harus disimpan.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Koneksi Database Sesi
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan driver sesi "database" atau "redis", Anda dapat menentukan
    | koneksi yang harus digunakan untuk mengelola sesi ini. Ini harus
    | sesuai dengan koneksi dalam opsi konfigurasi database Anda.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabel Database Sesi
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan driver sesi "database", Anda dapat menentukan tabel yang
    | akan digunakan untuk menyimpan sesi. Tentu saja, default yang masuk akal telah ditentukan
    | untuk Anda; namun, Anda dipersilakan untuk mengubah ini ke tabel lain.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Toko Cache Sesi (Session Cache Store)
    |--------------------------------------------------------------------------
    |
    | Saat menggunakan salah satu backend sesi berbasis cache kerangka kerja, Anda dapat
    | menentukan toko cache yang harus digunakan untuk menyimpan data sesi
    | antar permintaan. Ini harus cocok dengan salah satu toko cache yang Anda tentukan.
    |
    | Mempengaruhi: "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Lotere Pembersihan Sesi
    |--------------------------------------------------------------------------
    |
    | Beberapa driver sesi harus secara manual membersihkan lokasi penyimpanan mereka untuk
    | membuang sesi lama dari penyimpanan. Berikut adalah peluang bahwa hal itu akan
    | terjadi pada permintaan tertentu. Secara default, kemungkinannya adalah 2 dari 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nama Cookie Sesi
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat mengubah nama cookie sesi yang dibuat oleh
    | framework. Biasanya, Anda tidak perlu mengubah nilai ini
    | karena melakukannya tidak memberikan peningkatan keamanan yang berarti.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')) . '-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Jalur Cookie Sesi
    |--------------------------------------------------------------------------
    |
    | Jalur cookie sesi menentukan jalur di mana cookie akan
    | dianggap tersedia. Biasanya, ini akan menjadi jalur root dari
    | aplikasi Anda, tetapi Anda bebas mengubahnya bila diperlukan.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Domain Cookie Sesi
    |--------------------------------------------------------------------------
    |
    | Nilai ini menentukan domain dan subdomain tempat cookie sesi
    | tersedia. Secara default, cookie akan tersedia untuk domain root
    | tanpa subdomain. Biasanya, ini tidak boleh diubah.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Cookie HTTPS Only
    |--------------------------------------------------------------------------
    |
    | Dengan menyetel opsi ini ke true, cookie sesi hanya akan dikirim kembali
    | ke server jika browser memiliki koneksi HTTPS. Ini akan menjaga
    | cookie agar tidak dikirim kepada Anda ketika tidak dapat dilakukan dengan aman.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Hanya Akses HTTP (HTTP Access Only)
    |--------------------------------------------------------------------------
    |
    | Menyetel nilai ini ke true akan mencegah JavaScript mengakses
    | nilai cookie dan cookie hanya akan dapat diakses melalui
    | protokol HTTP. Sangat tidak mungkin Anda harus menonaktifkan opsi ini.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Cookie Same-Site
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan bagaimana cookie Anda berperilaku ketika permintaan lintas situs
    | terjadi, dan dapat digunakan untuk memitigasi serangan CSRF. Secara default, kami
    | akan menyetel nilai ini ke "lax" untuk mengizinkan permintaan lintas situs yang aman.
    |
    | Lihat: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Didukung: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Terpartisi (Partitioned Cookies)
    |--------------------------------------------------------------------------
    |
    | Menyetel nilai ini ke true akan mengikat cookie ke situs tingkat atas untuk
    | konteks lintas situs. Cookie terpartisi diterima oleh browser
    | ketika ditandai "secure" dan atribut Same-Site disetel ke "none".
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
