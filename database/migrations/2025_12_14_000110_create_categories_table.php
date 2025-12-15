<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Membuat tabel 'categories' untuk mengelompokkan transaksi.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relasi ke pengguna
            $table->string('name'); // Nama kategori
            $table->enum('type', ['income', 'expense']); // Jenis kategori: pemasukan atau pengeluaran
            $table->timestamps();
        });
    }

    /**
     * Membalikkan migration.
     *
     * Menghapus tabel 'categories'.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

