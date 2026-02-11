@props([
    'icon' => 'heroicon-o-question-mark-circle',
    'title' => '',
])

<div class="bg-white p-6 rounded-2xl shadow-lg text-center h-full">
    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-500 text-white mx-auto mb-5">
        <x-dynamic-component :component="$icon" class="h-8 w-8" />
    </div>

    <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>

    <p class="mt-2 text-gray-600">
        {{ $slot }}
    </p>
</div>