<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;
use Illuminate\Support\Facades\Cookie; // Tambahkan ini

class AuthDonasiController extends Controller
{
    public function dataDiri(Request $request)
    {
        // 1. Validasi dasar input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        $nama = trim($request->nama); // Hapus spasi depan/belakang
        $noWa = trim($request->no_wa);

        // 2. LOGIKA PENGECEKAN DUPLIKASI
        
        // Cek Nama (Case Insensitive)
        // Kita abaikan jika namanya "-" atau "Hamba Allah" (opsional)
        if ($nama !== '-' && strtolower($nama) !== 'hamba allah') {
            $cekNama = Donatur::where('nama', $nama)->first();
            if ($cekNama) {
                return back()->with('error', 'Nama tersebut sudah terdaftar. Silakan gunakan nama lain atau tambahkan gelar/bin/binti.');
            }
        }

        // Cek Nomor WA
        // HANYA cek jika nomor WA BUKAN tanda strip "-"
        if ($noWa !== '-') {
            $cekWa = Donatur::where('no_wa', $noWa)->first();
            if ($cekWa) {
                return back()->with('error', 'Nomor WhatsApp tersebut sudah terdaftar. Silakan gunakan nomor lain.');
            }
        }

        // 3. Jika lolos, simpan data donatur baru
        $donatur = Donatur::create([
            'nama' => $nama,
            'no_wa' => $noWa,
            'alamat' => $request->alamat,
        ]);

        // 4. Paksa hapus cookie lama & set cookie baru (seperti sebelumnya)
        Cookie::expire('donatur_id');
        Cookie::expire('donatur_nama');
        Cookie::expire('donatur_wa');

        Cookie::queue('donatur_id', $donatur->id, 43200);
        Cookie::queue('donatur_nama', $donatur->nama, 43200);
        Cookie::queue('donatur_wa', $donatur->no_wa, 43200);

        session()->flash('donasi_success', 'Data diri berhasil disimpan!');

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
