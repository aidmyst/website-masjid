<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User; // tetap perlu untuk objek user, tapi tidak pakai database

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Login tanpa database (HANYA 1 email + password)
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Hardcoded akun admin
        $adminEmail = 'jamiaisyah125@gmail.com';
        $adminPassword = 'jamiaisyah125@';  // ganti sesukamu

        // Cek email
        if ($request->email !== $adminEmail) {
            return back()->withErrors([
                'email' => 'Akun tidak diizinkan.'
            ]);
        }

        // Cek password
        if ($request->password !== $adminPassword) {
            return back()->withErrors([
                'password' => 'Password salah.'
            ]);
        }

        // Buat user dummy (tanpa database)
        $fakeUser = new User();
        $fakeUser->id = 1;
        $fakeUser->name = "Admin Masjid";
        $fakeUser->email = $adminEmail;

        // Manual login
        Auth::login($fakeUser);

        // Regenerasi session
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
