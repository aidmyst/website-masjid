<x-app-layout>

    <div class="flex-grow">
        <main>
            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 space-y-16">

                <section x-data>
                    <div class="bg-gray-800 text-white rounded-xl shadow-lg overflow-hidden p-4">
                        <div>
                            {{-- REVISI DI SINI: Menggunakan x-init untuk memastikan judul selalu muncul --}}
                            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 250)" x-show="show"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0">
                                <div class="flex items-center space-x-3">
                                    <x-heroicon-c-calendar-date-range class="h-9 w-9 text-indigo-400" />
                                    <h2 class="text-xl font-bold">Agenda Kajian Bulanan</h2>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ showList: false }"
                            x-intersect.once="showList = true">

                            @foreach ($kajian as $item)
                                <div x-data="{ show: false }"
                                    x-effect="if(showList) setTimeout(() => show = true, {{ $loop->index * 120 }})"
                                    :class="{ 'opacity-100 translate-y-0': show }"
                                    class="bg-gray-700/50 rounded-lg p-5 flex space-x-4 shadow-lg transform transition-all duration-700 h-full opacity-0 translate-y-3">

                                    {{-- KONTEN KARTU TETAP --}}
                                    <div class="flex-shrink-0 text-center">
                                        <div class="bg-indigo-500 text-white rounded-md px-3 py-2">
                                            <p class="text-xs font-semibold uppercase">
                                                {{ \Carbon\Carbon::parse($item->hari)->locale('id')->translatedFormat('M') }}
                                            </p>
                                            <p class="text-2xl font-bold">
                                                {{ \Carbon\Carbon::parse($item->hari)->translatedFormat('d') }}
                                            </p>
                                        </div>
                                        <div class="mt-2">
                                            @if ($item->status == 'Selesai')
                                                <span
                                                    class="bg-gray-500/50 text-gray-300 text-xs font-semibold px-2.5 py-1 rounded-full">
                                                    Selesai
                                                </span>
                                            @elseif ($item->status == 'Sedang Berlangsung')
                                                <span
                                                    class="bg-blue-500/50 text-blue-300 text-xs font-semibold px-2.5 py-1 rounded-full">
                                                    Berlangsung
                                                </span>
                                            @else
                                                <span
                                                    class="bg-teal-500/50 text-teal-300 text-xs font-semibold px-2.5 py-1 rounded-full">
                                                    Segera
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex flex-col justify-center">
                                        <h3 class="font-bold text-lg text-white leading-tight">{{ $item->tema }}</h3>
                                        <div class="text-gray-400 text-sm mt-2 space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <x-heroicon-o-clock class="h-4 w-4" />
                                                <span>{{ $item->waktu }} WIB</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <x-heroicon-o-user class="h-4 w-4" />
                                                <span>{{ $item->pemateri }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>

                <div class="border-b border-gray-300"></div>

                <section>
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-center text-gray-900">Manfaat Mengikuti Kajian</h2>
                        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                            Menuntut ilmu adalah kewajiban setiap muslim. Dengan menghadiri kajian, kita akan
                            mendapatkan banyak sekali keberkahan dan manfaat.
                        </p>
                    </div>

                    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                        {{-- Manfaat 1 --}}
                        <div>
                            <x-benefit-card icon="heroicon-o-light-bulb" title="Meningkatkan Pemahaman">
                                Memperdalam ilmu tentang agama Islam dari sumber yang shahih.
                            </x-benefit-card>
                        </div>

                        {{-- Manfaat 2 --}}
                        <div>
                            <x-benefit-card icon="heroicon-o-user-circle" title="Memperbaiki Ibadah">
                                Menyempurnakan kualitas sholat, puasa, dan ibadah lainnya.
                            </x-benefit-card>
                        </div>

                        {{-- Manfaat 3 --}}
                        <div>
                            <x-benefit-card icon="heroicon-o-book-open" title="Menambah Wawasan">
                                Membuka cakrawala pengetahuan tentang Al-Qur’an dan Sunnah.
                            </x-benefit-card>
                        </div>

                        {{-- Manfaat 4 --}}
                        <div>
                            <x-benefit-card icon="heroicon-o-users" title="Lingkungan Positif">
                                Berkumpul dengan orang-orang shalih yang saling mengingatkan.
                            </x-benefit-card>
                        </div>

                    </div>
                </section>

            </div>
        </main>
    </div>

    {{-- FOOTER --}}
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
