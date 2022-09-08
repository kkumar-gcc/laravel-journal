<div
    class="mt-3 w-full text-base text-left  border  border-gray-200 rounded-lg font-normal  dark:border-gray-700 dark:bg-gray-800 ">
    <header class="py-3 px-4 flex flex-row text-2xl font-semibold text-gray-700 dark:text-white">
        <div class="flex-1">
            <h3> About Me </h3>
        </div>
        @auth
            <button type="button"
                class="text-gray-500 flex flex-row items-center mr-1  dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                data-modal-toggle="loginMessageModal">
                {{ svg('iconsax-bul-edit-2', 'w-6 h-6') }}
            </button>
        @endauth
    </header>
    <div
        class="py-3 px-4 rounded-lg text-base  text-gray-700 dark:text-gray-300   dark:bg-gray-800 ">
        @if ($user->about_me)
            {!! $user->about_me !!}
        @else
            {{ $user->username }} hasn't updated "about me".
        @endif
    </div>
</div>
