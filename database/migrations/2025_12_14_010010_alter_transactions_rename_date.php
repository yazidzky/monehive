<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Mengubah nama kolom 'date' menjadi 'occurred_at' pada tabel 'transactions'.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'date') && !Schema::hasColumn('transactions', 'occurred_at')) {
                $table->renameColumn('date', 'occurred_at');
            }
        });
    }

    /**
     * Membalikkan migration.
     *
     * Mengembalikan nama kolom 'occurred_at' menjadi 'date'.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'occurred_at') && !Schema::hasColumn('transactions', 'date')) {
                $table->renameColumn('occurred_at', 'date');
            }
        });
    }
};

