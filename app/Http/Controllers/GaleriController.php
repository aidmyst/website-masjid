<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'gambar.*' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/galeri'), $namaFile);

                Galeri::create([
                    'gambar' => 'uploads/galeri/' . $namaFile
                ]);
            }
        }

        return redirect()->route('dashboard')
        ->with('active_tab', 'sejarah')
        ->with('success', 'Foto galeri behasil di-upload ✅');
    }

    public function destroy(Galeri $galeri)
    {
        if (File::exists(public_path($galeri->gambar))) {
            File::delete(public_path($galeri->gambar));
        }
        $galeri->delete();

        return redirect()->route('dashboard')
        ->with('active_tab', 'sejarah')
        ->with('success', 'Foto galeri dihapus ✅');;
    }
}
