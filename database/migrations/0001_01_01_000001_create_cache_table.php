<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Membuat tabel 'cache' dan 'cache_locks' untuk sistem caching aplikasi.
     */
    public function up(): void
    {
        // Membuat tabel 'cache'.
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        // Membuat tabel 'cache_locks'.
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Membalikkan migration.
     *
     * Menghapus tabel 'cache' dan 'cache_locks'.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
