<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Membuat tabel 'wallets' untuk menyimpan dompet/rekening pengguna.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relasi ke pengguna
            $table->string('name'); // Nama dompet
            $table->decimal('balance', 15, 2)->default(0); // Saldo dompet
            $table->timestamps();
        });
    }

    /**
     * Membalikkan migration.
     *
     * Menghapus tabel 'wallets'.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};

