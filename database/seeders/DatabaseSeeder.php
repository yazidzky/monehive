<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Menjalankan database seeders.
     *
     * Fungsi ini akan mengisi database dengan data awal atau data dummy.
     */
    public function run(): void
    {
        // User::factory(10)->create(); // Membuat 10 user acak

        // Membuat user khusus untuk pengujian
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
