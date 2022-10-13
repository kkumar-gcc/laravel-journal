<div>
    <x-buttons.primary wire:click.prefetch="showModal">
        {{ svg('iconsax-lin-eye', 'h-5 w-5') }}
    </x-buttons.primary>
    <div x-data="{ modal: @entangle('assignPermission') }" class="flex justify-center">
        <div x-show="modal" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
            aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="modal=false" style="display: none;">
            <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-20" style="display: none;"></div>
            <div x-show="modal" x-transition="" x-on:click="modal = false"
                class="relative flex min-h-screen items-center justify-center p-4" style="display: none;">
                <div x-on:click.stop="" x-trap.noscroll.inert="modal"
                    class="relative w-full  overflow-y-auto rounded-xl bg-skin-base p-12  shadow-2xl">
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
                        <div class="flex flex-col md:flex-row">
                            <div class="md:mr-12 flex-1">
                                @if ($role->permissions->count() > 0)
                                    <h5 class="mb-4 font-semibold text-xl">Permissions of Role </h5>
                                    @foreach ($role->permissions as $role_permission)
                                        <div class="mb-3 p-4 flex flex-row border rounded-lg shadow-sm hover:shadow-md">
                                            <div class="flex-1">
                                                {{ $role_permission->name }}
                                            </div>
                                            <button type="button" class="mx-3 pl-2 "
                                                wire:click="removePermission('{{ $role_permission->id }}','{{ $role->id }}')">
                                                {{ svg('iconsax-two-minus','h-5 w-5') }}
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="flex-1">
                                @if (count($permissions) > 0)
                                    <div>
                                        <h5 class="mb-4 font-semibold text-xl">Assign Permissions</h5>
                                        @foreach ($permissions as $permission)
                                            @if (!$role->hasPermissionTo($permission))
                                                <div
                                                    class="mb-3 p-4 flex flex-row border rounded-lg shadow-sm hover:shadow-md">
                                                    <div class="flex-1">
                                                        {{ $permission->name }}
                                                    </div>
                                                    <button type="button" class="mx-3 pl-2 "
                                                        wire:click="assignPermission('{{ $permission->id }}','{{ $role->id }}')">
                                                        {{ svg('iconsax-lin-add', 'h-5 w-5') }}
                                                    </button>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <x-buttons.primary class="mt-8">{{ __('Close') }}
                        </x-buttons.primary>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
