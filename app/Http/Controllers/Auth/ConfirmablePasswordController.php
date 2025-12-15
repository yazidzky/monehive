<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi password.
     * Biasanya diminta sebelum melakukan aksi sensitif.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Memverifikasi password user.
     */
    public function store(Request $request): RedirectResponse
    {
        // Cek apakah password yang dimasukkan valid
        if (
            !Auth::guard('web')->validate([
                'email' => $request->user()->email,
                'password' => $request->password,
            ])
        ) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
