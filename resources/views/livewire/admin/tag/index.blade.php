<div>
    <div class="max-w-7xl ">
        <div class="bg-skin-base overflow-hidden  sm:rounded-lg p-2">
            @if (auth()->user()->can('create tags'))
                <div class="flex justify-end p-2 mb-6">
                    <x-buttons.secondary wire:click="$emit('createTag')">{{ __('Create Tag') }}
                    </x-buttons.secondary>
                </div>
            @endif
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg border">
                        <table class="min-w-full divide-y divide-gray-200 sm:rounded-lg">
                            <thead class="bg-gray-50 font-medium text-left">
                                <tr>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        #</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        Tag</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        Description</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        color</th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-skin-base divide-y divide-gray-200 text-gray-600">
                                @foreach ($tags as $key => $tag)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-tag :tag=$tag id="tag-{{ $tag->id }}" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $tag->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $tag->color }}
                                        </td>
                                        <td>
                                            <div class="flex justify-end">
                                                <div class="flex space-x-2 px-2">
                                                    @if (auth()->user()->can('edit tags'))
                                                        <x-buttons.primary wire:click="edit({{ $tag->id }})">
                                                            {{ svg('iconsax-bul-edit-2', 'w-5 h-5') }}
                                                        </x-buttons.primary>
                                                    @endif
                                                    @if (auth()->user()->can('delete tags'))
                                                        <x-buttons.primary
                                                            wire:click="deleteConfirm({{ $tag->id }})">
                                                            {{ svg('iconsax-lin-trash', 'h-5 w-5') }}
                                                        </x-buttons.primary>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $tags->withQueryString()->links('livewire::tailwind') !!}
        </div>
    </div>

    @if (auth()->user()->can('create tags'))
        {{-- create role modal --}}
        <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('createTag', () => {
            modal = true;
        });
        @this.on('closeModal', () => {
            modal = false;
        })">
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
                            <form wire:submit.prevent="store()">
                                @csrf
                                <div class="mb-4">
                                    <label
                                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                        for="title">Title</label>
                                    <x-form.input-field type="text" id="title" wire:model="title" />
                                    <x-error field="title" class="text-rose-500" />
                                </div>
                                <div class="mb-4">
                                    <label
                                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                        for="description">Description</label>
                                    <textarea id="description"
                                        class="border border-gray-300 text-gray-600 text-base font-semibold focus:shadow-md focus:ring-4 focus:ring-skin-500/20 focus:border-skin-600 block w-full p-3.5  "
                                        maxlength="200" rows="4" wire:model="description"></textarea>
                                    <x-error field="description" class="text-rose-500" />
                                </div>
                                <x-buttons.secondary type="submit" class="mt-8">{{ __('Submit') }}
                                </x-buttons.secondary>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->can('edit tags'))
        {{-- edit role modal --}}
        <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('editTag', () => {
            modal = true;
        });
        @this.on('closeModal', () => {
            modal = false;
        })">
            <div x-show="modal" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
                aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="modal=false" style="display: none;">
                <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-20" style="display: none;"></div>
                <div x-show="modal" x-transition="" x-on:click="modal = false"
                    class="relative flex min-h-screen items-center justify-center p-4" style="display: none;">
                    <div x-on:click.stop x-trap.noscroll.inert="modal"
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
                            <form wire:submit.prevent="update({{ $tag_id }})">
                                @csrf
                                <div class="mb-4">
                                    <label
                                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                        for="title">Title</label>
                                    <x-form.input-field type="text" id="title" wire:model="title" />
                                    <x-error field="title" class="text-rose-500" />
                                </div>
                                <div class="mb-4">
                                    <label
                                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                        for="description">Description</label>
                                    <textarea id="description"
                                        class="border border-gray-300 text-gray-600 text-base font-semibold focus:shadow-md focus:ring-4 focus:ring-skin-500/20 focus:border-skin-600 block w-full p-3.5  "
                                        maxlength="200" rows="4" wire:model="description"></textarea>
                                    <x-error field="description" class="text-rose-500" />
                                </div>
                                <div class="mb-4">
                                    {{ $color }}
                                    <label
                                        class="te"xt-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                        >Color</label>
                                    <div class="py-8">
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-1" wire:model="color"
                                                value="theme-none" class="hidden peer" ">
                                            <label for="demo-1"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-md">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm  uppercase ">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-2" wire:model="color"
                                                value="theme-gray" class="hidden peer" >
                                            <label for="demo-2"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-gray-200 uppercase  bg-gray-100 text-gray-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-3" wire:model="color"
                                                value="theme-red" class="hidden peer" >
                                            <label for="demo-3"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-red-200 uppercase  bg-red-100 text-red-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-4" wire:model="color"
                                                value="hosting-small" class="hidden peer" >
                                            <label for="demo-4"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-orange-200 uppercase  bg-orange-100 text-orange-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-5" wire:model="color"
                                                value="theme-rose" class="hidden peer" >
                                            <label for="demo-5"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-6" wire:model="color"
                                                value="theme-amber" class="hidden peer" >
                                            <label for="demo-6"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-amber-200 uppercase  bg-amber-100 text-amber-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-8" wire:model="color"
                                                value="theme-yellow" class="hidden peer" >
                                            <label for="demo-8"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-yellow-200 uppercase  bg-yellow-100 text-yellow-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-9" wire:model="color"
                                                value="theme-lime" class="hidden peer" >
                                            <label for="demo-9"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-lime-200 uppercase  bg-lime-100 text-lime-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-10" wire:model="color"
                                                value="theme-green" class="hidden peer" >
                                            <label for="demo-10"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-green-200 uppercase  bg-green-100 text-green-600">
                                                    #demo</span>
                                            </label>
                                        </div>

                                        <div class="inline-flex">
                                            <input type="radio" id="demo-11" wire:model="color"
                                                value="theme-emerald" class="hidden peer" >
                                            <label for="demo-11"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-emerald-200 uppercase  bg-emerald-100 text-emerald-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        {{-- <div class="inline-flex">
                                            <input type="radio" id="demo-12" wire:model="color"
                                                value="hosting-small" class="hidden peer" >
                                            <label for="demo-12"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-emerald-200 uppercase  bg-emerald-100 text-emerald-600">
                                                    #demo</span>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-13" wire:model="color"
                                                value="hosting-small" class="hidden peer" >
                                            <label for="demo-13"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-emerald-200 uppercase  bg-emerald-100 text-emerald-600">
                                                    #demo</span>
                                            </label>
                                        </div> --}}
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-14" wire:model="color"
                                                value="theme-teal" class="hidden peer" >
                                            <label for="demo-14"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-teal-200 uppercase  bg-teal-100 text-teal-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-15" wire:model="color"
                                                value="theme-cyan" class="hidden peer" >
                                            <label for="demo-15"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-cyan-200 uppercase  bg-cyan-100 text-cyan-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-16" wire:model="color"
                                                value="theme-sky" class="hidden peer" >
                                            <label for="demo-16"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-sky-200 uppercase  bg-sky-100 text-sky-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-17" wire:model="color"
                                                value="theme-blue" class="hidden peer" >
                                            <label for="demo-17"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-blue-200 uppercase  bg-blue-100 text-blue-600">
                                                    #demo</span>
                                            </label>
                                        </div>

                                        <div class="inline-flex">
                                            <input type="radio" id="demo-18" wire:model="color"
                                                value="theme-indigo" class="hidden peer" >
                                            <label for="demo-18"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-indigo-200 uppercase  bg-indigo-100 text-indigo-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-19" wire:model="color"
                                                value="theme-violet" class="hidden peer" >
                                            <label for="demo-19"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-violet-200 uppercase  bg-violet-100 text-violet-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-20" wire:model="color"
                                                value="theme-purple" class="hidden peer" >
                                            <label for="demo-20"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-purple-200 uppercase  bg-purple-100 text-purple-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                        <div class="inline-flex">
                                            <input type="radio" id="demo-21" wire:model="color"
                                                value="theme-fuchsia" class="hidden peer" >
                                            <label for="demo-21"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-fuchsia-200 uppercase  bg-fuchsia-100 text-fuchsia-600">
                                                    #demo</span>
                                            </label>
                                        </div>

                                        <div class="inline-flex">
                                            <input type="radio" id="demo-22" wire:model="color"
                                                value="theme-pink" class="hidden peer" >
                                            <label for="demo-22"
                                                class="inline-flex justify-between items-center p-3 w-full  bg-skin-base rounded-sm border border-transparent cursor-pointer   peer-checked:border-black peer-checked:shadow-sm">
                                                <span
                                                    class="inline-flex py-1 px-2 mx-[5px]  text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-pink-200 uppercase  bg-pink-100 text-pink-600">
                                                    #demo</span>
                                            </label>
                                        </div>
                                    </div>
                                    <x-error field="color" class="text-rose-500" />
                                </div>
                                <x-buttons.secondary type="submit">{{ __('Update') }}
                                </x-buttons.secondary>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if (auth()->user()->can('delete tags'))
        <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('deleteTag', () => {
            modal = true;
        });
        @this.on('closeModal', () => {
            modal = false;
        })">
            <div x-show="modal" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
                aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="modal=false"
                style="display: none;">
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
                            <form wire:submit.prevent="delete({{ $tag_id }})">
                                @csrf
                                @method('DELETE')
                                <p class="text-base font-semibold">Are you sure that you want to delete <b
                                        class="uppercase">{{ $title }}</b> tag?</p>
                                <x-buttons.danger type="submit" class="mt-6">{{ __('delete') }}
                                </x-buttons.danger>
                                <x-buttons.primary class="mt-6 ml-2">{{ __('cancel') }}
                                </x-buttons.primary>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
