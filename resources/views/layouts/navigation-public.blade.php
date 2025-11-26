{{-- NAVIGASI --}}
<nav class="bg-gray-800 sticky top-0 z-50 shadow-md" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">

            {{-- Logo + Nama Masjid --}}
            <div class="flex flex-1 items-center">
                <a href="{{ route('beranda') }}" class="flex items-center space-x-3">
                    <img class="h-10 w-10 object-cover rounded-full shadow-md" src="{{ asset('images/masjid.jpg') }}"
                        alt="Logo Masjid">
                    <span class="text-lg font-semibold text-white tracking-wide hover:text-indigo-400 transition">
                        Jami Aisyah
                    </span>
                </a>
            </div>

            {{-- Menu Navigasi Desktop --}}
            <div class="hidden md:flex md:items-center md:space-x-6">
                <x-nav-link :href="route('beranda')" :active="request()->routeIs('beranda')">Beranda</x-nav-link>
                <x-nav-link :href="route('tentang')" :active="request()->routeIs('tentang')">Tentang</x-nav-link>
                <x-nav-link :href="route('kajian')" :active="request()->routeIs('kajian')">Kajian</x-nav-link>
                <x-nav-link :href="route('donasi')" :active="request()->routeIs('donasi')">Donasi</x-nav-link>
            </div>

            {{-- Tombol Menu Mobile --}}
            <div class="absolute inset-y-0 right-0 flex items-center md:hidden">
                <button @click="open = !open" type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white transition">
                    <span class="sr-only">Buka menu utama</span>
                    <svg x-show="!open" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden absolute w-full origin-top bg-gray-800 shadow-lg z-40" x-cloak>
        <div class="space-y-1 px-4 py-4">
            <x-nav-link-mobile :href="route('beranda')" :active="request()->routeIs('beranda')">Beranda</x-nav-link-mobile>
            <x-nav-link-mobile :href="route('tentang')" :active="request()->routeIs('tentang')">Tentang</x-nav-link-mobile>
            <x-nav-link-mobile :href="route('kajian')" :active="request()->routeIs('kajian')">Kajian</x-nav-link-mobile>
            <x-nav-link-mobile :href="route('donasi')" :active="request()->routeIs('donasi')">Donasi</x-nav-link-mobile>
        </div>
    </div>
</nav>
