@props(['default'=>true])
<button type="button"
    {{ $attributes->merge([
        'class' =>
            'flex flex-row items-center focus:outline-none focus:ring-2 rounded-lg text-sm p-2 '.($default ? 'hover:bg-gray-50 hover:text-gray-700  focus:ring-gray-100':''),
    ]) }}>
    {{ $slot }}

</button>
