<div class="p-6 rounded-lg shadow-sm">
    
    {{-- 2. Judul dan Deskripsi disesuaikan warnanya --}}
    <div class="text-center mb-4">
        <h3 class="text-lg font-semibold">{{ $judul }}</h3>
        <p class="text-sm text-gray-600 mt-1">{{ $deskripsi }}</p>
    </div>
    
    {{-- 3. Tabel dengan style dark-mode dashboard --}}
    <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-lg shadow-sm overflow-hidden">
            {{-- Header tabel --}}
            <thead class="bg-indigo-600 text-white hidden sm:table-header-group">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold tracking-wider uppercase">
                        Nominal
                    </th>
                </tr>
            </thead>
            {{-- Isi tabel --}}
            <tbody class="divide-y divide-gray-600">
                @forelse($laporan as $item)
                    {{-- 4. Baris tabel dengan style dark-mode --}}
                    <tr class="block sm:table-row mb-4 sm:mb-0">
                        <td class="sm:table-cell block px-6 py-2">
                            {{-- Label untuk mobile --}}
                            <span class="font-semibold sm:hidden text-gray-400">Tanggal: </span>
                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                        <td class="sm:table-cell block px-6 py-2">
                            {{-- Label untuk mobile --}}
                            <span class="font-semibold sm:hidden text-gray-400">Nominal: </span>
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-sm text-gray-400">
                            Belum ada donasi untuk kategori ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>