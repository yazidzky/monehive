<?php
/**
 * File Route Console (Artisan)
 * Mendefinisikan perintah-perintah custom CLI yang bisa dijalankan via `php artisan`.
 */

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
