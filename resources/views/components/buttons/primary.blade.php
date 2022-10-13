@props(['fullWidth' => false, 'type' => 'button'])
<span class="{{ $fullWidth ? 'flex' : 'inline-flex' }}">
    @if ($attributes->has('href'))
        <a type={{ $type }}
            {{ $attributes->merge([
                'class' =>
                    ($fullWidth ? 'w-full ' : '') .
                    'bg-skin-base  capatalize py-2 px-4 leading-6 cursor-pointer border inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-sm shadow-gray-100',
            ]) }}>
            {{ $slot }}
        </a>
    @else
        <button type={{ $type }}
            {{ $attributes->merge([
                'class' =>
                    ($fullWidth ? 'w-full ' : '') .
                    'bg-skin-base  capatalize py-2 px-4 leading-6 cursor-pointer border inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-sm shadow-gray-100',
           ]) }}>
            {{ $slot }}
        </button>
    @endif
</span>
