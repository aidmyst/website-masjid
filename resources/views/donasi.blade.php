<x-app-layout>
    <div class="flex-grow">
        <main>
            @if (session('donasi_success'))
                <div x-data="{ show: true }" {{-- Hilang otomatis setelah 4 detik --}} x-init="setTimeout(() => show = false, 2000)" x-show="show"
                    style="display: none;" {{-- Sembunyikan, biarkan Alpine yang urus --}} {{-- Latar belakang overlay --}}
                    class="fixed inset-0 bg-black/30 z-[9998] flex items-center justify-center p-4"
                    x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                    {{-- Kotak Modal Pop-up --}}
                    <div class="bg-white w-full max-w-sm rounded-xl shadow-2xl p-8 text-center"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                        {{-- Ikon Checkmark (SVG) --}}
                        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        {{-- Judul dan Pesan --}}
                        <h3 class="text-xl font-semibold text-gray-800 mt-4">Berhasil!</h3>
                        <p class="text-gray-600 mt-2">
                            {{ session('donasi_success') }}
                        </p>

                    </div>
                </div>
            @endif

            <div x-data="{ showLogin: {{ session('error') ? 'true' : 'false' }}, showRegister: false }" class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 space-y-16">
                {{-- Hero Section dengan Animasi Lengkap --}}
                <section x-data="{ startAnimation: false }" x-intersect.once:enter="startAnimation = true"
                    class="relative text-white text-center overflow-hidden">
                    {{-- Pembungkus utama --}}
                    <div class="min-h-[550px] flex items-center justify-center px-4">
                        <div style="background-image: url('{{ asset('images/donasi.webp') }}')"
                            class="rounded-xl shadow-lg px-6 py-32 md:p-24 lg:p-32 transform origin-center mx-auto max-w-7xl w-full
                            relative overflow-hidden bg-cover bg-center"
                            x-show="startAnimation" x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="scale-50 opacity-0"
                            x-transition:enter-end="scale-100 opacity-100">
                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-black opacity-50 rounded-xl"></div>

                            {{-- Konten --}}
                            <div class="relative z-10">
                                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold"
                                    x-show="startAnimation"
                                    x-transition:enter="transition ease-out duration-700 delay-200"
                                    x-transition:enter-start="opacity-0 translate-y-5"
                                    x-transition:enter-end="opacity-100 translate-y-0">
                                    Mari Berkontribusi
                                </h2>

                                <p class="mt-6 text-base sm:text-lg md:text-xl max-w-3xl mx-auto"
                                    x-show="startAnimation"
                                    x-transition:enter="transition ease-out duration-700 delay-400"
                                    x-transition:enter-start="opacity-0 translate-y-5"
                                    x-transition:enter-end="opacity-100 translate-y-0">
                                    "Berbagi Kebahagiaan, Menuai Keberkahan. Sedekah Anda menjadi senyuman bagi mereka
                                    yang membutuhkan."
                                </p>

                                {{-- Tombol Donasi --}}
                                <button {{-- LOGIKA DI SINI: --}} {{-- Cek apakah Cookie 'donatur_nama' ada. Jika ada, langsung ke halaman konfirmasi. Jika tidak, buka modal login. --}}
                                    @click="{{ \Illuminate\Support\Facades\Cookie::get('donatur_nama') ? 'window.location.href=\'' . route('konfirmasi.donasi') . '\'' : 'showLogin = true' }}"
                                    class="mt-8 sm:mt-10 inline-block bg-white text-black font-bold py-3 px-8 sm:py-4 sm:px-10 rounded-full text-base sm:text-lg
                                    transition-all duration-200 ease-out hover:scale-105 hover:bg-gray-100 active:scale-95 active:bg-gray-200"
                                    x-show="startAnimation">
                                    Donasi Sekarang
                                </button>

                            </div>
                        </div>
                    </div>

                    {{-- ========================= --}}
                    {{-- MODAL DATA DIRI DONATUR --}}
                    {{-- ========================= --}}
                    <div x-show="showLogin" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black/60 z-50 p-4">

                        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative" x-transition.opacity>

                            <button @click="showLogin = false"
                                class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-2xl font-semibold transition">
                                ✕
                            </button>

                            <h2 class="text-2xl font-semibold text-center text-indigo-700 mb-2">Data Diri Donatur</h2>
                            <p class="text-sm text-gray-600 text-center mb-6">
                                Silakan isi data diri Anda untuk melanjutkan donasi.
                            </p>

                            @if (session('error'))
                                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif

                            <form id="formDataDiri" method="POST" action="{{ route('donasi.datadiri') }}"
                                class="text-left">
                                @csrf

                                {{-- Input Nama --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="nama" required
                                        placeholder="Masukkan Nama Lengkap / Hamba Allah"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-800 placeholder-gray-400 text-sm placeholder:text-sm">
                                </div>

                                {{-- Input No WA --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                                    <input type="text" name="no_wa" required
                                        placeholder="Contoh: 0812xxxx (Isi '-' jika tidak ingin)"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-800 placeholder-gray-400 text-sm placeholder:text-sm">
                                </div>

                                {{-- Tombol Submit --}}
                                <button type="submit" id="btnSubmitDataDiri"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-semibold transition flex justify-center items-center">
                                    Masuk
                                </button>
                            </form>
                        </div>
                    </div>
                </section>

                {{-- Tujuan Program --}}
                {{-- PERBAIKAN 2: Tambahkan animasi fade-in pada section ini --}}
                <section x-data="{ show: false }" x-intersect.once="show = true" x-show="show"
                    x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100">

                    <h2 class="text-3xl font-bold text-center text-gray-900">Tujuan Program Donasi</h2>
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach ([['icon' => 'users', 'title' => 'Membantu Sesama', 'desc' => 'Menyediakan bantuan layak bagi warga sekitar masjid yang membutuhkan, terutama para dhuafa.'], ['icon' => 'heart', 'title' => 'Menumbuhkan Kepedulian', 'desc' => 'Membangun semangat kebersamaan dan kepedulian sosial di antara jamaah dan masyarakat.'], ['icon' => 'sparkles', 'title' => 'Memakmurkan Masjid', 'desc' => 'Menjadikan masjid pusat ibadah sekaligus pusat kegiatan sosial yang bermanfaat bagi umat.']] as $tujuan)
                            <div class="bg-white p-6 rounded-lg shadow text-center">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-full bg-indigo-500 text-white mx-auto">
                                    @if ($tujuan['icon'] == 'users')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                        </svg>
                                    @elseif ($tujuan['icon'] == 'heart')
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    @elseif ($tujuan['icon'] == 'sparkles')
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09zM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456zM16.898 20.575 16.5 21.75l-.398-1.175a3.375 3.375 0 0 0-2.456-2.456L12.75 18l1.175-.398a3.375 3.375 0 0 0 2.456-2.456L16.5 14.25l.398 1.175a3.375 3.375 0 0 0 2.456 2.456L20.25 18l-1.175.398a3.375 3.375 0 0 0-2.456 2.456z" />
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="mt-4 text-lg font-semibold">{{ $tujuan['title'] }}</h3>
                                <p class="mt-2 text-gray-600">{{ $tujuan['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <div class="border-b border-gray-300"></div>

                <section id="donasi" x-data="{ tab: 'pintu_surga' }">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900">Transparansi & Rincian Program</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto mt-4">
                            Berikut adalah ringkasan donasi bulan ini. Rincian pemasukan dapat dilihat di setiap
                            kategori program di bawah.
                        </p>
                    </div>

                    {{-- Ringkasan Laporan Bulanan (Dinamis) --}}
                    <div
                        class="mt-6 sm:mt-8 max-w-2xl mx-auto bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-4 sm:p-6 border border-gray-100">

                        {{-- Header Card --}}
                        <div
                            class="border-b border-dashed pb-4 mb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <h3 class="font-bold text-lg text-indigo-700 flex items-center">
                                <span class="mr-2">📊</span> Laporan Pemasukan
                            </h3>
                            <span class="inline-block text-xs sm:text-sm font-semibold px-2.5 py-1">
                                {{ $namaBulanIni }}
                            </span>
                        </div>

                        {{-- Body Card --}}
                        <div class="space-y-4">

                            {{-- Item 1: Total Pemasukan --}}
                            {{-- Di HP: Label di atas, Angka di bawah (besar). Di PC: Kiri Kanan --}}
                            <div
                                class="flex flex-col sm:flex-row justify-between sm:items-center bg-indigo-50 px-4 py-3 rounded-xl border border-indigo-100">
                                <span class="text-gray-600 text-sm sm:text-base font-medium mb-1 sm:mb-0">Total
                                    Pemasukan</span>
                                <span class="font-bold text-2xl sm:text-xl text-green-600">
                                    Rp <x-total-income :final="$totalDonasiBulanIni" />
                                </span>
                            </div>

                            {{-- Item 2: Jumlah Transaksi --}}
                            <div
                                class="flex flex-col sm:flex-row justify-between sm:items-center bg-gray-50 px-4 py-3 rounded-xl border border-gray-200">
                                <span class="text-gray-600 text-sm sm:text-base font-medium mb-1 sm:mb-0">Jumlah
                                    Transaksi</span>
                                <span class="font-bold text-lg sm:text-lg text-indigo-700">
                                    {{ $jumlahTransaksiBulanIni }} Transaksi
                                </span>
                            </div>

                        </div>
                    </div>

                    {{-- Tabs Navigasi yang Diperbarui untuk Mobile (4 Tabs dalam Satu Frame) --}}
                    <div class="mt-14 max-w-4xl mx-auto border-b border-gray-200">
                        <nav class="-mb-px flex justify-between text-center text-sm font-medium">
                            <template
                                x-for="item in [
                                    {id:'pintu_surga', label:'Pintu Surga'},
                                    {id:'bmt', label:'BMT'},
                                    {id:'jumat', label:`Jum'at`},
                                    {id:'kebersihan', label:'Kebersihan'}
                                ]">
                                <button @click="tab = item.id"
                                    :class="tab === item.id ?
                                        'border-indigo-500 text-indigo-600 font-semibold' :
                                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="relative py-3 px-1 border-b-2 transition-all duration-300 ease-in-out flex-1 min-w-0">
                                    <span x-text="item.label"></span>
                                    <span
                                        class="absolute inset-x-0 -bottom-0.5 h-0.5 bg-gradient-to-r from-indigo-400 to-indigo-600 transform scale-x-0 transition-transform duration-300 ease-out"
                                        :class="tab === item.id ? 'scale-x-100' : ''"></span>
                                </button>
                            </template>
                        </nav>
                    </div>

                    {{-- Konten Tabs --}}
                    <div class="mt-10 max-w-3xl mx-auto">
                        <div x-show="tab === 'pintu_surga'" x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('partials.laporan-donasi-tabel', [
                                'kategori' => 'pintu_surga',
                                'judul' => 'Kotak Infak Pintu Surga (Pembangunan)',
                                'deskripsi' =>
                                    'Donasi untuk pembangunan dan perawatan fisik masjid, mulai dari renovasi, perbaikan fasilitas, hingga penambahan sarana ibadah.',
                                'laporan' => $laporan['pintu_surga'] ?? [],
                            ])
                        </div>
                        <div x-show="tab === 'bmt'" x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('partials.laporan-donasi-tabel', [
                                'kategori' => 'bmt',
                                'judul' => 'Kotak Infak BMT (Santunan & Sosial)',
                                'deskripsi' =>
                                    'Infak ini secara khusus disalurkan untuk program sosial dan santunan, menjadi jembatan kebaikan langsung dari Anda kepada mereka yang paling membutuhkan.',
                                'laporan' => $laporan['bmt'] ?? [],
                            ])
                        </div>
                        <div x-show="tab === 'jumat'" x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('partials.laporan-donasi-tabel', [
                                'kategori' => 'jumat',
                                'judul' => 'Kotak Infak Sholat Jum\'at (Operasional)',
                                'deskripsi' =>
                                    'Donasi untuk kebutuhan operasional bulanan, seperti listrik, air, kebersihan, dan kegiatan ibadah rutin termasuk perawatan fasilitas serta mendukung kelancaran kajian.',
                                'laporan' => $laporan['jumat'] ?? [],
                            ])
                        </div>
                        <div x-show="tab === 'kebersihan'" x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            @include('partials.laporan-donasi-tabel', [
                                'kategori' => 'kebersihan',
                                'judul' => 'Kotak Infak Kebersihan (Pemeliharaan Fasilitas)',
                                'deskripsi' =>
                                    'Infak khusus untuk merawat tempat wudhu dan kamar mandi agar tetap bersih, sehat, dan layak digunakan.',
                                'laporan' => $laporan['kebersihan'] ?? [],
                            ])
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <footer class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-lg font-semibold text-white">Masjid Jami Aisyah binti Abdul Aziz Al Musa - Pusat Ibadah
                    & Pembinaan Umat</h3>
                <div class="mt-6 flex justify-center items-center space-x-6">
                    <a href="https://www.instagram.com/masjid_jami_aisyah/" target="_blank"
                        class="text-gray-400 hover:text-indigo-500 transition">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.06-1.064.049-1.64.209-2.064.385a3.102 3.102 0 00-1.153 1.153 3.102 3.102 0 00-.385 2.064c-.049 1.023-.06 1.35-.06 3.807v.468c0 2.456.011 2.784.06 3.807.049 1.064.209 1.64.385 2.064a3.102 3.102 0 001.153 1.153 3.102 3.102 0 002.064.385c1.023.049 1.35.06 3.807.06h.468c2.456 0 2.784-.011 3.807-.06 1.064-.049 1.64-.209 2.064-.385a3.102 3.102 0 001.153-1.153 3.102 3.102 0 00-.385-2.064c.049-1.023.06-1.35.06-3.807v-.468c0-2.456-.011-2.784-.06-3.807-.049-1.064-.209-1.64-.385-2.064a3.102 3.102 0 00-1.153-1.153 3.102 3.102 0 00-2.064-.385c-1.023-.049-1.35-.06-3.807-.06zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="https://wa.me/628122637217" target="_blank"
                        class="text-gray-400 hover:text-indigo-500 transition">
                        <span class="sr-only">WhatsApp</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zM12.04 20.12c-1.48 0-2.92-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.25 8.25 0 0 1-1.26-4.36c0-4.54 3.7-8.24 8.24-8.24 4.54 0 8.24 3.7 8.24 8.24S16.58 20.12 12.04 20.12zM16.56 14.26c-.25-.12-1.47-.72-1.7-.85-.23-.12-.39-.18-.56.12-.17.31-.64.85-.79 1.02-.15.17-.29.18-.55.06-.25-.12-1.07-.39-2.04-1.26-.75-.67-1.26-1.5-1.41-1.75-.15-.25-.02-.38.1-.51.11-.11.25-.29.37-.43.13-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.4-.42-.55-.42-.15 0-.32-.02-.48-.02s-.41.06-.62.31c-.22.25-.83.81-.83 1.98 0 1.16.85 2.3 1 2.45.14.17 1.72 2.62 4.18 3.72.59.26 1.05.42 1.41.53.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.07-.12-.25-.18-.5-.31z" />
                        </svg>
                    </a>
                    <a href="https://www.google.com/maps/place/631.Masjid+Jami+Aisyah+Binti+Abdul+Aziz+Al+Musa+%D9%85%D8%B3%D8%AC%D8%AF+%D8%AC%D8%A7%D9%85%D8%B9+%D8%B9%D8%A7%D8%A6%D8%B4%D8%A9+%D8%A8%D9%86%D8%AA+%D8%B9%D8%A8%D8%AF%D8%A7%D9%84%D8%B9%D8%B2%D9%8A%D8%B2+%D8%A7%D9%84%D9%85%D9%88%D8%B3%D9%89+%D8%BA%D9%81%D8%B1+%D8%A7%D9%84%D9%84%D9%87+%D9%84%D9%87%D8%A7%E2%80%AD/@-7.5570334,110.750316,17z/data=!3m1!4b1!4m6!3m5!1s0x2e7a14f1447b40bd:0x3472496efbb3b427!8m2!3d-7.5570334!4d110.7528909!16s%2Fg%2F11f00plnqy?entry=ttu&g_ep=EgoyMDI1MDkxNS4wIKXMDSoASAFQAw%3D%3D"
                        target="_blank" class="text-gray-400 hover:text-indigo-500 transition">
                        <span class="sr-only">Google Maps</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 text-center">
                <p class="text-sm text-gray-400">© 2025 Masjid Jami Aisyah. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Ambil elemen form berdasarkan ID yang baru kita buat
            const formDataDiri = document.getElementById('formDataDiri');

            if (formDataDiri) {
                formDataDiri.addEventListener('submit', function(e) {
                    // KITA TIDAK PAKAI e.preventDefault(); 
                    // Biarkan form submit secara normal ke server.

                    const btn = formDataDiri.querySelector('button[type="submit"]');

                    // 1. Ubah tulisan tombol
                    btn.innerHTML = `
                    Memproses...
                `;

                    // 2. Disable tombol agar tidak bisa diklik lagi
                    btn.disabled = true;

                    // 3. Ubah style agar terlihat non-aktif (opsional)
                    btn.classList.add('opacity-75', 'cursor-not-allowed');
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Memaksa AlpineJS membuka modal karena ada error
            // Asumsi root elemen Alpine Anda memiliki x-data="{ showLogin: false, ... }"
            // Kita cari elemen root tersebut dan ubah datanya
            const modalData = document.querySelector('[x-data*="showLogin"]');
            if (modalData) {
                modalData.__x.$data.showLogin = true;
            }
        });
    </script>

</x-app-layout>
