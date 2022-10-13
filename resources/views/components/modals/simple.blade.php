@props(['default' => 'false'])
<div x-data="{ {{ $modal }}: {{ $default }} }">
    {{ $title }}
    <div x-show="{{ $modal }}"  x-cloak role="dialog" tabindex="-1" @keyup.escape.window="{{ $modal }}=false" style="display:none"
        class="fixed inset-0 w-screen h-screen z-[100] bg-black bg-opacity-20 flex items-center justify-center px-4 md:px-0">
        <div x-show="{{ $modal }}" x-trap.noscroll.inert="{{ $modal }}" x-cloak  @click.away="{{ $modal }}=false" x-transition.duration.500ms
        {{ $attributes->merge(['class' =>'relative w-full max-w-2xl overflow-y-auto rounded-xl bg-skin-base p-12 shadow-lg'])}}>
            <h2 class="text-3xl font-bold" :id="$id('modal-title')"> {{ $slot }}</h2>
           <div class="mt-8 flex space-x-2">
                <button type="button" @click="{{ $modal }}=false"
                    class="rounded-md border border-gray-200 bg-skin-base px-5 py-2.5">
                    Confirm
                </button>
                <button type="button" @click="{{ $modal }}=false"
                    class="rounded-md border border-gray-200 bg-skin-base px-5 py-2.5">
                    Cancel
                </button>
            </div>
        </div>

    </div>
</div>
