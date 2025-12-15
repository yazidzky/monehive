<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Category (Kategori Transaksi).
 * Contoh: Makanan, Transport, Gaji.
 */
class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type', // income atau expense
    ];

    // Relasi ke User pemilik kategori
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu kategori bisa punya banyak transaksi
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}

