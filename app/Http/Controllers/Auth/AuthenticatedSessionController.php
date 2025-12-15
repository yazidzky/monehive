<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login (Frontend).
     * Bagian dari fitur Autentifikasi.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login user (Backend/Autentifikasi).
     * Menerima request dari form login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses autentikasi user
        $request->authenticate();

        // Regenerasi session ID untuk keamanan
        $request->session()->regenerate();

        // Redirect ke halaman dashboard atau halaman yang dituju sebelumnya
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Menghapus sesi user yang login (Logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout user dari guard 'web'
        Auth::guard('web')->logout();

        // Invalidasi session saat ini
        $request->session()->invalidate();

        // Regenerasi CSRF token
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
