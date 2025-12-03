{{-- resources/views/components/service-card.blade.php --}}

@props([
    'delay' => '0ms',
    'startAnimation' => false,
    'icon' => '',
    'title' => '',
])

{{-- DIV LUAR: animasi masuk --}}
<div x-show="startAnimation" x-transition:enter="transition ease-out duration-500 transform"
    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
    x-bind:style="{ 'transition-delay': '{{ $delay }}' }">

    {{-- DIV DALAM: TIDAK ADA HOVER --}}
    <div class="bg-white p-8 rounded-xl shadow-lg transition-all duration-300 h-full">

        {{-- Ikon --}}
        <div class="bg-indigo-500 text-white rounded-full h-12 w-12 flex items-center justify-center">
            {{ $icon }}
        </div>

        {{-- Judul --}}
        <h3 class="mt-6 text-xl font-bold text-gray-900">{{ $title }}</h3>

        {{-- Deskripsi --}}
        <p class="mt-2 text-gray-600">
            {{ $slot }}
        </p>
    </div>
</div>
