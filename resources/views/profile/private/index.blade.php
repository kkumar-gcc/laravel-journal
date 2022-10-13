<x-base-layout>
    <main
        class="relative prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl dark:prose-invert prose-a:text-skin-600 dark:prose-a:text-skin-500">
        <section>
            <header class="bg-skin-base border border-gray-200 not-prose dark:border-gray-700 rounded-lg dark:bg-gray-800">
                <div class="relative  pt-[60%] rounded-xl sm:pt-[30%] md:pt-[22%]">
                    <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full m-0 bg-skin-base object-fit rounded-t-xl dark:bg-gray-800"
                        src="{{ $user->backgroundImage() }}" alt="background image of {{ $user->username }}"/>
                </div>
                <div class="flex flex-col px-6 my-4 md:flex-row">
                    <div class="relative flex items-start justify-center w-full mb-4 basis-1/3 md:w-1/3">
                        <img class="z-10 w-40 h-40 -mt-24 rounded-full ring-8 ring-white dark:ring-gray-500"
                            src="{{ $user->avatarUrl() }}"alt="avatar of {{ $user->username }}">
                    </div>
                    <div class="flex flex-col items-center justify-center mb-4 basis-2/3 md:flex-row md:items-start">
                        <div class="flex-1">
                            <div class="font-medium text-center md:text-left ">
                                <div class="text-2xl text-gray-700 dark:text-white">{{ $user->username }}</div>
                                <div class="text-sm ">Joined in
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('F  Y') }}</div>
                            </div>
                        </div>
                        <div class="mt-3 ">
                            <x-buttons.secondary href="/users/{{ $user->username }}">
                                {{ svg('iconsax-bul-edit-2', 'w-6 h-6 mr-2 -ml-1') }}
                                {{ __('Public Profile') }}
                            </x-buttons.secondary>
                        </div>
                    </div>
                </div>
            </header>
        </section>
        <div class="relative flex flex-col w-full mt-3 lg:flex-row ">
            <aside class="basis-1/4 not-prose" aria-label="Sidebar">
                <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                    <ul class="space-y-2 text-base font-semibold text-gray-700">
                        <li>
                            <a href="/settings?tab=general"
                                class="flex items-center p-2 rounded-lg dark:text-white {{ $tab == 'general' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="ml-3">General</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=profile"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'profile' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=password"
                                class="flex items-center p-2 rounded-lg dark:text-white {{ $tab == 'password' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=social_links"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'social_links' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Social Links</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=blogs"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'blogs' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=drafts"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'drafts' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">drafts</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=bookmarks"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'bookmarks' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">bookmarks</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=follower"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'follower' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Follower</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=following"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'following' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Following</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=pins"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'pins' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Pinned</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=comments"
                                class="flex items-center p-2  rounded-lg dark:text-white {{ $tab == 'comments' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Comments</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mt-4 lg:hidden">
                    <div class="mt-4 mb-4 overflow-y-hidden dark:border-gray-700">
                        <ul class="flex -mb-px text-base font-semibold text-center flex-nowrap whitespace-nowrap"
                            role="tablist">
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'general' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=general" role="tab">General</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'profile' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=profile" role="tab">Profile</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'password' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=password" role="tab">Password</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'social_links' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=socila_links" role="tab">Social Links</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'blogs' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=blogs" role="tab">Blogs</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'drafts' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=drafts" role="tab">Drafts</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'bookmarks' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=bookmarks" role="tab">Bookmarks</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'follower' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=follower" role="tab">Follower</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'following' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=following" role="tab">Following</a>
                            </li>
                            <li>
                                <a href="/settings?tab=pins"
                                    class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'pins' ? 'text-skin-600  dark:text-skin-500  border-skin-600' : '' }} hover:bg-gray-100 ">
                                    <span class="flex-1 ml-3 whitespace-nowrap">Pinned</span>
                                </a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'comments' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                    href="/settings?tab=comments" role="tab">Comments</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </aside>

            <div class="flex-1 py-4 my-2 lg:w-3/4 basis-3/4 lg:pl-8 not-prose ">
                <div id="loading"></div>
                @if ($tab == 'profile')
                    <div class="w-full">
                        <livewire:profile.edit-profile />
                    </div>
                @elseif ($tab == 'password')
                    @include('profile.private._password', ['user' => $user])
                @elseif ($tab == 'social_links')
                    <div class="w-full">
                        <livewire:profile.social />
                    </div>
                @elseif($tab == 'blogs')
                    @include('profile.private._blog', ['blogs' => $blogs])
                @elseif ($tab == 'drafts')
                    @include('profile.private._draft', ['drafts' => $drafts])
                @elseif($tab == 'bookmarks')
                    @include('profile.private._bookmark', ['bookmarks' => $bookmarks])
                @elseif($tab == 'follower')
                    @include('profile.private._follower', ['followers' => $followers])
                @elseif($tab == 'following')
                    @include('profile.private._following', ['followings' => $followings])
                @elseif ($tab == 'pins')
                    <div class="w-full">
                        <livewire:profile.pin-blog />
                    </div>
                @elseif($tab == 'comments')
                    @include('profile.private._comment', ['comments' => $comments])
                @endif
            </div>
        </div>
    </main>
</x-base-layout>
