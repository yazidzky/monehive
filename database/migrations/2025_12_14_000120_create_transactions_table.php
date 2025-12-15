<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Membuat tabel 'transactions' untuk mencatat pemasukan dan pengeluaran.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relasi ke pengguna
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete(); // Relasi ke dompet
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); // Relasi ke kategori
            $table->enum('type', ['income', 'expense']); // Jenis transaksi
            $table->decimal('amount', 15, 2); // Jumlah nominal transaksi
            $table->date('occurred_at'); // Tanggal transaksi terjadi
            $table->string('note')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Membalikkan migration.
     *
     * Menghapus tabel 'transactions'.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

