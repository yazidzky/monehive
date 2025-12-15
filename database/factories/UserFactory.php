<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 *
 * Factory untuk model User. Digunakan untuk menghasilkan data pengguna tiruan (dummy).
 */
class UserFactory extends Factory
{
    /**
     * Password default yang digunakan oleh factory.
     */
    protected static ?string $password;

    /**
     * Mendefinisikan state default untuk model.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Nama acak
            'email' => fake()->unique()->safeEmail(), // Email aman dan unik
            'email_verified_at' => now(), // Email diverifikasi sekarang
            'password' => static::$password ??= Hash::make('password'), // Password default 'password'
            'remember_token' => Str::random(10), // Token acak
        ];
    }

    /**
     * Menandakan bahwa alamat email model belum diverifikasi.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
