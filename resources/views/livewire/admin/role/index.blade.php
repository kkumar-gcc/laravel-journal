<div>
    <div class="max-w-7xl ">
        <div class="bg-skin-base overflow-hidden  sm:rounded-lg p-2">
            @if (auth()->user()->can('create roles'))
                <div class="flex justify-end p-2 mb-6">
                    <x-buttons.secondary wire:click="$emit('createRole')">{{ __('Create role') }}
                    </x-buttons.secondary>
                </div>
            @endif
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg border">
                            <table class="min-w-full divide-y divide-gray-200 sm:rounded-lg">
                                <thead class="bg-gray-50 font-medium text-left">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                            #</th>
                                        <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                            Name</th>
                                        <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                            guard</th>
                                        <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                            users</th>
                                        <th scope="col" class="relative px-6 py-4">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-skin-base divide-y divide-gray-200 text-gray-600">
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $role->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $role->guard_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $role->users->count() }}
                                            </td>
                                            <td>
                                                <div class="flex justify-end">
                                                    <div class="flex space-x-2 px-2">
                                                        @if (auth()->user()->can('access role permissions'))
                                                            <livewire:admin.role.permissions :role_id="$role->id"
                                                                wire:key="permission-{{ $role->id }}" />
                                                        @endif
                                                        @if (auth()->user()->can('edit roles'))
                                                            <livewire:admin.role.edit :role="$role"
                                                                wire:key="{{ $role->id }}" />
                                                        @endif
                                                        @if (auth()->user()->can('delete roles'))
                                                            <x-buttons.primary class="hover:text-rose-500 "
                                                                wire:click="deleteConfirm({{ $role->id }})">
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
            </div>

        </div>
    </div>



    {{-- create role modal --}}
    @if (auth()->user()->can('create roles'))
        <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('createRole', () => {
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
                                <input type="text" wire:model="name"
                                    class="border border-gray-300 text-gray-600 text-base font-bold focus:ring-4 focus:shadow-md focus:ring-skin-500/20 focus:border-skin-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-skin-500"
                                    placeholder="Role . . . ." />
                                <x-error field="name" class="text-rose-500" />
                                <x-buttons.secondary type="submit" class="mt-8">{{ __('Submit') }}
                                </x-buttons.secondary>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->can('delete roles'))
        <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('deleteRole', () => {
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
                            <form wire:submit.prevent="delete({{ $role_id }})">
                                @csrf
                                @method('DELETE')
                                <p class="text-base font-semibold">Are you sure that you want to delete <b
                                        class="uppercase">{{ $name }}</b> role?</p>
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
