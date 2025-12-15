<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Menyimpan kategori baru (Income/Expense).
     * Menerima input dari formulir pembuatan budget/transaksi.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        // Tentukan tipe kategori (default: expense)
        $type = 'expense';
        if ($request->filled('type') && in_array($request->input('type'), ['income', 'expense'], true)) {
            $type = $request->input('type');
        }

        // Simpan ke Database
        Category::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'type' => $type,
        ]);

        // Kembali ke halaman sebelumnya
        return back()->with('status', 'Category ditambahkan');
    }
}
