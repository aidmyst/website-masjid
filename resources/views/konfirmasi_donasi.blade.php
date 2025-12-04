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
                {{-- 1. Header Kustom (Tombol Back & Nama) --}}
                {{-- Container Utama: Menggunakan flex-row (sebaris) & flex-wrap (agar aman jika nama panjang) --}}
                {{-- Container Utama: Flex Row & Wrap --}}
                <div class="flex flex-row flex-wrap items-center justify-between gap-4 mb-6 sm:mb-8">

                    {{-- 1. TOMBOL BACK (Kiri) --}}
                    <div class="mb-0">
                        <a href="{{ route('donasi') }}" dir="ltr"
                            class="inline-flex flex-row items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-xl shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors">

                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>

                    {{-- 2. NAMA DONATUR --}}
                    {{-- Mobile: Pindah ke baris baru (w-full) & Rata Kiri (text-left) --}}
                    {{-- Desktop: Lebar otomatis (sm:w-auto) & Rata Kanan (sm:text-right) --}}
                    @if (isset($namaDonatur))
                        <div class="w-full sm:w-auto text-left sm:text-right">
                            <div class="bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm inline-block">
                                <span class="text-gray-500 text-xs sm:text-sm block sm:inline mb-0">
                                    Selamat Datang,
                                </span>
                                <span class="block sm:inline font-semibold text-base sm:text-lg sm:ms-1 text-gray-900">
                                    {{ $namaDonatur }}
                                </span>
                            </div>
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
                            <div onclick="copyRekening('{{ $rekening->nomor_rekening }}')"
                                class="relative group mt-6 bg-gradient-to-r from-indigo-50 to-indigo-100 p-5 rounded-xl shadow-inner transition-all duration-200 cursor-pointer hover:shadow-md active:scale-95 border border-indigo-100">

                                <p class="text-sm text-gray-500 uppercase tracking-wide font-sans">
                                    {{ $rekening->nama_bank }}
                                </p>

                                {{-- Nomor Rekening --}}
                                <div class="flex items-center justify-center gap-2 my-3">
                                    <p class="text-3xl font-mono tracking-widest text-indigo-700 select-all font-bold">
                                        {{ $rekening->nomor_rekening }}
                                    </p>
                                </div>

                                <p class="font-semibold text-gray-800 font-sans">a.n. {{ $rekening->atas_nama }}</p>

                                <p class="text-xs text-indigo-400 mt-2 italic">(Ketuk untuk menyalin)</p>
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

                        <form id="formKonfirmasi" action="{{ route('konfirmasi.donasi.store') }}" method="POST"
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

                                    <input type="text" id="nominal_display"
                                        class="font-sans mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Contoh: 50.000">

                                    <!-- VALUE ASLI UNTUK DIKIRIM KE BACKEND -->
                                    <input type="hidden" id="nominal" name="nominal">

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formKonfirmasi = document.getElementById('formKonfirmasi');
            if (formKonfirmasi) {
                formKonfirmasi.addEventListener('submit', function(e) {
                    // Jangan pakai e.preventDefault() agar form tetap terkirim

                    const btn = formKonfirmasi.querySelector('button[type="submit"]');

                    // Simpan teks asli jaga-jaga (opsional)
                    // const originalText = btn.innerText;

                    // Ubah teks tombol dan tambahkan ikon loading
                    btn.innerHTML = `
                    Memproses...
                `;

                    // Matikan tombol agar tidak double submit
                    btn.disabled = true;
                    btn.classList.add('opacity-75', 'cursor-not-allowed');
                });
            }

        });

        function copyRekening(text) {
            // 1. Salin ke clipboard menggunakan API modern
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text);
            } else {
                // Fallback untuk browser lama/mobile tertentu
                let textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed"; // Hindari scroll ke bawah
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                } catch (err) {
                    console.error('Gagal menyalin', err);
                }
                document.body.removeChild(textArea);
            }

            // 2. Tampilkan efek visual "Tersalin!"
            const feedback = document.getElementById('copy-feedback');
            if (feedback) {
                feedback.classList.remove('opacity-0'); // Munculkan
                setTimeout(() => {
                    feedback.classList.add('opacity-0'); // Hilangkan setelah 2 detik
                }, 2000);
            }
        }

        const inputDisplay = document.getElementById("nominal_display");
        const inputHidden = document.getElementById("nominal");

        inputDisplay.addEventListener("input", function() {
            let angka = this.value.replace(/\D/g, ""); // hilangkan semua non-digit
            inputHidden.value = angka; // simpan angka murni untuk backend

            // Format titik per ribuan
            this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    </script>

</x-app-layout>
