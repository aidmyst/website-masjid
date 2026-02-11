<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;

class DonaturController extends Controller
{
    public function index()
    {
        if (!session('donatur_id')) {
            return redirect()->route('donasi')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('konfirmasi_donasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nominal' => 'required|numeric',
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buktiPath = $request->file('bukti_tf')->store('bukti_transfer', 'public');

        Donatur::create([
            'donatur_id' => session('donatur_id'),
            'kategori' => $request->kategori,
            'nominal' => $request->nominal,
            'bukti_tf' => $buktiPath,
        ]);

        return redirect()->route('konfirmasi.donasi')->with('success', 'Donasi berhasil dikonfirmasi!');
    }
}
