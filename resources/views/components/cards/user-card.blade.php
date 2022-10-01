@props(['user', 'private' => false, 'pin' => false])
<div
{{ $attributes->merge(['class' => 'border border-gray-200  relative  mt-8 first:mt-0 mt-3 w-full px-2 md:p-2.5 text-base text-left p-1  rounded-lg  font-normal shadow-sm']) }}>
    <div class="py-3 px-4 rounded-xl not-prose dark:bg-gray-800 ">
        <header class="flex flex-col md:flex-row">
            <div class="flex-1 flex items-center ">
                <img class="w-10 h-10 rounded-full" src="{{ asset($user->profile_image) }}"
                    onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $user->username() }}.svg`"
                    alt="">
                <div class="ml-2 font-medium ">
                    <div class="dark:text-white">
                        <a href="/users/{{ $user->username() }}">{{ $user->username() }} </a>
                    </div>
                    <div class="text-sm ">Joined in
                        {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="mb-3 md:hidden">
                    {{ $user->shortBio() }}
                </div>
                <livewire:subscribe :user_id="$user->id" wire:key="user-{{ $user->username() }}" />
            </div>
        </header>
        <div class="mt-3 hidden md:block">
            {{ $user->shortBio() }}
        </div>

    </div>
</div>
