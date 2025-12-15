<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Menampilkan prompt/halaman permintaan verifikasi email.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // Jika sudah verified, buang ke dashboard. Jika belum, tampilkan view notice.
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard', absolute: false))
            : view('auth.verify-email');
    }
}
