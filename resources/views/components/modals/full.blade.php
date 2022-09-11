@props(['default' => 'false'])
<div x-data="{ {{ $modal }}: {{ $default }} }">
    {{ $title }}
    <div x-show="{{ $modal }}" x-cloak role="dialog" tabindex="-1" @keyup.escape.window="{{ $modal }}=false"
        style="display:none"
        class="fixed inset-0 w-screen h-screen z-[100] bg-black bg-opacity-5 flex items-center justify-center">
        <div x-show="{{ $modal }}" x-trap.noscroll.inert="{{ $modal }}" x-cloak
            @click.away="{{ $modal }}=false" x-transition.duration.500ms
            {{ $attributes->merge(['class' => 'relative w-full h-full overflow-y-auto bg-white p-3 md:p-8 lg:p-12 shadow-lg']) }}>
            <header class="flex items-center">
             <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700">{{ $header }}</h5>
             <div class="flex-1 flex justify-end">
                <x-buttons.primary @click="{{ $modal }}=false" class="hover:text-teal-600">
                    <svg class="h-6 w-6" viewBox="0 0 456 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><title>cancel</title><path d="M64 388L196 256 64 124 96 92 228 224 360 92 392 124 260 256 392 388 360 420 228 288 96 420 64 388Z"></path></svg>
                </x-buttons.primary>
             </div>

            </header >
            <div class="mt-12">
                {{ $slot }}
            </div>
            <footer class="mt-8 flex space-x-2">
                {{-- <button type="button" @click="{{ $modal }}=false"
                    class="rounded-md border border-gray-200 bg-white px-5 py-2.5">
                    Confirm
                </button>
                <button type="button" @click="{{ $modal }}=false"
                    class="rounded-md border border-gray-200 bg-white px-5 py-2.5">
                    Cancel
                </button> --}}
            </footer>
        </div>

    </div>
</div>
