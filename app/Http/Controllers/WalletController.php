<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WalletController extends Controller
{
    /**
     * Menampilkan daftar dompet digital/tunai user.
     */
    public function index(): View
    {
        $user = Auth::user();
        $wallets = Wallet::where('user_id', $user->id)
            ->orderBy('name')
            ->get();

        return view('wallets.index', [
            'wallets' => $wallets,
        ]);
    }

    /**
     * Menyimpan dompet baru.
     */
    public function store(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'balance' => ['required', 'numeric', 'min:0'],
            'theme' => ['nullable', 'string'],
        ]);

        // Insert ke Database
        Wallet::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'balance' => $validated['balance'],
        ]);

        return redirect()->route('wallets.index')->with('status', 'Wallet ditambahkan');
    }
}
