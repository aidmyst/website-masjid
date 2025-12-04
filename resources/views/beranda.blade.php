<x-app-layout>
    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="flex-grow">
        <main>
            {{-- Hero Section (Gambar Full-Width - VERSI PERBAIKAN) --}}
            <section class="w-full relative text-center h-[80vh] sm:h-[100vh] overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/masjid-jami.webp') }}" alt="Masjid Jami"
                        class="w-full h-full object-cover animate-ken-burns">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-70"></div>

                {{-- Alpine.js untuk animasi teks yang lebih sederhana --}}
                <div x-data="{ show: false }" x-intersect:enter="show = true" x-intersect:leave="show = false"
                    class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white">

                    <h2 x-show="show" x-transition:enter="transition ease-out duration-1000 transform"
                        x-transition:enter-start="opacity-0 translate-y-12"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="text-3xl font-bold text-center sm:text-5xl drop-shadow-lg">
                        Masjid Jami Aisyah Binti Abdul Aziz Al-Musa
                    </h2>
                    <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500 transform"
                        x-transition:enter-start="opacity-0 translate-y-12"
                        x-transition:enter-end="opacity-100 translate-y-0" class="mt-4 text-lg italic drop-shadow-md">
                        "Menjadi Cahaya di Tengah Masyarakat"
                    </p>
                </div>
            </section>

            {{-- Konten di dalam Container --}}
            <div class="bg-gray-50">
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 space-y-20">

                    {{-- Tambahkan x-data dan x-intersect pada section --}}
                    <section x-data="{ startAnimation: false }" x-intersect.once:enter="startAnimation = true">
                        <h2 class="text-3xl font-bold text-center text-gray-900">Layanan & Program Unggulan</h2>
                        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">

                            {{-- Beri delay yang berbeda untuk setiap kartu --}}
                            <x-service-card delay="0ms"> {{-- MODIFIKASI: Kirim status animasi --}}
                                <x-slot name="icon">
                                    <x-heroicon-o-clock class="w-6 h-6" />
                                </x-slot>
                                <x-slot name="title">Jadwal Sholat Harian</x-slot>
                                Akses informasi waktu sholat fardhu yang akurat dan diperbarui setiap hari.
                            </x-service-card>

                            <x-service-card delay="150ms"> {{-- MODIFIKASI: Kirim status animasi --}}
                                <x-slot name="icon">
                                    {{-- Mengganti @svg dengan komponen untuk konsistensi --}}
                                    <x-heroicon-o-academic-cap class="w-6 h-6" />
                                </x-slot>
                                <x-slot name="title">Pendidikan Al-Qur'an (TPA)</x-slot>
                                Program Taman Pendidikan Al-Qur'an (TPA) untuk anak-anak dan program tahsin untuk
                                dewasa.
                            </x-service-card>

                            <x-service-card delay="300ms"> {{-- MODIFIKASI: Kirim status animasi --}}
                                <x-slot name="icon">
                                    <x-heroicon-o-book-open class="w-6 h-6" />
                                </x-slot>
                                <x-slot name="title">Kajian Islami Rutin</x-slot>
                                Ikuti berbagai kajian rutin bersama asatidz terkemuka untuk menambah wawasan.
                            </x-service-card>

                            <x-service-card delay="450ms"> {{-- MODIFIKASI: Kirim status animasi --}}
                                <x-slot name="icon">
                                    <x-heroicon-o-banknotes class="w-6 h-6" />
                                    {{-- Mengganti 'banknotes' dengan 'gift' yang lebih relevan --}}
                                </x-slot>
                                <x-slot name="title">Program Donasi</x-slot>
                                Berpartisipasi dalam program berbagi makanan dan santunan.
                            </x-service-card>

                        </div>
                    </section>

                    {{-- Statistik Animasi --}}
                    <section class="bg-white p-8 rounded-lg shadow-lg">
                        <h2 class="text-3xl font-bold text-center text-gray-900">Statistik Masjid</h2>
                        <div class="mt-12 grid grid-cols-1 gap-8 text-center sm:grid-cols-2 lg:grid-cols-4">
                            <x-stat-card :final="$statistik->jamaah ?? 0" label="Jamaah Tetap" :plus="true" />
                            <x-stat-card :final="$statistik->tpq ?? 0" label="TPQ Aktif" />
                            <x-stat-card :final="$statistik->kajian ?? 0" label="Kajian Per Bulan" />
                            <x-stat-card :final="$statistik->program ?? 0" label="Program Sosial Utama" />
                        </div>
                    </section>

                    <div class="border-b border-gray-300"></div>

                    <div x-data="{ tab: 'imam' }" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                        {{-- Menu Bar --}}
                        <div class="flex justify-center space-x-4 mb-8">
                            <button @click="tab = 'imam'"
                                :class="tab === 'imam' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                                class="px-4 py-2 rounded-lg font-semibold transition">
                                Jadwal Imam Harian
                            </button>
                            <button @click="tab = 'khatib'"
                                :class="tab === 'khatib' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                                class="px-4 py-2 rounded-lg font-semibold transition">
                                Jadwal Khatib Jum'at
                            </button>
                        </div>

                        {{-- Section Imam --}}
                        <div x-show="tab === 'imam'" x-transition class="space-y-8">
                            <section class="py-12 bg-white rounded-xl shadow-md">
                                <div class="text-center px-4 sm:px-6 lg:px-8">
                                    <h2 class="text-3xl font-bold text-gray-900">Jadwal Imam Harian</h2>
                                    <p class="mt-3 text-lg text-gray-600 max-w-2xl mx-auto">
                                        Para imam yang bertugas memimpin sholat berjamaah setiap harinya.
                                    </p>
                                </div>

                                <div class="mt-12 flex flex-wrap justify-center gap-6 px-4">

                                    <!-- Subuh -->
                                    <div
                                        class="bg-white rounded-xl shadow-lg p-4 text-center border border-gray-100 w-full max-w-[16rem] sm:max-w-[18rem] md:w-[20rem] mx-auto">
                                        <div class="bg-gray-100 text-indigo-600 rounded-full p-2 inline-block mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-1 text-lg font-bold text-gray-800">Subuh</h3>
                                        <p class="mt-1 text-gray-600 text-md">Bp. Alan Pratama</p>
                                    </div>

                                    <!-- Dhuhur & Ashar -->
                                    <div
                                        class="bg-white rounded-xl shadow-lg p-4 text-center border border-gray-100 w-full max-w-[16rem] sm:max-w-[18rem] md:w-[20rem] mx-auto">
                                        <div class="bg-gray-100 text-indigo-600 rounded-full p-2 inline-block mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-1 text-lg font-bold text-gray-800">Dhuhur & Ashar</h3>
                                        <p class="mt-1 text-gray-600 text-md">Bp. H. Budhi Santoso</p>
                                    </div>

                                    <!-- Maghrib & Isya -->
                                    <div
                                        class="bg-white rounded-xl shadow-lg p-4 text-center border border-gray-100 w-full max-w-[16rem] sm:max-w-[18rem] md:w-[20rem] mx-auto">
                                        <div class="bg-gray-100 text-indigo-600 rounded-full p-2 inline-block mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-1 text-lg font-bold text-gray-800">Maghrib & Isya</h3>
                                        <p class="mt-1 text-gray-600 text-md">Bp. Hartono</p>
                                    </div>

                                </div>
                            </section>
                        </div>

                        {{-- Section Khatib Jum'at --}}
                        <div x-show="tab === 'khatib'" x-transition class="space-y-8">
                            <section class="py-12 bg-white rounded-xl shadow-md">
                                <div class="max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                                    <h2 class="text-3xl sm:text-3xl font-bold text-gray-900 tracking-tight">
                                        Jadwal Khatib Jum’at —
                                        <span
                                            class="text-indigo-600">{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }}</span>
                                    </h2>
                                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                                        Berikut adalah daftar khatib dan imam Sholat Jum’at bulan ini di Masjid Jami
                                        Aisyah.
                                    </p>

                                    <div
                                        class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                                        @php
                                            $petugasJumat = [
                                                ['pekan' => 'Jum\'at 1', 'khatib' => 'Bp. H. Muh Solihin, S.Psi'],
                                                ['pekan' => 'Jum\'at 2', 'khatib' => 'Bp. Drs. Edi Purwanto'],
                                                ['pekan' => 'Jum\'at 3', 'khatib' => 'Bp. Ghazi Abdurrahman'],
                                                [
                                                    'pekan' => 'Jum\'at 4',
                                                    'khatib' => 'Bp. Sokheh Al Hasan, M.Pd.I & Bp. Sulaiman',
                                                ],
                                                ['pekan' => 'Jum\'at 5', 'khatib' => 'Bp. Surya Fauzi Rahman, A.Md'],
                                            ];
                                        @endphp

                                        @foreach ($petugasJumat as $petugas)
                                            <div
                                                class="bg-white rounded-xl border border-gray-100 shadow-md p-6 text-left h-full flex flex-col justify-between">
                                                <div class="flex items-center justify-between mb-4">
                                                    <span
                                                        class="bg-gray-100 text-indigo-700 font-semibold px-3 py-1 rounded-lg text-sm">
                                                        {{ $petugas['pekan'] }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-800 leading-tight mb-1">
                                                        {{ $petugas['khatib'] }}
                                                    </h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="border-b border-gray-300"></div>

                    {{-- Section Kegiatan Rutin --}}
                    <section class="bg-gray-50 py-2">
                        <div class="mx-auto max-w-6xl">

                            <div class="text-center mb-12">
                                <h2 class="text-3xl font-bold text-gray-900">Kegiatan Rutin Masjid</h2>
                                <p class="mt-4 text-lg text-gray-600">
                                    Program dan aktivitas rutin yang diselenggarakan untuk memakmurkan masjid dan
                                    membina umat.
                                </p>
                            </div>

                            <div class="grid md:grid-cols-2 gap-8">

                                {{-- Card 1 --}}
                                <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
                                    <div class="flex items-start gap-4">
                                        <div class="text-indigo-600 text-3xl">
                                            <x-dynamic-component :component="'heroicon-o-book-open'" class="h-8 w-8" />
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900">Kajian Ba’da Maghrib</h3>
                                            <p class="mt-2 text-gray-700 leading-relaxed">
                                                Kajian tematik untuk memperdalam pemahaman Al-Qur’an dan hadits bersama
                                                asatidz kompeten.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 2 --}}
                                <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
                                    <div class="flex items-start gap-4">
                                        <div class="text-indigo-600 text-3xl">
                                            <x-dynamic-component :component="'heroicon-o-user-group'" class="h-8 w-8" />
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                Pengajian Ibu-Ibu (Setiap Tanggal 12)
                                            </h3>
                                            <p class="mt-2 text-gray-700 leading-relaxed">
                                                Majelis ilmu bagi kaum ibu dengan materi seputar fiqih wanita dan
                                                pembinaan keluarga.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 3 --}}
                                <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
                                    <div class="flex items-start gap-4">
                                        <div class="text-indigo-600 text-3xl">
                                            <x-dynamic-component :component="'heroicon-o-academic-cap'" class="h-8 w-8" />
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900">TPA (Ibu-Ibu & Lansia)</h3>
                                            <p class="mt-2 text-gray-700 leading-relaxed">
                                                Program tahsin untuk memperbaiki bacaan Al-Qur’an sesuai tajwid.
                                                Ibu-ibu: Sabtu sore.
                                                Lansia: Selasa & Kamis.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 4 --}}
                                <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
                                    <div class="flex items-start gap-4">
                                        <div class="text-indigo-600 text-3xl">
                                            <x-dynamic-component :component="'heroicon-o-gift'" class="h-8 w-8" />
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900">Jum’at Berkah</h3>
                                            <p class="mt-2 text-gray-700 leading-relaxed">
                                                Berbagi makanan dan sedekah kepada yang membutuhkan setiap hari Jum’at.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 5 --}}
                                <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
                                    <div class="flex items-start gap-4">
                                        <div class="text-indigo-600 text-3xl">
                                            <x-dynamic-component :component="'heroicon-o-sun'" class="h-8 w-8" />
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                Subuh Barokah (Ahad Pertama)
                                            </h3>
                                            <p class="mt-2 text-gray-700 leading-relaxed">
                                                Shalat Subuh berjamaah, dilanjutkan tausiyah dan sarapan bersama untuk
                                                mempererat ukhuwah.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 6 --}}
                                <div class="bg-white p-6 rounded-xl shadow-sm border hover:shadow-md transition">
                                    <div class="flex items-start gap-4">
                                        <div class="text-indigo-600 text-2xl">
                                            <x-dynamic-component :component="'heroicon-o-sparkles'" class="h-8 w-8" />
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900">Tadabbur Alam (Tahunan)
                                            </h3>
                                            <p class="mt-2 text-gray-700 leading-relaxed">
                                                Kegiatan rekreasi dan spiritual tahunan untuk menyegarkan rohani dan
                                                memperkuat silaturahmi.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>

                </div>
            </div>

            {{-- Jadwal Sholat & Kalender Hijriyah (Full-Width Background) --}}
            <section class="relative py-16 bg-fixed bg-cover bg-center"
                style="background-image: url('{{ asset('images/sholat.webp') }}')">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">

                        {{-- Kolom Kiri: Jadwal Sholat --}}
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full">
                                <div class="p-6 bg-indigo-500 text-white">
                                    <h2 class="text-2xl font-bold">Jadwal Sholat Hari Ini</h2>
                                    <p class="opacity-80">{{ $currentDate }} - Sukoharjo & Sekitarnya</p>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    @if (!empty($prayerTimes))
                                        @foreach ($prayerTimes as $name => $time)
                                            <div
                                                class="p-4 flex justify-between items-center transition hover:bg-gray-50 {{ $name == $nextPrayerName ? 'bg-indigo-50 font-bold' : '' }}">
                                                <span class="text-lg text-gray-800">{{ $name }}</span>
                                                @if ($name == $nextPrayerName)
                                                    <span
                                                        class="px-3 py-1 bg-indigo-500 text-white text-sm rounded-full animate-pulse">{{ $time }}</span>
                                                @else
                                                    <span
                                                        class="text-lg font-mono text-gray-600">{{ $time }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                        <div class="p-4 bg-gray-50 text-center text-sm text-gray-600">
                                            <p>Waktu berikutnya: <strong
                                                    class="text-indigo-600">{{ $nextPrayerName }}</strong></p>
                                        </div>
                                    @else
                                        <div class="p-6 text-center text-gray-500">
                                            <p>Gagal memuat jadwal sholat. Silakan coba lagi nanti.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Kalender Hijriyah --}}
                        <div class="lg:col-span-1">
                            {{-- Tambahkan kelas "flex flex-col" di sini --}}
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full flex flex-col">
                                <div class="p-6 bg-indigo-500 text-white">
                                    <h2 class="text-2xl font-bold">Kalender Hijriyah
                                    </h2>
                                    <p class="opacity-80">&nbsp;</p>
                                </div>
                                {{-- Tambahkan kelas "flex-grow" di sini --}}
                                <div class="p-6 flex flex-grow flex-col items-center justify-center text-center">
                                    <div class="text-6xl font-bold text-gray-600">
                                        {{ $hijriDate['day'] }}</div>
                                    <div class="text-2xl text-gray-800 mt-2">
                                        {{ $hijriDate['month'] }}</div>
                                    <div class="text-xl text-gray-600">
                                        {{ $hijriDate['year'] }} H</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Konten Lanjutan di dalam Container --}}
            <div class="bg-gray-50">
                <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 space-y-20">
                    {{-- Peta Lokasi Masjid --}}
                    <section>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 bg-indigo-500 text-white">
                                <h2 class="text-2xl font-bold">Lokasi Kami</h2>
                                <p class="opacity-80">Klinggen RT. 01 RW. 02 Ngadirejo Kartasura, 57163</p>
                            </div>
                            <div>
                                <iframe width="100%" height="450" style="border:0;" loading="lazy"
                                    allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                                    src="https://maps.google.com/maps?q=Masjid%20Jami%20Aisyah%20Binti%20Abdul%20Aziz%20Al%20Musa%20Kartasura&t=&z=15&ie=UTF8&iwloc=&output=embed">
                                </iframe>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <footer class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-lg font-semibold text-white">Masjid Jami Aisyah binti Abdul Aziz Al Musa - Pusat
                    Ibadah & Pembinaan Umat
                </h3>
                <div class="mt-6 flex justify-center items-center space-x-6">

                    {{-- Tautan Instagram --}}
                    <a href="https://www.instagram.com/masjid_jami_aisyah/" target="_blank"
                        class="text-gray-400 hover:text-indigo-500 transition">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.06-1.064.049-1.64.209-2.064.385a3.102 3.102 0 00-1.153 1.153 3.102 3.102 0 00-.385 2.064c-.049 1.023-.06 1.35-.06 3.807v.468c0 2.456.011 2.784.06 3.807.049 1.064.209 1.64.385 2.064a3.102 3.102 0 001.153 1.153 3.102 3.102 0 002.064.385c1.023.049 1.35.06 3.807.06h.468c2.456 0 2.784-.011 3.807-.06 1.064-.049 1.64-.209 2.064-.385a3.102 3.102 0 001.153-1.153 3.102 3.102 0 00-.385-2.064c.049-1.023.06-1.35.06-3.807v-.468c0-2.456-.011-2.784-.06-3.807-.049-1.064-.209-1.64-.385-2.064a3.102 3.102 0 00-1.153-1.153 3.102 3.102 0 00-2.064-.385c-1.023-.049-1.35-.06-3.807-.06zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    {{-- Tautan WhatsApp --}}
                    <a href="https://wa.me/628122637217" target="_blank"
                        class="text-gray-400 hover:text-indigo-500 transition">
                        <span class="sr-only">WhatsApp</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zM12.04 20.12c-1.48 0-2.92-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.25 8.25 0 0 1-1.26-4.36c0-4.54 3.7-8.24 8.24-8.24 4.54 0 8.24 3.7 8.24 8.24S16.58 20.12 12.04 20.12zM16.56 14.26c-.25-.12-1.47-.72-1.7-.85-.23-.12-.39-.18-.56.12-.17.31-.64.85-.79 1.02-.15.17-.29.18-.55.06-.25-.12-1.07-.39-2.04-1.26-.75-.67-1.26-1.5-1.41-1.75-.15-.25-.02-.38.1-.51.11-.11.25-.29.37-.43.13-.14.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.4-.42-.55-.42-.15 0-.32-.02-.48-.02s-.41.06-.62.31c-.22.25-.83.81-.83 1.98 0 1.16.85 2.3 1 2.45.14.17 1.72 2.62 4.18 3.72.59.26 1.05.42 1.41.53.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.07-.12-.25-.18-.5-.31z" />
                        </svg>
                    </a>

                    {{-- Tautan Google Maps BARU --}}
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
                <p class="text-sm text-gray-400">&copy; 2025 Masjid Jami Aisyah. All rights reserved.</p>
            </div>
        </div>
    </footer>
</x-app-layout>
