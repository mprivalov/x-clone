@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full px-4 py-2 text-start text-sm leading-5 text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 transition duration-300 ease-in-out'
            : 'flex items-center w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:text-indigo-700 hover:fill-indigo-700 hover:bg-gray-50 focus:outline-none focus:text-indigo-800 focus:bg-gray-100 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
