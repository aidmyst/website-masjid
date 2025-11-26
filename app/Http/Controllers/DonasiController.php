<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Rekening;
use Illuminate\Support\Facades\Storage;

class DonasiController extends Controller
{
    // ==============================
    // BAGIAN: KONFIRMASI DONASI
    // ==============================
    public function index()
    {
        // pastikan user login
        if (!session('donatur_id')) {
            return redirect()->route('donasi')->with('error', 'Silakan login terlebih dahulu.');
        }
        $rekening = Rekening::first();

        // 2. Kirim data rekening ke view
        return view('konfirmasi_donasi', compact('rekening'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nominal' => 'required|numeric',
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buktiPath = $request->file('bukti_tf')->store('bukti_transfer', 'public');

        Donasi::create([
            'donatur_id' => session('donatur_id'),
            'kategori' => $request->kategori,
            'nominal' => $request->nominal,
            'bukti_tf' => $buktiPath,
        ]);

        return redirect()->route('konfirmasi.donasi')->with('success', 'Donasi berhasil dikonfirmasi!');
    }

    // ==============================
    // BAGIAN: REKENING & QRIS
    // ==============================
    public function updateRekening(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'qris_image' => 'nullable|image|max:2048',
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
            ->with('success', 'Informasi rekening berhasil diperbarui ✅');
    }

    public function destroyKonfirmasi(Donasi $konfirmasi)
    {
        // Hapus file bukti transfer dari storage
        // (Penting agar storage Anda tidak penuh)
        if ($konfirmasi->bukti_tf) {
            Storage::disk('public')->delete($konfirmasi->bukti_tf);
        }

        // Hapus record dari database
        $konfirmasi->delete();

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')
            ->with('active_tab', 'donasi') // Pastikan tab donasi tetap aktif
            ->with('success', 'Konfirmasi donasi telah ditolak/dihapus.');
    }
}
