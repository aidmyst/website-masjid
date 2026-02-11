<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Rekening;
use App\Models\Donatur;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        $donaturId = $request->cookie('donatur_id');

        if (!$donaturId) {
            return redirect()->route('donasi')
                ->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        $donatur = Donatur::find($donaturId);

        if (!$donatur) {
            Cookie::expire('donatur_id');
            Cookie::expire('donatur_nama');
            Cookie::expire('donatur_wa');

            return redirect()->route('donasi')
                ->with('error', 'Sesi Anda telah berakhir atau data dihapus. Silakan isi data kembali.');
        }

        $namaDonatur = $donatur->nama;

        $rekening = Rekening::first();

        return view('konfirmasi_donasi', compact('rekening', 'namaDonatur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nominal' => 'required|numeric',
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $namaDonatur = $request->cookie('donatur_nama');
        $noWaDonatur = $request->cookie('donatur_wa');
        $donaturId   = $request->cookie('donatur_id');

        if (!$namaDonatur || !$noWaDonatur) {
            return redirect()->route('donasi')->with('error', 'Sesi Anda habis, silakan isi data diri ulang.');
        }

        $buktiPath = $request->file('bukti_tf')->store('bukti_transfer', 'public');

        Donasi::create([
            'donatur_id'   => $donaturId,
            'nama_donatur' => $namaDonatur,
            'no_wa'        => $noWaDonatur,     
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
    public function updateKonfirmasi(Request $request, $id)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'no_wa'   => 'required|string|max:20',
            'nominal' => 'required', 
        ]);

        $donasi = Donasi::findOrFail($id);
        $nominalBersih = str_replace('.', '', $request->nominal);

        if ($donasi->donatur) {
            $donasi->donatur->nama = $request->nama;
            $donasi->donatur->no_wa = $request->no_wa;
            $donasi->donatur->save();
        }

        $donasi->nominal = $nominalBersih;
        $donasi->save();

        return redirect()->route('dashboard')
            ->with('active_tab', 'donasi')
            ->with('success', 'Data konfirmasi donasi berhasil diperbarui.');
    }
}
