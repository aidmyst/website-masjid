<x-app-layout>
    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="flex-grow">
        <main>
            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 space-y-16">

                <section x-data="{ visible: false }" x-init="setTimeout(() => visible = true, 50)" {{-- UBAH DI SINI: --}} {{-- 1. py-16: Memberi jarak atas/bawah yang lega di Mobile --}}
                    {{-- 2. md:py-0: Menghapus jarak tersebut di Desktop (kembali ke layout asli) --}}
                    class="min-h-[80vh] bg-gradient-to-br from-gray-50 to-white flex items-center justify-center overflow-hidden 
                    rounded-xl py-8 md:py-0">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center max-w-5xl px-6 md:px-10">

                        {{-- TEKS --}}
                        {{-- order-2: Di mobile teks ada di bawah --}}
                        <div x-show="visible" x-transition:enter="transition duration-700 ease-out transform"
                            x-transition:enter-start="opacity-0 -translate-x-8"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            class="prose max-w-none order-2 md:order-1">
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                                Sejarah Masjid Jami Aisyah
                            </h2>
                            <p class="text-base md:text-lg text-gray-600 leading-relaxed">
                                Masjid Jami Aisyah, awalnya bernama <span class="font-semibold text-indigo-600">Masjid
                                    Al-Amin</span>,
                                didirikan pada tahun 1984 di atas tanah wakaf dan mulai digunakan pada 1985.
                                Setelah beberapa kali renovasi, masjid ini dibangun ulang secara total pada tahun 2015
                                berkat bantuan dari Yayasan Bina Muwahhidin dan donatur lainnya dengan total biaya
                                <span class="font-semibold text-gray-800">1,2 Milyar Rupiah</span>.
                                <br><br>
                                Pada 5 Juni 2016, masjid baru beserta gedung TK diresmikan dengan nama
                                <span class="font-semibold text-indigo-600">Masjid Jami Aisyah binti Abdul Aziz
                                    Al-Musa</span>,
                                sebagai penghormatan kepada donatur utama dari Arab Saudi.
                            </p>
                        </div>

                        {{-- GAMBAR --}}
                        {{-- order-1: Di mobile gambar ada di atas --}}
                        <div x-show="visible" x-transition:enter="transition duration-700 ease-out transform delay-200"
                            x-transition:enter-start="opacity-0 translate-x-8 scale-95"
                            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                            class="order-1 md:order-2 relative flex justify-center">

                            {{-- Wrapper Gambar --}}
                            {{-- w-full di mobile agar lebar proporsional, md:w-[90%] di desktop --}}
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl group w-full md:w-[90%]">
                                <img src="{{ asset('images/masjid-jami.webp') }}" alt="Foto Masjid Jami Aisyah"
                                    class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700 ease-out">

                                {{-- Overlay Gradient --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-700">
                                </div>

                                {{-- Label Lokasi --}}
                                <div
                                    class="absolute bottom-3 left-3 text-white opacity-0 group-hover:opacity-100 transition duration-700">
                                    <p class="text-xs uppercase tracking-wider">Masjid Jami Aisyah</p>
                                    <p class="text-sm font-semibold">Ngadirejo, Kartasura</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="relative py-10 pb-12 md:pb-16 px-4 md:px-0" x-data="{ show: false }"
                    x-init="const observer = new IntersectionObserver(([entry]) => {
                        if (entry.isIntersecting) {
                            show = true;
                            observer.disconnect();
                        }
                        }, { threshold: 0.3 });
                        observer.observe($el);">

                    {{-- Judul --}}
                    <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-6 md:mb-12
                        transition-all duration-700 ease-out"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        Visi & Misi
                    </h2>

                    {{-- Visi --}}
                    <div class="max-w-4xl mx-auto transition-all duration-700 ease-out delay-200"
                        :class="show ? 'opacity-100 scale-100 translate-y-0' : 'opacity-0 scale-90 translate-y-6'">

                        <blockquote
                            class="relative bg-gradient-to-r from-indigo-600 to-indigo-500 text-white 
                            p-6 md:p-10 rounded-2xl md:rounded-3xl 
                            shadow-xl md:shadow-2xl 
                            text-center transform hover:-translate-y-1 hover:shadow-indigo-500/40 
                            transition duration-500 ease-out border border-indigo-400/30">

                            {{-- Glow Background --}}
                            <div
                                class="absolute inset-0 rounded-2xl md:rounded-3xl 
                                blur-xl opacity-40 -z-10 
                                bg-indigo-600 
                                translate-y-3 md:translate-y-4 scale-[0.97]">
                            </div>

                            <p class="text-xl md:text-2xl italic leading-relaxed relative z-10">
                                “Menjadi masjid yang
                                <span class="font-semibold text-yellow-300">mandiri</span>,
                                <span class="font-semibold text-yellow-200">profesional</span>,
                                dan menjadi pusat pembinaan umat menuju masyarakat madani yang diridhoi Allah SWT.”
                            </p>

                            <cite
                                class="mt-4 md:mt-6 block font-semibold not-italic text-indigo-100 text-base md:text-lg">
                                ~ Masjid Jami Aisyah binti Abdul Aziz Al-Musa
                            </cite>

                        </blockquote>
                    </div>
                </section>


                <section class="bg-gradient-to-br from-gray-50 to-white pt-12 md:pt-16 pb-24 overflow-hidden" x-data="timeline()"
                    x-init="updateLineHeight()" @scroll.window.throttle.50ms="updateLineHeight()">

                    <div class="mx-auto max-w-5xl px-6" x-ref="timelineWrapper">
                        {{-- JUDUL --}}
                        <div class="text-center mb-20">
                            <h2 class="text-4xl font-bold text-gray-900 tracking-tight">Sejarah Masjid Jami Aisyah</h2>
                            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                                Menelusuri jejak lebih dari empat dekade: sebuah perjalanan dari mushola sederhana
                                menjadi mercusuar dakwah yang penuh berkah dan perjuangan umat.
                            </p>
                        </div>

                        {{-- TIMELINE --}}
                        <div class="relative">
                            @if ($sejarah->isNotEmpty())
                                {{-- PERUBAHAN 1: Posisi garis diubah untuk mobile (kiri) dan desktop (tengah) --}}
                                <div
                                    class="absolute top-0 h-full w-1 bg-gray-200 rounded-full left-4 -translate-x-1/2 md:left-1/2">
                                </div>

                                <div class="absolute top-0 w-1 bg-gradient-to-b from-indigo-400 to-indigo-600 rounded-full transition-all duration-300 ease-linear left-4 -translate-x-1/2 md:left-1/2"
                                    :style="`height: ${lineHeight}px`">
                                </div>
                            @endif

                            <div class="space-y-8 md:space-y-4 relative z-10 mb-20" x-ref="timelineContent">
                                @forelse ($sejarah as $item)
                                    <div x-data="{ visible: false }" x-intersect.once.margin.-100px="visible = true"
                                        {{-- PERUBAHAN 2: Tata letak item diubah. Padding kiri ditambahkan untuk mobile. --}}
                                        class="relative pl-12 md:pl-0 flex flex-col md:flex-row md:items-center {{ $loop->even ? 'md:flex-row-reverse' : '' }}">

                                        {{-- PERUBAHAN 3: Konten kartu sekarang menempati seluruh ruang yang tersedia di dalam container ber-padding. --}}
                                        <div class="w-full md:w-5/12 {{ $loop->odd ? 'md:pr-8' : 'md:pl-8' }}">
                                            <div class="bg-white rounded-2xl shadow-xl p-8 transition-all duration-700 ease-out border border-gray-100"
                                                :class="visible ? 'opacity-100 translate-y-0 scale-100' :
                                                    'opacity-0 -translate-y-8 scale-95'">
                                                <h3 class="text-2xl font-bold text-indigo-600">{{ $item->tahun }}</h3>
                                                <p class="mt-3 text-gray-700 leading-relaxed">{{ $item->deskripsi }}</p>
                                            </div>
                                        </div>

                                        {{-- PERUBAHAN 4: Posisi titik (dot) diubah menjadi absolut untuk mobile dan kembali relatif untuk desktop. --}}
                                        <div
                                            class="absolute top-5 left-4 -translate-x-1/2 md:relative md:top-auto md:left-auto md:translate-x-0 md:w-2/12 flex justify-center x-ref='dot'">
                                            <div class="relative flex items-center justify-center h-5 w-5">
                                                <span
                                                    class="absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-0"
                                                    :class="visible ? 'animate-ping opacity-75' : ''"></span>
                                                <span
                                                    class="relative inline-flex rounded-full h-5 w-5 bg-indigo-500 ring-8 ring-white shadow-md transition-all duration-500"
                                                    :class="visible ? 'scale-100 opacity-100' : 'scale-0 opacity-0'"></span>
                                            </div>
                                        </div>

                                        {{-- Spacer untuk desktop tetap sama --}}
                                        <div class="hidden md:block md:w-5/12"></div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Data Sejarah Kosong</h3>
                                        <p class="mt-1 text-sm text-gray-500">Saat ini belum ada data sejarah yang
                                            ditambahkan.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Pastikan Anda memiliki fungsi AlpineJS ini di tag <script> Anda --}}
                <script>
                    function timeline() {
                        return {
                            lineHeight: 0,
                            updateLineHeight() {
                                const wrapper = this.$refs.timelineWrapper;
                                const dots = wrapper.querySelectorAll('[x-ref="dot"]');
                    
                                if (!wrapper || dots.length === 0) return;
                    
                                const scrollY = window.scrollY;
                                const windowHeight = window.innerHeight;
                    
                                // Titik tengah layar
                                const centerScreen = scrollY + windowHeight / 2;
                    
                                let newHeight = 0;
                    
                                // Loop semua dot
                                dots.forEach(dot => {
                                    const rect = dot.getBoundingClientRect();
                                    const dotY = scrollY + rect.top + rect.height/2; // posisi tengah dot
                    
                                    // Jika dot sudah lewat tengah layar, garis harus mencapai dot itu
                                    if (dotY <= centerScreen) {
                                        newHeight = dotY - (wrapper.offsetTop + wrapper.getBoundingClientRect().top - scrollY);
                                    }
                                });
                    
                                // Batasi agar tidak melebihi area timeline
                                const maxHeight = this.$refs.timelineContent.offsetHeight;
                                this.lineHeight = Math.min(newHeight, maxHeight);
                            }
                    }
                }

                </script>

                <section x-data="{ open: false, selectedImage: '' }">
                    <h2 class="text-3xl font-bold text-center text-gray-900">Struktur Organisasi</h2>
                    <div class="mt-8 flex justify-center">
                        @if ($organisasi)
                            <img src="{{ asset($organisasi->gambar) }}" alt="Struktur Organisasi"
                                @click="open = true; selectedImage = '{{ asset($organisasi->gambar) }}'"
                                class="rounded-lg shadow-lg max-w-4xl w-full cursor-pointer transition hover:opacity-90">
                        @else
                            <img src="https://placehold.co/800x400/e2e8f0/334155?text=Struktur+Organisasi"
                                alt="Struktur Organisasi" class="rounded-lg shadow-lg max-w-4xl w-full">
                        @endif
                    </div>

                    <div x-show="open" @click.away="open = false" @keydown.escape.window="open = false"
                        x-transition.opacity.duration.300ms
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75" x-cloak>
                        <div class="relative max-w-4xl max-h-[90vh] mx-4">
                            <img x-show="open" :src="selectedImage" alt="Struktur Organisasi diperbesar"
                                class="rounded-lg object-contain max-h-[90vh]">

                            <button @click="open = false"
                                class="absolute -top-5 -right-5 h-12 w-12 bg-white rounded-full text-gray-800 text-3xl font-bold flex items-center justify-center shadow-lg">
                                &times;
                            </button>
                        </div>
                    </div>
                </section>

                <section class="mb-12">
                    <div
                        class="bg-gradient-to-br from-gray-50 via-white to-gray-100 rounded-2xl p-8 md:p-12 shadow-inner">
                        <h2 class="text-3xl font-bold text-center text-gray-900 mb-10">Galeri Kegiatan</h2>

                        {{-- Cek apakah galeri memiliki data --}}
                        @if ($galeri->isNotEmpty())
                            {{-- JIKA ADA DATA: Tampilkan slider galeri seperti biasa --}}
                            <div x-data="responsiveGaleriSlider({{ $galeri->count() }})" x-init="init()">
                                <div class="relative max-w-5xl mx-auto" x-intersect:enter.once="isIntersecting = true">
                                    <div x-ref="slider" class="overflow-hidden"
                                        :class="!showButtons ? 'flex overflow-x-auto scroll-snap-x scroll-smooth' : ''"
                                        @scroll.throttle.50ms="updateIndexOnScroll()">

                                        <div class="flex gap-4"
                                            :class="{
                                                'w-full': !
                                                    showButtons,
                                                'transition-transform duration-500 ease-in-out': showButtons
                                            }"
                                            :style="showButtons ?
                                                `transform: translateX(-${startIndex * (itemWidth + gap)}px)` : ''">

                                            <template x-for="(item, index) in galeri" :key="index">
                                                <div class="flex-shrink-0 rounded-lg shadow-md cursor-pointer relative overflow-hidden group transition-all duration-700 ease-out"
                                                    :class="{
                                                        'opacity-100 translate-y-0': isIntersecting,
                                                        'opacity-0 translate-y-5': !isIntersecting,
                                                        'scroll-snap-align-start': !showButtons
                                                    }"
                                                    :style="`width: ${itemWidth}px; height: ${itemWidth * 0.7}px; transition-delay: ${index * 150}ms`"
                                                    @click="openModal(item.url)">
                                                    <img :src="item.url" alt="Galeri"
                                                        class="w-full h-full object-cover rounded-lg transition-transform duration-500 ease-in-out group-hover:scale-110">

                                                    <div
                                                        class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 transition-opacity duration-500 ease-in-out">
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    {{-- Tombol Navigasi --}}
                                    <button x-show="showButtons && startIndex > 0" @click="prev()"
                                        class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1/2 bg-indigo-500 text-white rounded-full shadow-lg w-12 h-12 flex items-center justify-center text-2xl z-10 hover:bg-indigo-600 transition">&#10094;</button>
                                    <button x-show="showButtons && startIndex + visibleCount < totalCount"
                                        @click="next()"
                                        class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 bg-indigo-500 text-white rounded-full shadow-lg w-12 h-12 flex items-center justify-center text-2xl z-10 hover:bg-indigo-600 transition">&#10095;</button>

                                    {{-- Dots Indicator --}}
                                    <div x-show="!showButtons" class="flex justify-center mt-4 space-x-2">
                                        <template x-for="(dot, index) in totalCount" :key="index">
                                            <button class="w-3 h-3 rounded-full transition-all duration-300"
                                                :class="startIndex === index ? 'bg-indigo-600 scale-125' : 'bg-gray-400'"></button>
                                        </template>
                                    </div>
                                </div>

                                {{-- Kode Modal Galeri --}}
                                <div x-show="open" @click.away="closeModal()" @keydown.escape.window="closeModal()"
                                    x-transition.opacity.duration.300ms
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
                                    x-cloak>
                                    <div class="relative max-w-4xl max-h-[90vh] mx-4">
                                        <img x-show="open" :src="selectedImage" alt="Galeri diperbesar"
                                            class="rounded-lg object-contain max-h-[90vh]">
                                        <button @click="closeModal()"
                                            class="absolute -top-5 -right-5 h-12 w-12 bg-white rounded-full text-gray-800 text-3xl font-bold flex items-center justify-center shadow-lg">&times;</button>
                                    </div>
                                </div>
                            </div>
                            {{-- Sisipkan script responsiveGaleriSlider di sini jika belum ada di file js utama --}}
                        @else
                            {{-- JIKA DATA KOSONG: Tampilkan 3 kartu placeholder dengan tulisan --}}
                            <div class="max-w-5xl mx-auto">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                                    {{-- Kartu Placeholder 1 --}}
                                    <div
                                        class="relative bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                                        {{-- Elemen ini menjaga rasio aspek kartu --}}
                                        <div class="pt-[70%]"></div>
                                        {{-- Tulisan yang diposisikan di tengah --}}
                                        <span class="absolute text-lg font-semibold text-gray-400">Galeri 1</span>
                                    </div>

                                    {{-- Kartu Placeholder 2 --}}
                                    <div
                                        class="relative bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                                        <div class="pt-[70%]"></div>
                                        <span class="absolute text-lg font-semibold text-gray-400">Galeri 2</span>
                                    </div>

                                    {{-- Kartu Placeholder 3 --}}
                                    <div
                                        class="relative bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                                        <div class="pt-[70%]"></div>
                                        <span class="absolute text-lg font-semibold text-gray-400">Galeri 3</span>
                                    </div>

                                </div>
                                <p class="text-center text-gray-500 mt-6">Belum ada galeri kegiatan yang diunggah.</p>
                            </div>
                        @endif

                    </div>
                </section>

                <style>
                    .scroll-snap-x {
                        display: flex;
                        overflow-x: auto;
                        scroll-snap-type: x mandatory;
                        -webkit-overflow-scrolling: touch;
                        scrollbar-width: none;
                    }

                    .scroll-snap-x::-webkit-scrollbar {
                        display: none;
                    }

                    .scroll-snap-align-start {
                        scroll-snap-align: start;
                        flex-shrink: 0;
                    }
                </style>

                <script>
                    function timeline() {
                        return {
                            lineHeight: 0,
                            updateLineHeight() {
                                if (!this.$refs.timelineWrapper || !this.$refs.timelineContent) return;
                                const wrapperTop = this.$refs.timelineWrapper.offsetTop;
                                const contentHeight = this.$refs.timelineContent.offsetHeight;
                                const scrollFromTop = window.pageYOffset;
                                const scrollProgress = scrollFromTop - wrapperTop + (window.innerHeight / 2.5);
                                const newHeight = Math.max(0, Math.min(scrollProgress, contentHeight));
                                this.lineHeight = newHeight;
                            }
                        }
                    }

                    function responsiveGaleriSlider(totalCount) {
                        return {
                            open: false,
                            selectedImage: '',
                            startIndex: 0,
                            visibleCount: 3,
                            totalCount: totalCount,
                            gap: 16,
                            itemWidth: 280,
                            showButtons: true,
                            galeri: @json($galeri->map(fn($item) => ['url' => asset($item->gambar)])),
                            isIntersecting: false,

                            init() {
                                this.updateVisibleCount();
                                window.addEventListener('resize', () => this.updateVisibleCount());
                            },

                            updateVisibleCount() {
                                const width = window.innerWidth;

                                if (width < 640) { // mobile
                                    this.visibleCount = 1;
                                    this.showButtons = false;
                                    const sliderWrapper = this.$refs.slider.parentElement;
                                    this.itemWidth = sliderWrapper.clientWidth;
                                } else if (width < 1024) { // tablet
                                    this.visibleCount = 2;
                                    this.showButtons = true;
                                    const container = this.$refs.slider.closest('.max-w-5xl');
                                    const containerWidth = container ? container.clientWidth : (1024 - 64);
                                    this.itemWidth = (containerWidth - (this.gap * (this.visibleCount - 1))) / this.visibleCount;
                                } else { // desktop
                                    this.visibleCount = 3;
                                    this.showButtons = true;
                                    const container = this.$refs.slider.closest('.max-w-5xl');
                                    const containerWidth = container ? container.clientWidth : 1024;
                                    this.itemWidth = (containerWidth - (this.gap * (this.visibleCount - 1))) / this.visibleCount;
                                }
                            },

                            // BARU: Fungsi untuk mengupdate index saat di-scroll/swipe di mobile
                            updateIndexOnScroll() {
                                if (!this.showButtons) { // Hanya berjalan di mode mobile
                                    const slider = this.$refs.slider;
                                    const currentIndex = Math.round(slider.scrollLeft / this.itemWidth);
                                    if (this.startIndex !== currentIndex) {
                                        this.startIndex = currentIndex;
                                    }
                                }
                            },

                            openModal(img) {
                                this.selectedImage = img;
                                this.open = true;
                            },

                            closeModal() {
                                this.open = false;
                                this.selectedImage = '';
                            },

                            prev() {
                                if (this.startIndex > 0) {
                                    this.startIndex--;
                                }
                            },

                            next() {
                                if (this.startIndex + this.visibleCount < this.totalCount) {
                                    this.startIndex++;
                                }
                            },
                        }
                    }
                </script>

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
