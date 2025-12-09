<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ tab: '{{ session('active_tab', 'masjid') }}' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Anda telah login sebagai admin. Dari sini
                        Anda bisa mengelola seluruh konten website.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Jadwal Kajian</h4>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $totalKajian }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Donatur Terdaftar</h4>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        {{-- Menghitung jumlah donatur dari tabel 'donaturs' --}}
                        {{ $donaturs->count() }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    {{-- Judul bisa diubah agar lebih jelas --}}
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Donasi Terkumpul</h4>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        {{-- Menggunakan variabel $totalDonasiPending yang baru --}}
                        Rp {{ number_format($totalDonasiTerkumpul, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div>
                <div>
                    <nav class="flex flex-wrap justify-center sm:justify-start border-b border-gray-200 dark:border-gray-700"
                        aria-label="Tabs">
                        <button @click="tab = 'masjid'"
                            :class="{
                                'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': tab === 'masjid',
                                'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300': tab !== 'masjid'
                            }"
                            class="whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm -mb-[2px]">
                            Kelola Statistik Masjid
                        </button>
                        <button @click="tab = 'sejarah'"
                            :class="{
                                'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': tab === 'sejarah',
                                'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300': tab !== 'sejarah'
                            }"
                            class="whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm -mb-[2px]">
                            Kelola Sejarah Masjid
                        </button>
                        <button @click="tab = 'kajian'"
                            :class="{
                                'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': tab === 'kajian',
                                'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300': tab !== 'kajian'
                            }"
                            class="whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm -mb-[2px]">
                            Kelola Jadwal Kajian
                        </button>
                        <button @click="tab = 'donasi'"
                            :class="{
                                'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': tab === 'donasi',
                                'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300': tab !== 'donasi'
                            }"
                            class="whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm -mb-[2px]">
                            Kelola Informasi Donasi
                        </button>
                        <button @click="tab = 'donatur'"
                            :class="{
                                'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': tab === 'donatur',
                                'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-200 hover:border-gray-300': tab !== 'donatur'
                            }"
                            class="whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm -mb-[2px]">
                            Kelola Donatur
                        </button>
                    </nav>
                </div>

                <div class="py-6">
                    <!-- Konten Masjid dalam Angka -->
                    <div x-show="tab === 'masjid'" x-cloak class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">
                            Kelola Statistik Masjid
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">
                            Di sini Anda bisa mengatur data statistik masjid, misalnya jumlah jamaah, kegiatan,
                            keuangan, dan lainnya.
                        </p>

                        <!-- Contoh form/input angka -->
                        <form action="{{ route('statistik.store') }}" method="POST"
                            class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                    Jumlah Jamaah Aktif
                                </label>
                                <input type="number" name="jamaah"
                                    value="{{ old('jamaah', $statistik->jamaah ?? '') }}"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                    TPQ Aktif
                                </label>
                                <input type="number" name="tpq" value="{{ old('tpq', $statistik->tpq ?? '') }}"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                    Kajian Per Bulan
                                </label>
                                <input type="number" name="kajian"
                                    value="{{ old('kajian', $statistik->kajian ?? '') }}"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                    Program Sosial Utama
                                </label>
                                <input type="number" name="program"
                                    value="{{ old('program', $statistik->program ?? '') }}"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div class="col-span-full">
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow">
                                    Simpan Data
                                </button>
                            </div>
                        </form>

                        {{-- GARIS PEMBATAS --}}
                        <div class="border-t border-gray-200 dark:border-gray-700 my-10"></div>

                        {{-- BAGIAN BARU: FORM JADWAL IMAM --}}
                        <div>
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">
                                Kelola Jadwal Imam Harian
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-2">
                                Perbarui nama imam yang tampil di halaman depan website.
                            </p>

                            <form action="{{ route('imam.update') }}" method="POST"
                                class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                @csrf

                                {{-- Input Subuh --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                        Imam Subuh
                                    </label>
                                    <input type="text" name="subuh" value="{{ old('subuh', $imam->subuh ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Contoh: Bp. Alan Pratama">
                                </div>

                                {{-- Input Dhuhur & Ashar --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                        Imam Dhuhur & Ashar
                                    </label>
                                    <input type="text" name="dhuhur_ashar"
                                        value="{{ old('dhuhur_ashar', $imam->dhuhur_ashar ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                {{-- Input Maghrib & Isya --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                        Imam Maghrib & Isya
                                    </label>
                                    <input type="text" name="maghrib_isya"
                                        value="{{ old('maghrib_isya', $imam->maghrib_isya ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div class="col-span-full">
                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow transition">
                                        Simpan Jadwal Imam
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- GARIS PEMBATAS --}}
                        <div class="border-t border-gray-200 dark:border-gray-700 my-10"></div>

                        {{-- BAGIAN BARU: FORM JADWAL KHATIB --}}
                        <div>
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">
                                Kelola Jadwal Khatib Jum'at
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-2">
                                Tentukan nama khatib untuk setiap pekan di bulan ini.
                            </p>

                            <form action="{{ route('khatib.update') }}" method="POST"
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                                @csrf

                                {{-- Jumat 1 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Jum'at
                                        Pekan 1</label>
                                    <input type="text" name="jumat_1"
                                        value="{{ old('jumat_1', $khatib->jumat_1 ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                                </div>

                                {{-- Jumat 2 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Jum'at
                                        Pekan 2</label>
                                    <input type="text" name="jumat_2"
                                        value="{{ old('jumat_2', $khatib->jumat_2 ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                                </div>

                                {{-- Jumat 3 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Jum'at
                                        Pekan 3</label>
                                    <input type="text" name="jumat_3"
                                        value="{{ old('jumat_3', $khatib->jumat_3 ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                                </div>

                                {{-- Jumat 4 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Jum'at
                                        Pekan 4</label>
                                    <input type="text" name="jumat_4"
                                        value="{{ old('jumat_4', $khatib->jumat_4 ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500">
                                </div>

                                {{-- Jumat 5 (Opsional) --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Jum'at
                                        Pekan 5 (Jika ada)</label>
                                    <input type="text" name="jumat_5"
                                        value="{{ old('jumat_5', $khatib->jumat_5 ?? '') }}"
                                        class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500"
                                        placeholder="Kosongkan jika bulan ini hanya 4 pekan">
                                </div>

                                <div class="col-span-full">
                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow transition">
                                        Simpan Jadwal Khatib
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <!-- Tab Kelola Sejarah -->
                <div x-show="tab === 'sejarah'" x-cloak class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">

                    {{-- KELOLA TIMELINE SEJARAH --}}
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">
                        Timeline Sejarah Masjid
                    </h3>
                    {{-- Form Tambah Sejarah --}}
                    <form action="{{ route('sejarah.store') }}" method="POST"
                        class="mt-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-stretch">
                        @csrf
                        {{-- Kolom Tahun (dikecilkan) --}}
                        <div class="md:col-span-2">
                            <label for="tahun" class="block text-sm font-medium text-gray-100">Tahun</label>
                            <select name="tahun" id="tahun"
                                class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="" disabled selected>Pilih Tahun</option>
                                @for ($tahun = date('Y'); $tahun >= 1980; $tahun--)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endfor
                            </select>
                        </div>
                        {{-- Kolom Deskripsi (memperlebar sisa ruang) --}}
                        <div class="md:col-span-8">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-100">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi"
                                class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
                                required>
                        </div>
                        {{-- Kolom Tombol --}}
                        <div class="md:col-span-2 flex items-end">
                            <button type="submit"
                                class="w-full h-10 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Tambah</button>
                        </div>
                    </form>

                    {{-- Tabel Data Sejarah --}}
                    <div class="mt-6">

                        {{-- DESKTOP VIEW --}}
                        <div class="hidden sm:block overflow-x-auto rounded-lg shadow-sm">
                            <table class="w-full border-collapse text-sm text-gray-200">
                                <thead class="bg-indigo-600 text-white text-xs uppercase">
                                    <tr>
                                        <th class="px-6 py-3 text-left font-bold">Tahun</th>
                                        <th class="px-6 py-3 text-left font-bold">Deskripsi</th>
                                        <th class="px-6 py-3 text-center font-bold">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-700">
                                    @foreach ($sejarah as $item)
                                        <tr x-data="{ openModal: false }">

                                            {{-- Tahun --}}
                                            <td class="px-6 py-3">{{ $item->tahun }}</td>

                                            {{-- Deskripsi --}}
                                            <td class="px-6 py-3">{{ $item->deskripsi }}</td>

                                            {{-- Aksi --}}
                                            <td class="px-6 py-3 text-center">
                                                <div class="flex justify-center gap-2">

                                                    {{-- EDIT --}}
                                                    <button @click="openModal = true"
                                                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-md text-xs">
                                                        Edit
                                                    </button>

                                                    {{-- DELETE --}}
                                                    <form action="{{ route('sejarah.destroy', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin hapus data ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- 📱 MOBILE VIEW (MATCH ORGANISASI STYLE) --}}
                        <div class="sm:hidden space-y-3 mt-3">
                            @foreach ($sejarah as $item)
                                <div x-data="{ openMobileModal: false }"
                                    class="p-4 bg-white dark:bg-gray-800 rounded-lg border dark:border-gray-600 shadow-sm">

                                    {{-- Tahun --}}
                                    <p class="text-xs text-gray-400">Tahun</p>
                                    <p class="text-lg font-semibold text-white">{{ $item->tahun }}</p>

                                    {{-- Deskripsi --}}
                                    <p class="text-xs text-gray-400 mt-3">Deskripsi</p>
                                    <p class="text-gray-300">{{ $item->deskripsi }}</p>

                                    {{-- ACTION BUTTONS --}}
                                    <div class="flex gap-2 mt-4">
                                        {{-- Edit --}}
                                        <button @click="openMobileModal=true"
                                            class="bg-yellow-600 hover:bg-yellow-700 text-white w-1/2 px-3 py-2 rounded-md text-sm">
                                            Edit
                                        </button>

                                        {{-- Delete --}}
                                        <form action="{{ route('sejarah.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')" class="w-1/2">
                                            @csrf @method('DELETE')
                                            <button
                                                class="bg-red-600 hover:bg-red-700 text-white w-full px-3 py-2 rounded-md text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>

                                    {{-- MODAL MOBILE (SAMA FORMATNYA DENGAN ORGANISASI) --}}
                                    <div x-show="openMobileModal" x-cloak
                                        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">

                                        <div class="bg-gray-800 p-6 rounded-lg w-11/12 max-w-md text-white shadow-lg">

                                            <h3 class="text-lg font-semibold mb-4 text-center">Edit Timeline Sejarah
                                            </h3>

                                            <form action="{{ route('sejarah.update', $item->id) }}" method="POST"
                                                class="space-y-3">
                                                @csrf @method('PUT')

                                                {{-- Tahun --}}
                                                <label class="text-sm">Tahun</label>
                                                <select name="tahun"
                                                    class="w-full p-3 rounded-md bg-gray-700 border border-gray-600 focus:ring-indigo-500 text-sm">
                                                    @for ($tahun = date('Y'); $tahun >= 1980; $tahun--)
                                                        <option value="{{ $tahun }}"
                                                            {{ $item->tahun == $tahun ? 'selected' : '' }}>
                                                            {{ $tahun }}
                                                        </option>
                                                    @endfor
                                                </select>

                                                {{-- Deskripsi --}}
                                                <label class="text-sm">Deskripsi</label>
                                                <textarea name="deskripsi" rows="4" class="w-full p-3 rounded-md bg-gray-700 border border-gray-600 text-sm">{{ $item->deskripsi }}</textarea>

                                                <div class="flex justify-end gap-2 pt-3">
                                                    <button @click="openMobileModal=false" type="button"
                                                        class="px-4 py-2 bg-gray-600 rounded-md text-sm">
                                                        Batal
                                                    </button>
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-md text-sm">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="my-8 border-t border-gray-300 dark:border-gray-600"></div>

                    {{-- UPLOAD GALERI --}}
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">
                        Upload Galeri Kegiatan Masjid
                    </h3>
                    <form action="{{ route('galeri.upload') }}" method="POST" enctype="multipart/form-data"
                        class="mt-4" x-data="{ fileSelected: false, fileName: '' }">
                        @csrf
                        <input type="file" name="gambar[]" id="galeriInput" class="hidden" multiple
                            @change="fileSelected = $event.target.files.length > 0; 
                                fileName = Array.from($event.target.files).map(f => f.name).join(', ')">
                        <button type="button" onclick="document.getElementById('galeriInput').click()"
                            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Pilih
                            Foto</button>
                        <span x-text="fileName" class="ml-3 text-white"></span>
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 ml-3"
                            x-show="fileSelected" x-transition>Upload</button>
                    </form>

                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Galeri Kegiatan Terbaru
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {{-- Menggunakan variabel $galeri dari controller --}}
                            @foreach ($galeri as $item)
                                <div class="border rounded p-2 relative">
                                    <img src="{{ asset($item->gambar) }}" alt="Galeri Kegiatan"
                                        class="rounded w-full h-40 object-cover">
                                    <form action="{{ route('galeri.destroy', $item->id) }}" method="POST"
                                        class="absolute top-2 right-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">Hapus</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-8 mb-2 border-t border-gray-300 dark:border-gray-600"></div>

                    {{-- MANAGEMENT STRUKTUR ORGANISASI --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg mb-6 mt-6">
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-4">
                            Tambah Pengurus Masjid
                        </h3>

                        {{-- Form Input --}}
                        {{-- Form Input --}}
                        <form action="{{ route('organisasi.store') }}" method="POST"
                            class="space-y-4 md:grid md:grid-cols-3 md:gap-4 md:space-y-0">
                            @csrf

                            {{-- Input Nama --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Nama Lengkap
                                </label>
                                <input type="text" name="nama" required
                                    placeholder="Contoh: Bp. Drs. Dwi Sudiarso"
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            {{-- Select Divisi / Posisi --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Posisi / Bagian
                                </label>
                                <select name="divisi" required
                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" disabled selected>Pilih Posisi</option>

                                    <optgroup label="Pimpinan">
                                        <option value="Penasehat">Penasehat</option>
                                        <option value="Ketua">Ketua</option>
                                        <option value="Wakil Ketua">Wakil Ketua</option>
                                        <option value="Sekretaris">Sekretaris</option>
                                        <option value="Bendahara">Bendahara</option>
                                    </optgroup>

                                    <optgroup label="Bidang Kerja">
                                        <option value="Seksi Dakwah">Seksi Dakwah</option>
                                        <option value="Seksi Pembangunan">Seksi Pembangunan</option>
                                        <option value="Seksi Pemuda & Kader">Seksi Pemuda & Kader</option>
                                        <option value="Seksi Rumah Tangga">Seksi Rumah Tangga</option>
                                        <option value="Seksi Sosial">Seksi Sosial</option>
                                        <option value="Seksi Keamanan">Seksi Keamanan</option>
                                        <option value="Seksi Keputrian">Seksi Keputrian</option>
                                    </optgroup>
                                </select>
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="flex items-end">
                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md">
                                    Tambah Pengurus
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    {{-- Tabel Daftar Pengurus --}}
                    @if ($organisasi->isEmpty())
                        {{-- TAMPILAN JIKA KOSONG --}}
                        <div class="p-10 text-center">
                            <div class="flex justify-center mb-4">
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Belum ada data pengurus</h3>
                            <p class="mt-1 text-gray-500 dark:text-gray-400">Data pengurus belum ditambahkan. Silakan
                                isi form di atas.
                            </p>
                        </div>
                    @else
                        {{-- TAMPILAN JIKA ADA DATA (TABEL & LIST) --}}
                        <div class="overflow-hidden bg-white dark:bg-gray-800 rounded-lg shadow">

                            {{-- DESKTOP VIEW --}}
                            <div class="hidden md:block overflow-x-auto">

                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-white uppercase bg-indigo-600">
                                        <tr>
                                            <th class="px-6 py-3">Nama Pengurus</th>
                                            <th class="px-6 py-3">Posisi / Bagian</th>
                                            <th class="px-6 py-3 text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($organisasi as $item)
                                            <tr x-data="{ showEditModal: false }">
                                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                                    {{ $item->nama }}</td>
                                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                                    {{ $item->divisi }}</td>

                                                <td class="px-6 py-4 text-center">
                                                    <div class="flex gap-2 justify-center">

                                                        {{-- EDIT BUTTON --}}
                                                        <button @click="showEditModal = true"
                                                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-md text-sm shadow">
                                                            Edit
                                                        </button>

                                                        {{-- DELETE --}}
                                                        <form action="{{ route('organisasi.destroy', $item->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin hapus data ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm shadow">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>

                                                    {{-- MODAL DESKTOP --}}
                                                    <div x-show="showEditModal" x-cloak
                                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

                                                        <div
                                                            class="bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg text-left">

                                                            <h3 class="text-lg font-semibold text-white mb-6">Edit
                                                                Pengurus
                                                            </h3>

                                                            <form
                                                                action="{{ route('organisasi.update', ['organisasi' => $item->id]) }}"
                                                                method="POST" class="space-y-4">
                                                                @csrf
                                                                @method('PUT')

                                                                <div>
                                                                    <label
                                                                        class="block text-sm text-gray-300 mb-1">Nama</label>
                                                                    <input type="text" name="nama"
                                                                        value="{{ $item->nama }}" required
                                                                        class="w-full rounded-md dark:bg-gray-700 dark:text-white border-gray-600">
                                                                </div>

                                                                <div>
                                                                    <label
                                                                        class="block text-sm text-gray-300 mb-1">Posisi
                                                                        / Bagian</label>
                                                                    <select name="divisi" required
                                                                        class="w-full rounded-md dark:bg-gray-700 dark:text-white border-gray-600">
                                                                        <optgroup label="Pimpinan">
                                                                            <option value="Penasehat"
                                                                                {{ $item->divisi == 'Penasehat' ? 'selected' : '' }}>
                                                                                Penasehat
                                                                            </option>
                                                                            <option value="Ketua"
                                                                                {{ $item->divisi == 'Ketua' ? 'selected' : '' }}>
                                                                                Ketua
                                                                            </option>
                                                                            <option value="Wakil Ketua"
                                                                                {{ $item->divisi == 'Wakil Ketua' ? 'selected' : '' }}>
                                                                                Wakil
                                                                                Ketua</option>
                                                                            <option value="Sekretaris"
                                                                                {{ $item->divisi == 'Sekretaris' ? 'selected' : '' }}>
                                                                                Sekretaris
                                                                            </option>
                                                                            <option value="Bendahara"
                                                                                {{ $item->divisi == 'Bendahara' ? 'selected' : '' }}>
                                                                                Bendahara
                                                                            </option>
                                                                        </optgroup>

                                                                        <optgroup label="Bidang Kerja">
                                                                            <option value="Seksi Dakwah"
                                                                                {{ $item->divisi == 'Seksi Dakwah' ? 'selected' : '' }}>
                                                                                Seksi
                                                                                Dakwah</option>
                                                                            <option value="Seksi Pembangunan"
                                                                                {{ $item->divisi == 'Seksi Pembangunan' ? 'selected' : '' }}>
                                                                                Seksi Pembangunan</option>
                                                                            <option value="Seksi Pemuda & Kader"
                                                                                {{ $item->divisi == 'Seksi Pemuda & Kader' ? 'selected' : '' }}>
                                                                                Seksi Pemuda & Kader</option>
                                                                            <option value="Seksi Rumah Tangga"
                                                                                {{ $item->divisi == 'Seksi Rumah Tangga' ? 'selected' : '' }}>
                                                                                Seksi Rumah Tangga</option>
                                                                            <option value="Seksi Sosial"
                                                                                {{ $item->divisi == 'Seksi Sosial' ? 'selected' : '' }}>
                                                                                Seksi
                                                                                Sosial</option>
                                                                            <option value="Seksi Keamanan"
                                                                                {{ $item->divisi == 'Seksi Keamanan' ? 'selected' : '' }}>
                                                                                Seksi
                                                                                Keamanan</option>
                                                                            <option value="Seksi Keputrian"
                                                                                {{ $item->divisi == 'Seksi Keputrian' ? 'selected' : '' }}>
                                                                                Seksi
                                                                                Keputrian</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>

                                                                <div class="flex justify-end gap-3 pt-4">
                                                                    <button type="button"
                                                                        @click="showEditModal = false"
                                                                        class="px-4 py-2 rounded-md bg-gray-600 hover:bg-gray-700 text-white">Batal</button>
                                                                    <button type="submit"
                                                                        class="px-4 py-2 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- 📱 MOBILE VIEW --}}
                            <div class="sm:hidden space-y-3 mt-3">
                                @foreach ($organisasi as $item)
                                    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border dark:border-gray-600 shadow-sm"
                                        x-data="{ openModal: false }">

                                        <p class="text-xs text-gray-400">Nama Pengurus</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $item->nama }}</p>

                                        <p class="text-xs text-gray-400 mt-2">Posisi / Bagian</p>
                                        <p class="text-gray-700 dark:text-gray-300">{{ $item->divisi }}</p>

                                        <div class="flex gap-2 mt-4">
                                            {{-- Edit Button --}}
                                            <button @click="openModal=true"
                                                class="w-1/2 bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 text-sm font-medium rounded-lg transition">
                                                Edit
                                            </button>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('organisasi.destroy', $item->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus data ini?')"
                                                class="w-1/2">
                                                @csrf @method('DELETE')
                                                <button
                                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm font-medium rounded-lg transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>

                                        {{-- MOBILE MODAL --}}
                                        <div x-show="openModal" x-cloak
                                            class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                                            <div class="bg-gray-800 p-6 rounded-lg w-11/12 max-w-sm text-white">
                                                <h3 class="text-lg font-semibold mb-4">Edit Pengurus</h3>

                                                <form action="{{ route('organisasi.update', $item->id) }}"
                                                    method="POST" class="space-y-3">
                                                    @csrf @method('PUT')

                                                    <input type="text" name="nama" value="{{ $item->nama }}"
                                                        class="w-full dark:bg-gray-700 border border-gray-600 rounded p-2">

                                                    <select name="divisi"
                                                        class="w-full dark:bg-gray-700 border border-gray-600 rounded p-2">
                                                        <optgroup label="Pimpinan">
                                                            <option value="Penasehat"
                                                                {{ $item->divisi == 'Penasehat' ? 'selected' : '' }}>
                                                                Penasehat
                                                            </option>
                                                            <option value="Ketua"
                                                                {{ $item->divisi == 'Ketua' ? 'selected' : '' }}>Ketua
                                                            </option>
                                                            <option value="Wakil Ketua"
                                                                {{ $item->divisi == 'Wakil Ketua' ? 'selected' : '' }}>
                                                                Wakil
                                                                Ketua</option>
                                                            <option value="Sekretaris"
                                                                {{ $item->divisi == 'Sekretaris' ? 'selected' : '' }}>
                                                                Sekretaris
                                                            </option>
                                                            <option value="Bendahara"
                                                                {{ $item->divisi == 'Bendahara' ? 'selected' : '' }}>
                                                                Bendahara
                                                            </option>
                                                        </optgroup>
                                                        <optgroup label="Bidang Kerja">
                                                            <option value="Seksi Dakwah"
                                                                {{ $item->divisi == 'Seksi Dakwah' ? 'selected' : '' }}>
                                                                Seksi
                                                                Dakwah</option>
                                                            <option value="Seksi Pembangunan"
                                                                {{ $item->divisi == 'Seksi Pembangunan' ? 'selected' : '' }}>
                                                                Seksi Pembangunan</option>
                                                            <option value="Seksi Pemuda & Kader"
                                                                {{ $item->divisi == 'Seksi Pemuda & Kader' ? 'selected' : '' }}>
                                                                Seksi Pemuda & Kader</option>
                                                            <option value="Seksi Rumah Tangga"
                                                                {{ $item->divisi == 'Seksi Rumah Tangga' ? 'selected' : '' }}>
                                                                Seksi Rumah Tangga</option>
                                                            <option value="Seksi Sosial"
                                                                {{ $item->divisi == 'Seksi Sosial' ? 'selected' : '' }}>
                                                                Seksi
                                                                Sosial</option>
                                                            <option value="Seksi Keamanan"
                                                                {{ $item->divisi == 'Seksi Keamanan' ? 'selected' : '' }}>
                                                                Seksi
                                                                Keamanan</option>
                                                            <option value="Seksi Keputrian"
                                                                {{ $item->divisi == 'Seksi Keputrian' ? 'selected' : '' }}>
                                                                Seksi
                                                                Keputrian</option>
                                                        </optgroup>
                                                    </select>

                                                    <div class="flex justify-end gap-2">
                                                        <button type="button" @click="openModal=false"
                                                            class="px-3 py-1 bg-gray-600 rounded">Batal</button>
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-indigo-600 rounded">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div x-show="tab === 'kajian'" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm space-y-6">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Tambah Jadwal Kajian</h3>

                    <!-- Form tambah -->
                    <form action="{{ route('kajian.store') }}" method="POST"
                        class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8"> {{-- gap antar kolom & jarak ke tabel --}}
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Tanggal</label>
                            <input type="date" name="hari"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 custom-date-icon">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Waktu</label>
                            <input type="text" name="waktu"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Tema</label>
                            <input type="text" name="tema"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Pemateri</label>
                            <input type="text" name="pemateri"
                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="col-span-full">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow">
                                Tambah
                            </button>
                        </div>
                    </form>

                    <!-- Tabel Jadwal Kajian -->
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg shadow-sm overflow-hidden">
                            <thead class="bg-indigo-600 text-white hidden sm:table-header-group">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                        Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                        Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                        Tema
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                        Pemateri</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold tracking-wider uppercase">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach ($kajian as $item)
                                    <tr class="block sm:table-row mb-4 sm:mb-0">
                                        <td class="sm:table-cell block px-6 py-2 text-gray-100">
                                            <span class="font-semibold sm:hidden text-gray-100">Tanggal: </span>
                                            {{ \Carbon\Carbon::parse($item->hari)->locale('id')->translatedFormat('j F Y') }}
                                        </td>
                                        <td class="sm:table-cell block px-6 py-2 text-gray-100">
                                            <span class="font-semibold sm:hidden text-gray-100">Waktu: </span>
                                            {{ $item->waktu }}
                                        </td>
                                        <td class="sm:table-cell block px-6 py-2 text-gray-100">
                                            <span class="font-semibold sm:hidden text-gray-100">Tema: </span>
                                            {{ $item->tema }}
                                        </td>
                                        <td class="sm:table-cell block px-6 py-2 text-gray-100">
                                            <span class="font-semibold sm:hidden text-gray-100">Pemateri: </span>
                                            {{ $item->pemateri }}
                                        </td>
                                        <td class="sm:table-cell block px-6 py-2 text-gray-100">
                                            <div class="flex flex-col sm:flex-row gap-2 mt-2 justify-center">
                                                <!-- Tombol Edit -->
                                                <button onclick="openModal('editModal-{{ $item->id }}')"
                                                    class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-md text-sm shadow text-center">
                                                    Edit
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('kajian.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin hapus data ini?')"
                                                    class="w-full sm:w-auto">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm shadow text-center">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Modal Edit Khusus Item Ini -->
                                            <div id="editModal-{{ $item->id }}"
                                                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                                                <div
                                                    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg">
                                                    <h3
                                                        class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                                                        Edit Jadwal Kajian
                                                    </h3>

                                                    <form action="{{ route('kajian.update', $item->id) }}"
                                                        method="POST" class="space-y-5">
                                                        @csrf
                                                        @method('PUT')

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-900 dark:text-white mb-2 mt-3 ">Tanggal</label>
                                                            <input type="date" name="hari"
                                                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 custom-date-icon"
                                                                value="{{ \Carbon\Carbon::parse($item->hari)->format('Y-m-d') }}">
                                                        </div>

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-900 dark:text-white mb-2 mt-3">Waktu</label>
                                                            <input type="text" name="waktu"
                                                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                                                                value="{{ $item->waktu }}">
                                                        </div>

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-900 dark:text-white mb-2 mt-3">Tema</label>
                                                            <input type="text" name="tema"
                                                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                                                                value="{{ $item->tema }}">
                                                        </div>

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-900 dark:text-white mb-2 mt-3">Pemateri</label>
                                                            <input type="text" name="pemateri"
                                                                class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                                                                value="{{ $item->pemateri }}">
                                                        </div>

                                                        <div class="flex justify-end gap-3 pt-4">
                                                            <button type="button"
                                                                onclick="closeModal('editModal-{{ $item->id }}')"
                                                                class="px-4 py-2 rounded-md bg-gray-500 hover:bg-gray-600 text-white shadow">
                                                                Batal
                                                            </button>
                                                            <button type="submit"
                                                                class="px-4 py-2 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white shadow">
                                                                Simpan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="tab === 'donasi'" x-cloak
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm space-y-8">

                    {{-- Form Kelola Rekening --}}
                    <div>
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Kelola Informasi
                            Rekening</h3>
                        <form action="{{ route('donasi.rekening.update') }}" method="POST"
                            enctype="multipart/form-data"
                            class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-100">Nama Bank</label>
                                <input type="text" name="nama_bank"
                                    value="{{ old('nama_bank', $rekening->nama_bank ?? '') }}"
                                    class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100">Nomor Rekening</label>
                                <input type="text" name="nomor_rekening"
                                    value="{{ old('nomor_rekening', $rekening->nomor_rekening ?? '') }}"
                                    class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-100">Atas Nama</label>
                                <input type="text" name="atas_nama"
                                    value="{{ old('atas_nama', $rekening->atas_nama ?? '') }}"
                                    class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white">
                            </div>
                            <div class="col-span-full">
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Simpan
                                    Informasi Rekening</button>
                            </div>
                        </form>
                    </div>

                    <div class="border-t border-gray-600"></div>

                    <div class="mt-8" x-data="{ kategoriFilter: '' }">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-2 gap-4">

                            {{-- Judul Tabel --}}
                            <h4 class="font-semibold text-gray-100 text-lg">Daftar Konfirmasi Donasi</h4>

                            {{-- Dropdown Filter (Tanpa Form Submit) --}}
                            <div class="w-full sm:w-auto">
                                <div class="flex items-center space-x-2">

                                    {{-- PERUBAHAN DI SINI --}}
                                    <span class="text-base text-gray-300 hidden sm:block whitespace-nowrap">Pilih
                                        Kategori:</span>

                                    {{-- x-model akan mengubah nilai 'kategoriFilter' secara realtime --}}
                                    <select x-model="kategoriFilter"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-pointer">

                                        <option value="">Semua Kategori</option>
                                        <option value="pintu_surga">Pintu Surga</option>
                                        <option value="bmt">BMT</option>
                                        <option value="jumat">Jum'at</option>
                                        <option value="kebersihan">Kebersihan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse rounded-lg shadow-sm overflow-hidden">
                                <thead class="bg-indigo-600 text-white hidden sm:table-header-group">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                            Tanggal Konfirmasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                            Donatur</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                            No. WA</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                            Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                            Nominal</th>
                                        <th class="px-6 py-3 text-center text-xs font-bold tracking-wider uppercase">
                                            Bukti TF</th>
                                        <th class="px-6 py-3 text-center text-xs font-bold tracking-wider uppercase">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">

                                    @forelse($konfirmasiDonasi as $konfirmasi)
                                        {{-- LOGIKA ALPINE JS DI SINI --}}
                                        {{-- Baris akan TAMPIL jika filter kosong ATAU filter cocok dengan kategori data --}}
                                        <tr class="block sm:table-row mb-4 sm:mb-0 transition-all duration-300"
                                            x-show="kategoriFilter === '' || kategoriFilter === '{{ $konfirmasi->kategori }}'">

                                            {{-- KOLOM: TANGGAL --}}
                                            <td class="sm:table-cell block px-6 py-2 text-gray-200">
                                                <span class="font-semibold sm:hidden">Tanggal: </span>
                                                {{ \Carbon\Carbon::parse($konfirmasi->created_at)->locale('id')->isoFormat('D MMM Y') }}
                                            </td>

                                            {{-- KOLOM NAMA DONATUR --}}
                                            <td class="sm:table-cell block px-6 py-2 text-gray-200">
                                                <span class="font-semibold sm:hidden">Donatur: </span>
                                                {{ $konfirmasi->donatur->nama ?? 'N/A' }}
                                            </td>

                                            {{-- KOLOM NO. WA --}}
                                            <td class="sm:table-cell block px-6 py-2 text-gray-200">
                                                <span class="font-semibold sm:hidden">No. WA: </span>
                                                {{ $konfirmasi->donatur->no_wa ?? 'N/A' }}
                                            </td>

                                            {{-- KOLOM KATEGORI --}}
                                            <td class="sm:table-cell block px-6 py-2 text-gray-200">
                                                <span class="font-semibold sm:hidden">Kategori: </span>
                                                {{ ucwords(str_replace('_', ' ', $konfirmasi->kategori)) }}
                                            </td>

                                            {{-- KOLOM NOMINAL --}}
                                            <td class="sm:table-cell block px-6 py-2 text-gray-200">
                                                <span class="font-semibold sm:hidden">Nominal: </span>
                                                Rp {{ number_format($konfirmasi->nominal, 0, ',', '.') }}
                                            </td>

                                            {{-- KOLOM BUKTI TF --}}
                                            <td class="sm:table-cell block px-6 py-2 text-center">
                                                <a href="{{ asset('storage/' . $konfirmasi->bukti_tf) }}"
                                                    target="_blank"
                                                    class="text-indigo-400 hover:text-indigo-300 underline text-sm">
                                                    Lihat Bukti
                                                </a>
                                            </td>

                                            {{-- KOLOM AKSI --}}
                                            <td class="sm:table-cell block px-6 py-2 text-center">
                                                <div class="flex flex-col sm:flex-row gap-2 mt-2 justify-center">

                                                    {{-- Tombol Edit --}}
                                                    <button onclick="openModal('editModal-{{ $konfirmasi->id }}')"
                                                        class="w-full sm:w-auto bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-md text-sm shadow text-center">
                                                        Edit
                                                    </button>

                                                    {{-- Tombol Hapus --}}
                                                    <form
                                                        action="{{ route('donasi.konfirmasi.destroy', $konfirmasi->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin tolak/hapus konfirmasi ini?')"
                                                        class="w-full sm:w-auto">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm shadow text-center">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>

                                                {{-- Modal Edit --}}
                                                <div id="editModal-{{ $konfirmasi->id }}"
                                                    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                                                    <div
                                                        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg text-left">
                                                        {{-- ← tambahkan text-left --}}

                                                        <h3
                                                            class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                                                            Edit Konfirmasi Donasi
                                                        </h3>

                                                        <form
                                                            action="{{ route('donasi.konfirmasi.update', $konfirmasi->id) }}"
                                                            method="POST" class="space-y-5">
                                                            @csrf
                                                            @method('PUT')

                                                            {{-- Nama Donatur --}}
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                                                    Nama Donatur
                                                                </label>
                                                                <input type="text" name="nama"
                                                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                                                                    value="{{ $konfirmasi->donatur->nama ?? '' }}">
                                                            </div>

                                                            {{-- Nomor WA --}}
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                                                    Nomor WA
                                                                </label>
                                                                <input type="text" name="no_wa"
                                                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                                                                    value="{{ $konfirmasi->donatur->no_wa ?? '' }}">
                                                            </div>

                                                            {{-- Nominal --}}
                                                            <div>
                                                                <label
                                                                    class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                                                    Nominal Donasi
                                                                </label>

                                                                <input type="text" name="nominal"
                                                                    id="nominal-{{ $konfirmasi->id }}"
                                                                    class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"
                                                                    value="{{ number_format($konfirmasi->nominal, 0, ',', '.') }}"
                                                                    oninput="formatRupiah(this)">
                                                            </div>

                                                            {{-- Tombol --}}
                                                            <div class="flex justify-end gap-3 pt-4">
                                                                <button type="button"
                                                                    onclick="closeModal('editModal-{{ $konfirmasi->id }}')"
                                                                    class="px-4 py-2 rounded-md bg-gray-500 hover:bg-gray-600 text-white shadow">
                                                                    Batal
                                                                </button>
                                                                <button type="submit"
                                                                    class="px-4 py-2 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white shadow">
                                                                    Simpan
                                                                </button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>

                                                {{-- End Modal --}}
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-gray-400">
                                                Belum ada data konfirmasi donasi sama sekali.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'donatur'" x-cloak class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">

                    {{-- 1. Judul diubah warnanya agar terlihat di card --}}
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Daftar Akun Donatur
                        (Jamaah)</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse rounded-lg shadow-sm overflow-hidden">
                            <thead class="bg-indigo-600 text-white hidden sm:table-header-group">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">Nama
                                        Donatur</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">No.
                                        WhatsApp</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                                        Tanggal Terdaftar</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold tracking-wider uppercase">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">

                                @forelse($donaturs as $donatur)
                                    <tr class="block sm:table-row mb-4 sm:mb-0">

                                        {{-- 2. Warna teks diubah agar terbaca di mode terang & gelap --}}
                                        <td class="sm:table-cell block px-6 py-2 text-gray-900 dark:text-gray-200">
                                            {{-- 3. Warna label mobile juga diubah --}}
                                            <span
                                                class="font-semibold sm:hidden text-gray-600 dark:text-gray-400">Nama:
                                            </span>
                                            {{ $donatur->nama }}
                                        </td>

                                        <td class="sm:table-cell block px-6 py-2 text-gray-900 dark:text-gray-200">
                                            <span class="font-semibold sm:hidden text-gray-600 dark:text-gray-400">No.
                                                WA: </span>
                                            {{ $donatur->no_wa }}
                                        </td>

                                        <td class="sm:table-cell block px-6 py-2 text-gray-900 dark:text-gray-200">
                                            <span
                                                class="font-semibold sm:hidden text-gray-600 dark:text-gray-400">Terdaftar:
                                            </span>
                                            {{ $donatur->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                                        </td>

                                        <td class="sm:table-cell block px-6 py-2 text-center">
                                            <div class="flex flex-col sm:flex-row gap-2 mt-2 justify-center">
                                                <form action="{{ route('donatur.destroy', $donatur->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin hapus akun donatur ini? Tindakan ini tidak bisa dibatalkan.')"
                                                    class="w-full sm:w-auto">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm shadow text-center">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                                            Belum ada donatur yang mendaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }

        function formatRupiah(input) {
            let angka = input.value.replace(/\D/g, ""); // hapus semua selain angka
            input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // tambahkan titik tiap 3 digit
        }
    </script>

</x-app-layout>
