<x-app-layout>
    {{-- ========================================================== --}}
    {{--            SLOT NAVIGASI KUSTOM (DIKOSONGKAN)            --}}
    {{-- ========================================================== --}}
    <x-slot name="navigation">
        {{-- Slot ini sengaja dikosongkan agar tidak ada navbar --}}
    </x-slot>
    {{-- ========================================================== --}}


    {{-- Wrapper konten utama --}}
    <div class="pt-12">
        {{-- Container terluar (lebar) untuk padding di layar besar --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ========================================================== --}}
            {{--     WRAPPER KONTEN (SEKARANG MENJADI max-w-2xl)     --}}
            {{-- ========================================================== --}}
            {{-- Semua konten (header & kartu) dimasukkan ke dalam div ini --}}
            <div class="max-w-2xl mx-auto">

                {{-- 1. Header Kustom (Tombol Back & Nama) --}}
                <div class="flex justify-between items-center mb-8">
                    {{-- Kiri: Tombol Back --}}
                    <div>
                        <a href="{{ route('donasi') }}" {{-- DIUBAH: text-sm menjadi text-base --}}
                            class="inline-flex items-center text-base font-medium text-indigo-500 hover:text-indigo-800 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 me-1.5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Kembali ke Halaman Donasi
                        </a>
                    </div>

                    {{-- Kanan: Nama Donatur --}}
                    @if (session('donatur_nama'))
                        <div class="flex items-center">
                            {{-- DIUBAH: text-sm menjadi text-base --}}
                            <span
                                class="inline-flex items-center text-base font-medium text-gray-700 dark:text-gray-900">
                                Selamat Datang, <strong class="ms-1">{{ session('donatur_nama') }}</strong>
                            </span>
                        </div>
                    @endif
                </div>

                {{-- 2. Bagian 1: Info Rekening --}}
                {{-- (Class max-w-2xl dan padding luar dihapus dari sini) --}}
                <section id="donasi-rekening" class="text-center">
                    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 text-center">Salurkan Donasi Anda</h2>
                        <p class="text-base text-gray-600 mt-2 text-center">
                            Silakan transfer ke rekening resmi masjid di bawah ini:
                        </p>

                        @if ($rekening)
                            {{-- Box Info Rekening --}}
                            <div
                                class="mt-6 bg-gradient-to-r from-indigo-50 to-indigo-100 p-5 rounded-xl shadow-inner transition">
                                <p class="text-sm text-gray-500 uppercase tracking-wide font-sans">
                                    {{ $rekening->nama_bank }}</p>
                                <p class="text-3xl font-mono tracking-widest text-indigo-700 my-3 select-all">
                                    {{ $rekening->nomor_rekening }}
                                </p>
                                <p class="font-semibold text-gray-800 font-sans">a.n. {{ $rekening->atas_nama }}</p>
                            </div>

                            {{-- QRIS jika ada --}}
                            @if ($rekening->qris_image)
                                <div class="mt-6">
                                    <p class="text-base text-gray-600 mb-2 font-sans">Atau pindai QRIS di bawah ini:</p>
                                    <div class="bg-gray-50 inline-block p-3 rounded-xl shadow">
                                        <img src="{{ asset('storage/' . $rekening->qris_image) }}" alt="QRIS Donasi"
                                            class="mx-auto rounded-md w-48 h-48 object-cover">
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="mt-4 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                                <p class="font-semibold text-yellow-800 font-sans">
                                    ⚠️ Informasi rekening belum diatur oleh admin.
                                </p>
                            </div>
                        @endif
                    </div>
                </section>

                {{-- 3. Bagian 2: Form Konfirmasi --}}
                <section class="pt-8 pb-12">
                    {{-- (Class max-w-2xl dan padding luar dihapus dari sini) --}}
                    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 text-left">
                        <h2 class="text-2xl font-bold text-gray-900 text-center">Konfirmasi Donasi Anda</h2>
                        <p class="text-base text-gray-600 text-center mb-6">Setelah berhasil transfer, mohon isi form di
                            bawah ini untuk verifikasi.</p>

                        @if (session('success'))
                            <div class="bg-green-100 text-indigo-500 p-3 rounded mb-4 text-sm font-sans">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm font-sans">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('konfirmasi.donasi.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                {{-- Kategori Donasi --}}
                                <div>
                                    <label for="kategori"
                                        class="block text-sm font-medium text-gray-700 font-sans">Kategori
                                        Donasi</label>
                                    <select id="kategori" name="kategori" required
                                        class="font-sans mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="pintu_surga" @if (old('kategori') == 'pintu_surga') selected @endif>
                                            Pintu Surga (Pembangunan)</option>
                                        <option value="bmt" @if (old('kategori') == 'bmt') selected @endif>BMT
                                            (Santunan & Sosial)</option>
                                        <option value="jumat" @if (old('kategori') == 'jumat') selected @endif>Sholat
                                            Jum'at (Operasional)</option>
                                        <option value="kebersihan" @if (old('kategori') == 'kebersihan') selected @endif>
                                            Kebersihan</option>
                                    </select>
                                    @error('kategori')
                                        <p class="text-red-500 text-xs mt-1 font-sans">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Nominal --}}
                                <div>
                                    <label for="nominal"
                                        class="block text-sm font-medium text-gray-700 font-sans">Nominal (Rp)</label>
                                    <input type="number" id="nominal" name="nominal" value="{{ old('nominal') }}"
                                        required
                                        class="font-sans mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Contoh: 50000">
                                    @error('nominal')
                                        <p class="text-red-500 text-xs mt-1 font-sans">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Bukti Transfer --}}
                                <div>
                                    <label for="bukti_tf"
                                        class="block text-sm font-medium text-gray-700 font-sans">Upload Bukti
                                        Transfer</label>
                                    <input type="file" id="bukti_tf" name="bukti_tf" required
                                        class="font-sans mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-gray-100 file:border-0 file:px-4 file:py-2 file:mr-3 file:text-sm file:font-medium file:text-gray-700 hover:file:bg-gray-200">
                                    @error('bukti_tf')
                                        <p class="text-red-500 text-xs mt-1 font-sans">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="font-sans w-full bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-3 rounded-lg font-semibold transition">
                                    Kirim Konfirmasi
                                </button>
                            </div>
                        </form>
                    </div>
            </div>
            </section>

        </div> {{-- Penutup 'max-w-2xl' --}}

    </div> {{-- Penutup 'max-w-7xl' --}}
    </div> {{-- Penutup 'pt-12' --}}

</x-app-layout>
