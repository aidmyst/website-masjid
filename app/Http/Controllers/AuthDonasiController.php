<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Donatur;

class AuthDonasiController extends Controller
{
    public function loginDonasi(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        $donatur = Donatur::where('nama', $request->nama)->first();

        if ($donatur && Hash::check($request->password, $donatur->password)) {
            session(['donatur_id' => $donatur->id]);
            session(['donatur_nama' => $donatur->nama]);
            
            // TAMBAHKAN BARIS INI
            session()->flash('donasi_success', 'Login berhasil! Selamat datang, ' . $donatur->nama . '.');
            
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Nama atau password anda salah. Silahkan coba lagi']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:donaturs',
            'no_wa' => 'required',
            'password' => 'required|min:5',
        ]);

        $donatur = Donatur::create([
            'nama' => $request->nama,
            'no_wa' => $request->no_wa,
            'password' => Hash::make($request->password),
        ]);

        session(['donatur_id' => $donatur->id]);
        session(['donatur_nama' => $donatur->nama]);

        // TAMBAHKAN BARIS INI
        session()->flash('donasi_success', 'Registrasi berhasil! Anda sekarang sudah login.');

        return response()->json(['success' => true]);
    }

    public function logout()
    {
        session()->forget(['donatur_id', 'donatur_nama']);
        return redirect()->route('donasi');
    }

    public function destroy(Donatur $donatur)
    {
        $donatur->delete();

        return redirect()->route('dashboard')
            ->with('active_tab', 'donatur')
            ->with('success', 'Akun donatur telah berhasil dihapus.');
    }
}