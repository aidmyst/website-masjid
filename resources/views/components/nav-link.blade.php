@props(['active'])

@php
    $classes = $active
        ? 'relative inline-flex items-center px-3 py-2 text-sm font-medium text-white 
       after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-indigo-500 after:scale-x-100 after:transition-transform after:duration-300'
        : 'relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-300 hover:text-white transition
       after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-indigo-500 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
