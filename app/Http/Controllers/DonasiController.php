<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Rekening;
use App\Models\Donatur; // Tambahkan Model Donatur
use Illuminate\Support\Facades\Cookie; // Tambahkan Facade Cookie
use Illuminate\Support\Facades\Storage;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil ID dari Cookie
        $donaturId = $request->cookie('donatur_id');

        // 2. Cek apakah Cookie ID ada?
        if (!$donaturId) {
            return redirect()->route('donasi')
                ->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        // 3. [PENTING] Cek apakah ID tersebut MASIH ADA di Database?
        // Ini mengatasi kasus: Admin hapus akun -> User refresh halaman -> Error/Nama Lama
        $donatur = Donatur::find($donaturId);

        if (!$donatur) {
            // Jika data di database sudah hilang (dihapus admin),
            // Kita paksa hapus cookie di browser user dan tendang ke halaman depan
            Cookie::expire('donatur_id');
            Cookie::expire('donatur_nama');
            Cookie::expire('donatur_wa');

            return redirect()->route('donasi')
                ->with('error', 'Sesi Anda telah berakhir atau data dihapus. Silakan isi data kembali.');
        }

        // 4. Jika valid, gunakan nama ASLI dari database (bukan dari cookie)
        // agar data selalu fresh sesuai yang baru diinput/diedit
        $namaDonatur = $donatur->nama;

        $rekening = Rekening::first();

        return view('konfirmasi_donasi', compact('rekening', 'namaDonatur'));
    }

    // ==============================
    // SIMPAN DONASI
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nominal' => 'required|numeric',
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        // Pastikan cookie ada sebelum menyimpan
        $namaDonatur = $request->cookie('donatur_nama');
        $noWaDonatur = $request->cookie('donatur_wa');
        $donaturId   = $request->cookie('donatur_id'); // Jika perlu relasi ID

        if (!$namaDonatur || !$noWaDonatur) {
            return redirect()->route('donasi')->with('error', 'Sesi Anda habis, silakan isi data diri ulang.');
        }

        $buktiPath = $request->file('bukti_tf')->store('bukti_transfer', 'public');

        Donasi::create([
            'donatur_id'   => $donaturId,       // Masukkan ID jika relasi database membutuhkan
            'nama_donatur' => $namaDonatur,     // Ambil dari cookie
            'no_wa'        => $noWaDonatur,     // Ambil dari cookie
            'kategori'     => $request->kategori,
            'nominal'      => $request->nominal,
            'bukti_tf'     => $buktiPath,
        ]);

        return redirect()->route('konfirmasi.donasi')
            ->with('success', 'Donasi berhasil dikonfirmasi!');
    }

    public function updateRekening(Request $request)
    {
        $request->validate([
            'nama_bank'        => 'required|string',
            'nomor_rekening'   => 'required|string',
            'atas_nama'        => 'required|string',
            'qris_image'       => 'nullable|image|max:2048',
        ]);

        $rekening = Rekening::firstOrNew(['id' => 1]);
        $rekening->nama_bank = $request->nama_bank;
        $rekening->nomor_rekening = $request->nomor_rekening;
        $rekening->atas_nama = $request->atas_nama;

        if ($request->hasFile('qris_image')) {
            $path = $request->file('qris_image')->store('public/qris');
            $rekening->qris_image = str_replace('public/', 'storage/', $path);
        }

        $rekening->save();

        return redirect()->route('dashboard')
            ->with('active_tab', 'donasi')
            ->with('success', 'Informasi rekening berhasil diperbarui');
    }

    // ==============================
    // HAPUS KONFIRMASI DONASI
    // ==============================
    public function destroyKonfirmasi(Donasi $konfirmasi)
    {
        if ($konfirmasi->bukti_tf) {
            Storage::disk('public')->delete($konfirmasi->bukti_tf);
        }

        $konfirmasi->delete();

        return redirect()->route('dashboard')
            ->with('active_tab', 'donasi')
            ->with('success', 'Konfirmasi donasi telah dihapus.');
    }
}
