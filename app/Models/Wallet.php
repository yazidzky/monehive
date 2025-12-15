<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Wallet (Dompet/Akun).
 * Menyimpan sumber dana (Cash, Bank, e-Wallet).
 */
class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'balance', // Saldo saat ini
    ];

    // Relasi ke User pemilik dompet
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu dompet memiliki banyak transaksi
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}

