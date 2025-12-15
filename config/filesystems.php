<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disk Filesystem Default
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan disk filesystem default yang harus digunakan
    | oleh kerangka kerja. Disk "local", serta berbagai disk berbasis cloud
    | tersedia untuk penyimpanan file aplikasi Anda.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Disk Filesystem
    |--------------------------------------------------------------------------
    |
    | Di bawah ini Anda dapat mengonfigurasi sebanyak mungkin disk filesystem yang diperlukan, dan Anda
    | bahkan dapat mengonfigurasi beberapa disk untuk driver yang sama. Contoh untuk
    | sebagian besar driver penyimpanan yang didukung dikonfigurasi di sini sebagai referensi.
    |
    | Driver yang didukung: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat mengonfigurasi symbolic links yang akan dibuat ketika
    | perintah Artisan `storage:link` dijalankan. Kunci array harus
    | lokasi tautan dan nilainya harus target mereka.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
