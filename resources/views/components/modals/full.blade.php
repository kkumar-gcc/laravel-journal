@props(['default' => 'false'])
{{-- <div x-data="{ {{ $modal }}: {{ $default }} }">
    {{ $title }}
    <div x-show="{{ $modal }}" x-cloak role="dialog" tabindex="-1" @keyup.escape.window="{{ $modal }}=false"
        style="display:none"
        class="fixed top-0 left-0 z-[100] w-full h-full bg-black bg-opacity-80  outline-none overflow-x-hidden overflow-y-auto md:py-2">
        <div x-show="{{ $modal }}" x-trap.noscroll.inert="{{ $modal }}" x-cloak
            @click.away="{{ $modal }}=false" x-transition.duration.500ms
            {{ $attributes->merge(['class' => 'relative  md:max-w-3xl md:rounded-xl bg-skin-base p-6 md:p-12 mx-auto shadow-lg w-full h-full overflow-y-auto md:h-auto md:overflow-hidden']) }}>
            <header class="flex items-center">
                <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700">{{ $header }}</h5>
                <div class="flex-1 flex justify-end">
                    <x-buttons.primary @click="{{ $modal }}=false" class="hover:text-skin-600">
                        <svg class="h-6 w-6" viewBox="0 0 456 512" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor">
                            <title>cancel</title>
                            <path
                                d="M64 388L196 256 64 124 96 92 228 224 360 92 392 124 260 256 392 388 360 420 228 288 96 420 64 388Z">
                            </path>
                        </svg>
                    </x-buttons.primary>
                </div>

            </header>
            <div class="mt-12">
                {{ $slot }}
            </div>
        </div>
    </div>
</div> --}}
<div x-data="{ {{ $modal }}: {{ $default }} }">
    {{ $title }}
    <div x-show="{{ $modal }}" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
        aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="{{ $modal }}=false" style="display: none;">
        <div x-show="{{ $modal }}" class="fixed inset-0 bg-black bg-opacity-10" style="display: none;"></div>
        <div x-show="{{ $modal }}" x-transition="" x-on:click="{{ $modal }} = false"
            class="relative flex min-h-screen items-center justify-center md:p-4" style="display: none;">
            <div x-on:click.stop="" x-trap.noscroll.inert="{{ $modal }}"
                class="relative w-full md:h-auto  md:max-w-3xl overflow-y-auto md:rounded-xl bg-skin-base p-6 md:p-12">
                <header class="flex items-center">
                    <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700">{{ $header }}</h5>
                    <div class="flex-1 flex justify-end">
                        <x-buttons.primary @click="{{ $modal }}=false" class="hover:text-skin-600">
                            <svg class="h-6 w-6" viewBox="0 0 456 512" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor">
                                <title>cancel</title>
                                <path
                                    d="M64 388L196 256 64 124 96 92 228 224 360 92 392 124 260 256 392 388 360 420 228 288 96 420 64 388Z">
                                </path>
                            </svg>
                        </x-buttons.primary>
                    </div>

                </header>
                <div class="mt-12">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
