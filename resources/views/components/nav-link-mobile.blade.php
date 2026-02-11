@props(['href', 'active' => false])

@php
$classes = ($active ?? false)
            ? 'bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium'
            : 'text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }} {{ $active ? 'aria-current="page"' : '' }}>
    {{ $slot }}
</a>