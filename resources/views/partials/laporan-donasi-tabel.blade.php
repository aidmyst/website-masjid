<div class="p-6 rounded-lg shadow-md bg-white">
    
    <div class="text-center mb-5">
        <h3 class="text-lg font-semibold text-gray-800">{{ $judul }}</h3>
        <p class="text-sm text-gray-500 mt-1">{{ $deskripsi }}</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($laporan as $item)
            <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white hover:shadow-md transition">
                
                <div class="text-xs text-gray-400">Tanggal</div>
                <div class="font-semibold text-gray-900 mb-2">
                    {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                </div>

                <div class="text-xs text-gray-400">Nominal</div>
                <div class="text-green-600 font-bold text-xl">
                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                </div>

            </div>
        @empty
            <p class="text-center text-gray-500 col-span-full">
                Belum ada donasi untuk kategori ini.
            </p>
        @endforelse
    </div>

</div>
