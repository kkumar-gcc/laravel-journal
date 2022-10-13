<div>
    <div class="max-w-7xl ">
        <div class="bg-skin-base overflow-hidden  sm:rounded-lg p-2">
            @if (auth()->user()->can('create users'))
                <div class="flex justify-end p-2 mb-6">
                    <x-buttons.secondary wire:click="$emit('createUser')">{{ __('Create user') }}
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
                                        Avatar</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        Name</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-skin-base divide-y divide-gray-200 text-gray-600">
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center ">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{$user->avatarUrl() }}" alt="avatar of {{ $user->username }}">
                                                <div class="ml-4 font-medium ">
                                                    <div class="font-semibold">
                                                        <a href="/users/{{ $user->username() }}">{{ $user->username() }}
                                                        </a>
                                                    </div>
                                                    <div class="text-sm ">Joined in
                                                        {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            <div class="flex justify-end">
                                                <div class="flex space-x-2 px-2">
                                                    @if (auth()->user()->can('access user roles'))
                                                        <livewire:admin.user.roles :user_id="$user->id"
                                                            wire:key="{{ $user->id }}" />
                                                    @endif
                                                    @if (auth()->user()->can('edit users'))
                                                        <x-buttons.primary wire:click.prefetch="showModal">
                                                            {{ svg('iconsax-bul-edit-2', 'w-5 h-5') }}
                                                        </x-buttons.primary>
                                                    @endif
                                                    @can('delete users')
                                                        <x-buttons.primary class="hover:text-rose-500 "
                                                            wire:click="deleteConfirm()">
                                                            {{ svg('iconsax-lin-trash', 'h-5 w-5') }}
                                                        </x-buttons.primary>
                                                    @endcan
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
            {!! $users->withQueryString()->links('livewire::tailwind') !!}
        </div>
    </div>
</div>
