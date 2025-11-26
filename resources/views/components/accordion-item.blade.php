@props([
    'id' => 0,
    'icon' => '',
    'title' => '',
    'delay' => '150ms',
])

<div x-data="{
        id: {{ $id }},
        get expanded() { return this.open === this.id },
        set expanded(value) { this.open = value ? this.id : null }
     }"
     class="bg-white rounded-xl shadow-sm border border-gray-200/80 transition-all duration-1000 ease-out"
     :class="startAnimation ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'"
     :style="'transition-delay: {{ $delay }}'">

    <button @click="expanded = !expanded" class="flex items-center justify-between w-full text-left p-6">
        <span class="flex items-center space-x-4">
            <span class="text-indigo-500">
                <x-dynamic-component :component="$icon" class="w-6 h-6" />
            </span>
            <span class="text-lg font-semibold text-gray-800">{{ $title }}</span>
        </span>
        <span class="transform transition-transform duration-300" :class="expanded ? 'rotate-180' : ''">
            <x-heroicon-o-chevron-down class="w-6 h-6 text-gray-400" />
        </span>
    </button>

    <div x-show="expanded" x-transition class="overflow-hidden">
        <div class="px-6 pb-6 pt-2 text-gray-600">
            <p>{{ $slot }}</p>
        </div>
    </div>
</div>