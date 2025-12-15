<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Membuat tabel 'users', 'password_reset_tokens', dan 'sessions'.
     */
    public function up(): void
    {
        // Membuat tabel 'users' untuk menyimpan data pengguna aplikasi.
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key auto-increment
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email pengguna (unik)
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email
            $table->string('password'); // Password terenkripsi
            $table->rememberToken(); // Token untuk fitur "Remember Me"
            $table->timestamps(); // Kolom created_at dan updated_at
        });

        // Membuat tabel 'password_reset_tokens' untuk menyimpan token reset password.
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Membuat tabel 'sessions' untuk menyimpan data sesi pengguna.
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Membalikkan migration.
     *
     * Menghapus tabel 'users', 'password_reset_tokens', dan 'sessions'.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
