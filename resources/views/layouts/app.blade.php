<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jami Aisyah') }}</title>

    <link rel="icon" href="{{ asset('logo-masjid.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div
        class="min-h-screen 
        {{ request()->is('dashboard*') ? 'bg-gray-900 dark:bg-gray-900' : 'bg-gray-100 dark:bg-gray-100' }}">

        {{-- ========================================================== --}}
        {{--                REVISI UTAMA ADA DI BLOK INI              --}}
        {{-- ========================================================== --}}
        
        {{-- Cek dulu apakah halaman ini mengirim slot navigasi kustom --}}
        @if (isset($navigation))
            {{-- 
                Jika ya (seperti dari hal. konfirmasi_donasi), 
                tampilkan isi slot itu. 
                (Jika slotnya dikirim kosong, maka tidak akan tampil apa-apa).
            --}}
            {{ $navigation }}
        @else
            {{-- 
                Jika tidak ada slot kustom, jalankan logika navigasi 
                standar Anda (publik atau dashboard).
            --}}
            @if (request()->is('dashboard*'))
                @include('layouts.navigation-dashboard')
            @else
                @include('layouts.navigation-public')
            @endif
        @endif
        {{-- ========================================================== --}}
        {{--                       AKHIR REVISI                       --}}
        {{-- ========================================================== --}}


        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 900, // durasi animasi (ms)
            once: true, // hanya animasi sekali
            easing: 'ease-in-out',
            offset: 100, // jarak mulai animasi
        });
    </script>

</body>

</html>