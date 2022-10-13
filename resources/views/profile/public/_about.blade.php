<div
    class="mt-3 w-full">
    <header class="py-3 px-4 flex flex-row text-2xl font-semibold text-gray-700 dark:text-white">
        <div class="flex-1 flex items-center">
            <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700">About Me </h3>
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
        class="py-3 px-4 rounded-lg relative prose max-w-none prose-a:no-underline lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:mx-auto  dark:prose-invert prose-a:text-skin-600 dark:prose-a:text-skin-500">
        @if ($user->about_me)
            <x-markdown flavor="github" anchors theme="github-dark">
                {!! $user->aboutMe() !!}
            </x-markdown>
        @else
            {{ $user->username }} hasn't updated "about me".
        @endif
    </div>
</div>
