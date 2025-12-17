<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Jika pakai Breeze default, atau pakai Request biasa
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request (REAL DATABASE AUTH).
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek ke Database (Tabel Users)
        // Auth::attempt akan:
        // a. Mencari user berdasarkan email.
        // b. Memverifikasi apakah hash password di DB cocok dengan input password.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            
            // Jika Berhasil:
            $request->session()->regenerate(); // Mencegah session fixation
            return redirect()->intended('/dashboard');
        }

        // 3. Jika Gagal (Email tidak ada atau Password salah):
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}