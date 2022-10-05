<div>
@if ($topUsers->count() > 3)
    <div class="relative mt-3 w-full  text-base text-left  rounded-xl font-normal">
        <header class="py-3 px-4 text-2xl font-bold tracking-wide text-gray-700 dark:text-white">
            <h3> Top Users </h3>
        </header>
        <ul class="p-0 list-none">
            @foreach ($topUsers as $topUser)
                <li
                    class="py-3 px-4  dark:hover:text-white hover:bg-gray-50 hover:shadow-sm dark:bg-gray-800 dark:hover:bg-gray-700">
                    <a href="/users/{{ $topUser->username }}" class="flex items-center space-x-4 user-popover"
                        id="user-1" id="user-{{ $topUser->id }}" data-popover-placement="left">
                        {{-- <x-avatar :user="$topUser" class="w-8 h-8 rounded-full" unlinked /> --}}
                        <x-avatar search="{{ $topUser->username }}" :src="$topUser->profile_image = ''"  class="h-12 w-12 bg-gray-50 rounded-full" provider="gravatar"/>

                        <div class="space-y-1 font-medium ">
                            <div>{{ $topUser->username }}</div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
</div>
