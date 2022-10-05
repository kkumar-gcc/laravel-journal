@props(['default'])
@php
$classes = $default ?? false
           ? 'p-1 px-2 md:p-2.5 border border-gray-200 relative  mt-8 first:mt-0 w-full text-base text-left rounded-lg  font-normal shadow-sm hover:shadow-md'
           : 'border border-gray-200  relative  mt-8 first:mt-0 w-full text-base text-left rounded-lg  font-normal shadow-sm hover:shadow-md';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
