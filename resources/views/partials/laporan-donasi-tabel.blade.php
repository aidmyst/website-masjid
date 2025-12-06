<div class="p-6 rounded-lg shadow-md bg-white">
    
    {{-- Judul & Deskripsi --}}
    <div class="text-center mb-5">
        <h3 class="text-lg font-semibold text-gray-800">{{ $judul }}</h3>
        <p class="text-sm text-gray-500 mt-1">{{ $deskripsi }}</p>
    </div>

    {{-- MOBILE CARD LIST --}}
    <div class="space-y-4 sm:hidden">
        @forelse ($laporan as $item)
            <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                <div class="text-xs text-gray-400">Tanggal</div>
                <div class="font-semibold text-gray-900 mb-2">
                    {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                </div>

                <div class="text-xs text-gray-400">Nominal</div>
                <div class="text-green-600 font-bold text-lg">
                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">
                Belum ada donasi untuk kategori ini.
            </p>
        @endforelse
    </div>

    {{-- DESKTOP TABLE --}}
    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full border-collapse rounded-lg overflow-hidden bg-white">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Nominal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @forelse($laporan as $item)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-6 py-3 text-gray-700">
                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                        <td class="px-6 py-3 text-green-600 font-bold">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                            Belum ada donasi untuk kategori ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
