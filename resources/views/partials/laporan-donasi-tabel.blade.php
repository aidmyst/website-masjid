<div class="p-6 rounded-lg shadow-md bg-white">

    <div class="text-center mb-5">
        <h3 class="text-lg font-semibold text-gray-800">{{ $judul }}</h3>
        <p class="text-sm text-gray-500 mt-1">{{ $deskripsi }}</p>
    </div>

    {{-- Slider --}}
    <div x-data="donasiSlider({{ count($laporan) }})" x-init="init()" x-effect="if ($el.offsetParent !== null) update()"
        class="relative">

        {{-- Wrapper --}}
        <div class="overflow-hidden"
            :class="!showButtons ? 'overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar' : ''"
            x-ref="slider" @scroll.throttle.50ms="updateIndexOnScroll()">

            {{-- Track --}}
            <div class="flex gap-4 px-4 sm:px-6" x-ref="track"
                :class="{ 'transition-transform duration-500 ease-in-out': showButtons }"
                :style="showButtons ? `transform: translateX(-${startIndex * (itemWidth + gap)}px)` : ''">

                @forelse ($laporan as $item)
                    <div class="flex-shrink-0 snap-center" :class="!showButtons ? 'w-full px-4' : ''"
                        :style="showButtons ? `width:${itemWidth}px` : ''">

                        <div
                            class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white hover:shadow-md transition">

                            <div class="text-xs text-gray-400">Tanggal</div>
                            <div class="font-semibold text-gray-900 mb-2">
                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </div>

                            <div class="text-xs text-gray-400">Nominal</div>
                            <div class="text-green-600 font-bold text-xl">
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </div>

                        </div>

                    </div>
                @empty
                    <p class="text-center text-gray-500 w-full py-10">
                        Belum ada donasi untuk kategori ini.
                    </p>
                @endforelse

            </div>
        </div>

        {{-- Tombol Desktop --}}
        <button x-show="showButtons && startIndex > 0" @click="prev()"
            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 bg-indigo-500 text-white w-10 h-10 rounded-full shadow hover:bg-indigo-600 transition">
            ❮
        </button>

        <button x-show="showButtons && startIndex + visibleCount < totalCount" @click="next()"
            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 bg-indigo-500 text-white w-10 h-10 rounded-full shadow hover:bg-indigo-600 transition">
            ❯
        </button>

        {{-- Dots Mobile --}}
        <div x-show="!showButtons" class="flex justify-center mt-4 space-x-2">
            <template x-for="(dot,index) in totalCount" :key="index">
                <div class="w-2.5 h-2.5 rounded-full" :class="startIndex === index ? 'bg-indigo-600' : 'bg-gray-400'">
                </div>
            </template>
        </div>

    </div>
</div>
