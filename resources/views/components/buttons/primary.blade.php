@props(['fullWidth' => false, 'type' => 'button'])
<span class="{{ $fullWidth ? 'flex' : 'inline-flex' }} rounded-md shadow-sm">
    @if ($attributes->has('href'))
        <a type={{ $type }}
            {{ $attributes->merge([
                'class' =>
                    ($fullWidth ? 'w-full ' : '') .
                    'bg-teal-500 text-white  capatalize py-2 px-4 leading-6 cursor-pointer inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer border md:border-2 border-teal-500  transition duration-200 ease-in-out shadow-md shadow-teal-100',
            ]) }}>
            {{ $slot }}
        </a>
    @else
        <button type={{ $type }}
            {{ $attributes->merge([
                'class' =>
                    ($fullWidth ? 'w-full ' : '') .
                    'bg-white  capatalize py-2 px-4 leading-6 cursor-pointer inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-sm shadow-gray-100',
           ]) }}>
            {{ $slot }}
        </button>
    @endif
</span>
