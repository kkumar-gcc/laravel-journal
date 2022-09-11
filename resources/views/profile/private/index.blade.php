{{-- @extends('layouts.default') --}}
{{-- @push('styles')
    <x-head.tinymce-config />
@endpush --}}
<x-base-layout>
    <?php
    function nice_number($n)
    {
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) + 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) + 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) + 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) + 'k ';
        }

        return number_format($n);
    }
    ?>
    <main class="relative pteal max-w-none lg:max-w-full xl:max-w-none pteal-img:rounded-xl dark:pteal-invert pteal-a:text-teal-600 dark:pteal-a:text-teal-500">
        <div id="toast-info">

        </div>
        <section>
            <header class="bg-white border border-gray-200 not-pteal dark:border-gray-700 rounded-lg dark:bg-gray-800">
                <div class="relative  pt-[60%] rounded-xl sm:pt-[30%] md:pt-[22%]">
                    <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full m-0 bg-white object-fit rounded-t-xl dark:bg-gray-800"
                        src="{{ asset($user->background_image) ?? 'https://picsum.photos/400/300' }}" alt=""
                        id="background_image" />
                </div>
                <div class="flex flex-col px-6 my-4 md:flex-row">
                    <div class="relative flex items-start justify-center w-full mb-4 basis-1/3 md:w-1/3">
                        <img class="z-10 w-40 h-40 -mt-24 rounded-full ring-8 ring-white dark:ring-gray-500"
                            src="{{ asset($user->profile_image)}}" onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $user->username }}.svg`" alt="Bordered avatar"
                            id="profile_image">
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
            <aside class="basis-1/4 not-pteal" aria-label="Sidebar">
                <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                    <ul class="space-y-2">
                        <li>
                            <a href="/settings?tab=general"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'general' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="ml-3">General</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=profile"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'profile' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=password"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'password' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=social_links"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'social_links' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Social Links</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=blogs"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'blogs' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=drafts"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'drafts' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                               <span class="flex-1 ml-3 whitespace-nowrap">drafts</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=bookmarks"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'bookmarks' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">bookmarks</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=follower"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'follower' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Follower</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=following"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'following' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Following</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=pins"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'pins' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Pinned</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=podcasts"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'podcasts' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                               <span class="flex-1 ml-3 whitespace-nowrap">Podcasts</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings?tab=comments"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'comments' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Comments</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white dark:text-gray-400"
                                    focusable="false" data-prefix="fas" data-icon="gem" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M378.7 32H133.3L256 182.7L378.7 32zM512 192l-107.4-141.3L289.6 192H512zM107.4 50.67L0 192h222.4L107.4 50.67zM244.3 474.9C247.3 478.2 251.6 480 256 480s8.653-1.828 11.67-5.062L510.6 224H1.365L244.3 474.9z">
                                    </path>
                                </svg>
                                <span class="ml-4">Upgrade to Pro</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3">Documentation</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                    </path>
                                </svg>
                                <span class="ml-3">Components</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-3">Help</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mt-4 lg:hidden">
                    <div class="mt-4 mb-4 overflow-y-hidden dark:border-gray-700">
                        <ul class="flex -mb-px text-sm font-medium text-center flex-nowrap whitespace-nowrap" role="tablist">
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'general' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=general" role="tab">General</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'profile' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=profile" role="tab">Profile</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'password' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=password" role="tab">Password</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'social_links' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=socila_links" role="tab">Social Links</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'blogs' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=blogs" role="tab">Blogs</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'drafts' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=drafts" role="tab">Drafts</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'bookmarks' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=bookmarks" role="tab">Bookmarks</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'follower' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=follower" role="tab">Follower</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'following' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=following" role="tab">Following</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'podcasts' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=podcasts" role="tab">Podcasts</a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'comments' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                                href="/settings?tab=comments" role="tab">Comments</a>
                            </li>

                        </ul>
                    </div>
                    {{-- <nav class="tabs mobile-nav-tab">
                        <ul class="mb-3 nav nav-tabs -primary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'profile' ? 'active' : '' }}" href="/settings?tab=profile"
                                    role="tab">Edit Profile</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'password' ? 'active' : '' }}" href="/settings?tab=password"
                                    role="tab">Password
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'social_links' ? 'active' : '' }}" href="/settings?tab=social_links"
                                    role="tab">Social Links</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'blogs' ? 'active' : '' }}" href="/settings?tab=blogs"
                                    role="tab">Blogs
                                    ({{ nice_number($user->blogs->where('status', '=', 'posted')->count()) }})
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'drafts' ? 'active' : '' }}" href="/settings?tab=drafts"
                                    role="tab">Drafts
                                    ({{ nice_number($user->blogs->where('status', '=', 'drafted')->count()) }})
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'bookmarks' ? 'active' : '' }}" href="/settings?tab=bookmarks"
                                    role="tab">Bookmarks
                                    ({{ nice_number($user->bookmarks->count()) }})</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'follower' ? 'active' : '' }}" href="/settings?tab=follower"
                                    role="tab">Follower</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'following' ? 'active' : '' }}" href="/settings?tab=following"
                                    role="tab">Following</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'pins' ? 'active' : '' }}" href="/settings?tab=pins"
                                    role="tab">Pinned</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'podcasts' ? 'active' : '' }}" href="/settings?tab=podcasts"
                                    role="tab">Podcasts</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $tab == 'comments' ? 'active' : '' }}" href="/settings?tab=comments"
                                    role="tab">Comments</a>
                            </li>
                        </ul>
                    </nav> --}}
                </div>
            </aside>

            <div class="flex-1 py-4 my-2 basis-3/4 lg:pl-8 not-pteal">
                <div id="loading"></div>
                @if ($tab == 'profile')
                    @include('profile.private._profile', ['user' => $user])
                @elseif ($tab == 'password')
                    @include('profile.private._password', ['user' => $user])
                @elseif ($tab == 'social_links')
                    @include('profile.private._social', ['user' => $user])
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
                    <div id="pinTab" class="not-pteal">
                        @include('profile.private._pin', ['pins' => $pins, 'blogs' => $blogs])
                    </div>
                @elseif($tab == 'comments')
                    @include('profile.private._comment', ['comments' => $comments])
                @elseif($tab == 'podcasts')
                    @include('profile.private._podcast', ['user' => $user])
                @endif
            </div>
        </div>
    </main>
</x-base-layout>
{{-- @push('scripts')
    @include('ajax')
    <script>
        $(document).ready(function() {
            $(document).on("submit", "#profile_update", function(e) {
                e.preventDefault(e);
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                });
                var formdata = new FormData(this)
                $.ajax({
                    type: "POST",
                    url: '/profile/update',
                    data: formdata,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $("#response_message").html(`
                        <div class="response-message response-success"><p>` + data.success + `</p></div>
                        `);
                    },
                    error: function(response) {
                        $('#usernameError').text(response.responseJSON.errors.username);
                        $('#nameError').text(response.responseJSON.errors.name);
                        $('#locationError').text(response.responseJSON.errors.location);
                        $('#firstNameError').text(response.responseJSON.errors.first_name);
                        $('#lastNameError').text(response.responseJSON.errors.last_name);
                        $('#shortBioError').text(response.responseJSON.errors.short_bio);
                        $('#aboutMeError').text(response.responseJSON.errors.about_me);
                        $('#websiteUrlError').text(response.responseJSON.errors.website_url);
                        if (response.responseJSON.errors.background_image) {
                            $("#background_image-child").addClass("drop-zone-danger");
                            $('#backgroundImageError').text(response.responseJSON.errors
                                .background_image);
                        }
                        if (response.responseJSON.errors.profile_image) {
                            $("#profile_image-child").addClass("drop-zone-danger");
                            $('#profileImageError').text(response.responseJSON.errors
                                .profile_image);

                        }
                    }
                });
            })
            $(document).on("submit", "#password_update", function(e) {
                e.preventDefault(e);
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                });
                $.ajax({
                    type: "POST",
                    url: '/user/password/update',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.success) {
                            $("#response_message").html(`
                        <div class="response-message response-success"><p>` + data.success + `</p></div>
                        `);
                            $("#password_update")[0].reset();
                        }
                        if (data.error) {
                            $('#oldPasswordError').text(data.error);
                        }

                    },
                    error: function(response) {
                        $('#newPasswordError').html('');
                        $('#oldPasswordError').text(response.responseJSON.errors.old_password);
                        $.each(response.responseJSON.errors.new_password, function(key, value) {
                            $('#newPasswordError').append(
                                '<div>' + value + '</div'
                            );
                        });
                        // $('#newPasswordError').text(response.responseJSON.errors.new_password);
                        $('#cNewPasswordError').text(response.responseJSON.errors
                            .confirm_new_password);

                    }
                });

            })



        });
    </script>
@endpush --}}
