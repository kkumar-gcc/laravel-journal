@props(['fullWidth' => false, 'type' => 'button', 'default'])
@php
$classes = $default ?? true ? 'w-full text-white text-sm capatalize py-2 px-4 leading-6 cursor-pointer inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-md shadow-rose-100 bg-rose-500' : 'capatalize text-sm py-2 px-4 leading-6 cursor-pointer inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer  transition duration-200 ease-in-out';
@endphp

<span class="{{ $fullWidth ? 'flex w-full' : 'inline-flex' }}">
    @if ($attributes->has('href'))
        <a type={{ $type }} {{ $attributes->merge(['class' => $classes]) }}>
            {{ $slot }}
        </a>
    @else
        <button type={{ $type }} {{ $attributes->merge(['class' => $classes]) }}>
            {{ $slot }}
        </button>
    @endif
</span>
