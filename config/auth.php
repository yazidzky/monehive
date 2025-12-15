<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Otentikasi
    |--------------------------------------------------------------------------
    |
    | Opsi ini mendefinisikan default "guard" otentikasi dan "broker" reset password
    | untuk aplikasi Anda. Anda dapat mengubah nilai-nilai ini
    | sesuai kebutuhan, tetapi ini adalah awal yang sempurna untuk sebagian besar aplikasi.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Guard Otentikasi
    |--------------------------------------------------------------------------
    |
    | Selanjutnya, Anda dapat mendefinisikan setiap guard otentikasi untuk aplikasi Anda.
    | Tentu saja, konfigurasi default yang bagus telah didefinisikan untuk Anda
    | yang memanfaatkan penyimpanan sesi ditambah penyedia pengguna Eloquent.
    |
    | Semua guard otentikasi memiliki penyedia pengguna, yang mendefinisikan bagaimana
    | pengguna sebenarnya diambil dari database Anda atau penyimpanan lain
    | yang digunakan oleh aplikasi. Biasanya, Eloquent digunakan.
    |
    | Didukung: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Penyedia Pengguna (User Providers)
    |--------------------------------------------------------------------------
    |
    | Semua guard otentikasi memiliki penyedia pengguna, yang mendefinisikan bagaimana
    | pengguna sebenarnya diambil dari database Anda atau penyimpanan lain
    | yang digunakan oleh aplikasi. Biasanya, Eloquent digunakan.
    |
    | Jika Anda memiliki beberapa tabel pengguna atau model, Anda dapat mengonfigurasi beberapa
    | penyedia untuk mewakili model / tabel tersebut. Penyedia ini kemudian dapat
    | ditugaskan ke guard otentikasi tambahan yang telah Anda tetapkan.
    |
    | Didukung: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Mengatur Ulang Password
    |--------------------------------------------------------------------------
    |
    | Opsi konfigurasi ini menentukan perilaku fungsionalitas reset password
    | Laravel, termasuk tabel yang digunakan untuk penyimpanan token
    | dan penyedia pengguna yang dipanggil untuk mengambil pengguna sebenarnya.
    |
    | Waktu kedaluwarsa adalah jumlah menit setiap token reset akan
    | dianggap valid. Fitur keamanan ini menjaga token berumur pendek sehingga
    | mereka memiliki lebih sedikit waktu untuk ditebak. Anda dapat mengubah ini sesuai kebutuhan.
    |
    | Pengaturan throttle adalah jumlah detik yang harus ditunggu pengguna sebelum
    | menghasilkan lebih banyak token reset password. Ini mencegah pengguna dari
    | dengan cepat menghasilkan jumlah token reset password yang sangat besar.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Batas Waktu Konfirmasi Password
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan jumlah detik sebelum jendela konfirmasi password
    | kedaluwarsa dan pengguna diminta untuk memasukkan kembali password mereka melalui
    | layar konfirmasi. Secara default, batas waktu berlangsung selama tiga jam.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
