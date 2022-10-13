@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-gray-300 text-gray-600 text-base font-semibold focus:shadow-md focus:ring-4 focus:ring-skin-500/20 focus:border-skin-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-skin-500']) !!} />
