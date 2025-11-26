@php
    // Kita susun data kegiatan rutin ke dalam array agar rapi
    $kegiatanRutin = [
        [
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>',
            'title' => 'Kajian Ba’da Maghrib (Rabu–Jum’at–Ahad)',
            'description' =>
                'Mari hadir bersama dalam kajian selepas Maghrib, memperdalam pemahaman Al-Qur’an dan hadits, serta menambah ilmu agama untuk bekal kehidupan sehari-hari.',
        ],
        [
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962a3.75 3.75 0 015.962 0L14.25 6h5.25M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>',
            'title' => 'Pengajian Ibu-Ibu (Tanggal 12)',
            'description' =>
                'Wadah silaturahmi sekaligus belajar agama bagi kaum ibu, setiap tanggal 12. Di sini kita saling menguatkan peran ibu sebagai madrasah pertama bagi keluarga.',
        ],
        [
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0l-.07.004-.002.001-.002.001-.001.001-.001.001-.001.001a51.112 51.112 0 003.18.399m12.028 0l.07.004.002.001.002.001.001.001.001.001.001.001a51.112 51.112 0 01-3.18.399m0 0c-.891 0-1.762-.12-2.606-.360M3.493 12a59.902 59.902 0 0110.399-5.84c.896-.248 1.783-.52 2.658-.814m-15.482 0a50.57 50.57 0 012.658-.813m15.482 0a50.57 50.57 0 002.658-.813m0 0a59.905 59.905 0 00-10.399-5.84c-.891.247-1.783.519-2.658.813m15.482 0a50.57 50.57 0 01-2.658.814m0 0a51.112 51.112 0 00-3.18-.399m-12.028 0a51.112 51.112 0 01-3.18-.399m15.228 0c.891 0 1.762.12 2.606.36m-17.812 0c.844.24 1.715.36 2.606.36m12.606 0c.844 0 1.715-.12 2.606-.36m-17.812 0c.844.24 1.715.36 2.606.36" /></svg>',
            'title' => 'TPA (Ibu-Ibu & Lansia)',
            'description' =>
                'Kesempatan bagi para ibu dan lansia untuk memperbaiki bacaan Al-Qur’an dan meningkatkan kecintaan pada kalamullah. Belajar Al-Qur’an tidak mengenal usia.',
        ],
        [
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a2.25 2.25 0 01-2.25 2.25H5.25a2.25 2.25 0 01-2.25-2.25v-8.25M12 4.875A2.625 2.625 0 1014.625 7.5H9.375A2.625 2.625 0 1012 4.875zM12 12.75a2.625 2.625 0 110 5.25 2.625 2.625 0 010-5.25z" /></svg>',
            'title' => 'Jum’at Berkah',
            'description' =>
                'Setiap hari Jum’at, kita berbagi keberkahan melalui sedekah, santunan, dan kebersamaan. Ayo ikut berkontribusi dalam menebar manfaat untuk sesama.',
        ],
        [
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /></svg>',
            'title' => 'Subuh Barokah (Ahad Pertama)',
            'description' =>
                'Awali bulan dengan semangat iman! Shalat Subuh berjamaah di Ahad pertama setiap bulan, dilanjutkan kajian ringan dan sarapan bersama jamaah.',
        ],
        [
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" /></svg>',
            'title' => 'Tadabbur Alam (Tahunan)',
            'description' =>
                'Sejenak keluar dari rutinitas, bersama-sama menikmati keindahan alam sembari merenungi kebesaran Allah sebagai ajang ukhuwah dan penyegaran rohani.',
        ],
    ];
@endphp
