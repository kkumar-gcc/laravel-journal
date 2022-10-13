<div>
    <x-buttons.primary wire:click.prefetch="showModal">
        {{ svg('iconsax-bul-edit-2', 'w-5 h-5') }}
    </x-buttons.primary>

    <div x-data="{ modal: @entangle('editRole')}" class="flex justify-center" >
        <div x-show="modal" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
            aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="modal=false" style="display: none;">
            <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-20" style="display: none;"></div>
            <div x-show="modal" x-transition="" x-on:click="modal = false"
                class="relative flex min-h-screen items-center justify-center p-4" style="display: none;">
                <div x-on:click.stop="" x-trap.noscroll.inert="modal"
                    class="relative w-full max-w-2xl overflow-y-auto rounded-xl bg-skin-base p-12  shadow-2xl">
                    <header class="flex items-center ">
                        <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700"></h5>
                        <div class="flex-1 flex justify-end">
                            <x-buttons.primary @click="modal=false" class="hover:text-skin-600">
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
                    <div class="mt-8">
                        <form wire:submit.prevent="update({{ $role->id }})">
                            @csrf
                            <input type="text" wire:model="name"
                                class="border border-gray-300 text-gray-600 text-base font-bold focus:ring-4 focus:shadow-md focus:ring-skin-500/20 focus:border-skin-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-skin-500"
                                placeholder="Role . . . ." />
                            <x-error field="name" class="text-rose-500" />
                            <x-buttons.secondary type="submit" class="mt-8">{{ __('Update') }}
                            </x-buttons.secondary>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
