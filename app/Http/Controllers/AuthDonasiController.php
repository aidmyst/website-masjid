<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;
use Illuminate\Support\Facades\Cookie; // Tambahkan ini

class AuthDonasiController extends Controller
{
    public function dataDiri(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        // 1. Simpan data donatur BARU ke database
        $donatur = Donatur::create([
            'nama' => $request->nama,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        // 2. PAKSA HAPUS cookie lama (jika ada) agar bersih
        Cookie::expire('donatur_id');
        Cookie::expire('donatur_nama');
        Cookie::expire('donatur_wa');

        // 3. GUNAKAN QUEUE untuk menyimpan cookie baru (Lebih Stabil)
        // 43200 menit = 30 hari
        Cookie::queue('donatur_id', $donatur->id, 43200);
        Cookie::queue('donatur_nama', $donatur->nama, 43200);
        Cookie::queue('donatur_wa', $donatur->no_wa, 43200);

        session()->flash('donasi_success', 'Data diri berhasil disimpan!');

        // 4. Redirect biasa (Cookie sudah di-queue di atas)
        return redirect()->route('konfirmasi.donasi');
    }

    public function logout()
    {
        // Hapus cookie saat logout
        $cookieNama = Cookie::forget('donatur_nama');
        $cookieWa   = Cookie::forget('donatur_wa');
        $cookieId   = Cookie::forget('donatur_id');

        return redirect()->route('donasi')
            ->withCookie($cookieNama)
            ->withCookie($cookieWa)
            ->withCookie($cookieId);
    }

    public function destroy(Donatur $donatur)
    {
        // 1. Hapus data dari database
        $donatur->delete();

        // 2. Siapkan perintah untuk menghapus cookie
        // Gunakan nama cookie yang sama persis dengan saat Anda membuatnya
        $cookieId   = Cookie::forget('donatur_id');
        $cookieNama = Cookie::forget('donatur_nama');
        $cookieWa   = Cookie::forget('donatur_wa');

        // 3. Redirect ke dashboard dengan membawa perintah hapus cookie
        return redirect()->route('dashboard')
            ->with('active_tab', 'donatur')
            ->with('success', 'Akun donatur telah berhasil dihapus.')
            ->withCookie($cookieId)
            ->withCookie($cookieNama)
            ->withCookie($cookieWa);
    }
}
