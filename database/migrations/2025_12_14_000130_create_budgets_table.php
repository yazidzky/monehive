<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Membuat tabel 'budgets' untuk merencanakan anggaran per kategori.
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relasi ke pengguna
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); // Relasi ke kategori yang dianggarkan
            $table->decimal('amount', 15, 2); // Jumlah anggaran
            $table->unsignedSmallInteger('month'); // Bulan anggaran (1-12)
            $table->unsignedSmallInteger('year'); // Tahun anggaran
            $table->timestamps();
        });
    }

    /**
     * Membalikkan migration.
     *
     * Menghapus tabel 'budgets'.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};

