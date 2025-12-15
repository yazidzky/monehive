<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Transaction (Database)
 * Merepresentasikan tabel 'transactions' di database.
 */
class Transaction extends Model
{
    // Kolom-kolom yang boleh diisi secara massal (Mass Assignment)
    protected $fillable = [
        'user_id',
        'wallet_id',
        'category_id',
        'type',     // income / expense
        'amount',
        'occurred_at',
        'note',
    ];

    // Casting tipe data kolom
    protected $casts = [
        'occurred_at' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relasi ke tabel Users (Database Relationship)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Wallets
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    // Relasi ke tabel Categories
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

