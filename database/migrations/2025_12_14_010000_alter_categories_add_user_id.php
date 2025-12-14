<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('categories', 'user_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            });

            try {
                DB::table('categories')->whereNull('user_id')->update(['user_id' => 1]);
            } catch (\Throwable $e) {
            }

            Schema::table('categories', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->unsignedBigInteger('user_id')->nullable(false)->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};

