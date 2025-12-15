<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Menjalankan migration.
     *
     * Menambahkan kolom 'user_id' ke tabel 'categories' jika belum ada.
     * Mengisi 'user_id' default dan menambahkan foreign key constraint.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('categories', 'user_id')) {
            // Tambah kolom user_id nullable sementara
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            });

            // Isi user_id default untuk data yang sudah ada (user_id = 1)
            try {
                DB::table('categories')->whereNull('user_id')->update(['user_id' => 1]);
            } catch (\Throwable $e) {
                // Abaikan jika terjadi error saat update data
            }

            // Ubah menjadi not null dan tambahkan foreign key
            Schema::table('categories', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->unsignedBigInteger('user_id')->nullable(false)->change();
            });
        }
    }

    /**
     * Membalikkan migration.
     *
     * Menghapus foreign key dan kolom 'user_id' dari tabel 'categories'.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'user_id')) {
                $table->dropForeign(['user_id']); // Hapus foreign key
                $table->dropColumn('user_id'); // Hapus kolom
            }
        });
    }
};

