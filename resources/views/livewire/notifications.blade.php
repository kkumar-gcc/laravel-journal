<div>
    <x-slot name="sidebar">
        <x-sidebar :topTags="false" :topUsers="false">
            <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                <ul class="space-y-2">
                    <li>
                        <a href="/notifications"
                            class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'all' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">All</span>
                        </a>
                    </li>
                    <li>
                        <a href="/notifications?tab=blogs"
                            class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'blogs' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Blogs</span>
                        </a>
                    </li>
                    <li>
                        <a href="/notifications?tab=comments"
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
        </x-sidebar>
    </x-slot>
    <div class="w-full px-2 md:px-12  my-4 relative">
        @if ($unreadNotifications->count() > 0)
            <div class="relative py-3 px-3 sm:px-6 sm:py-6 border-2 border-rose-500 rounded-lg ">
                <div
                    class="absolute top-0 -left-0  text-white capatalize py-2 px-4 leading-6  inline-flex flex-row justify-center items-center no-underline rounded-br-lg font-semibold cursor-pointer transition duration-200 ease-in-out shadow-rose-100 bg-rose-500">
                    Unread
                </div>
                <div class="my-10">
                    @foreach ($unreadNotifications as $unreadNotification)
                        @if ($unreadNotification->data['type'] == 'new_user')
                            <x-cards.primary-card class="p-4 text-sm flex ">
                                <div class="flex-1 ">
                                    <span class="font-medium">User
                                        <a href="/users/{{ $unreadNotification->data['username'] }}"
                                            class="font-semibold underline hover:text-gray-800 dark:hover:text-gray-900">{{ $unreadNotification->data['username'] }}</a>
                                    </span>
                                    has just landed.
                                </div>
                                <button
                                    class="float-right mark-as-read font-semibold underline hover:text-gray-800 dark:hover:text-gray-900 "
                                    data-id="{{ $unreadNotification->id }}"
                                    wire:click="markAsRead('{{ $unreadNotification->id }}')">
                                    Mark as read
                                </button>
                            </x-cards.primary-card>
                        @elseif ($unreadNotification->data['type'] == 'new_blog')
                            <div
                                class='border border-gray-200  relative  mt-8 first:mt-0 w-full px-2 md:p-2.5 text-base text-left p-1  rounded-lg  font-normal shadow-sm hover:shadow-md'>
                                <div class="flex flex-col-reverse items-stretch justify-center p-4 sm:p-6 sm:flex-row ">
                                    <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:pr-4">
                                        <div class="flex flex-row mt-3 mb-1 md:mt-0">
                                            <div class="flex-1 flex flex-row items-center">
                                                <span
                                                    class="inline-flex py-1 px-2 mb-2 mx-[5px] text-[10px] leading-4 first:ml-0 font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600 before:content-['#'] before:mr-0.5 ">
                                                    new
                                                </span>

                                                <button
                                                    class="ml-3 font-semibold underline py-1 px-2 hover:text-gray-800 dark:hover:text-gray-900 "
                                                    data-id="{{ $unreadNotification->id }}"
                                                    wire:click="markAsRead('{{ $unreadNotification->id }}')">
                                                    Mark as read
                                                </button>
                                            </div>
                                            <div>
                                                <livewire:bookmark :blog_id="$unreadNotification->data['id']"
                                                    :wire:key="$unreadNotification->data['id'] " />
                                            </div>
                                        </div>

                                        <a href="/blogs/{{ Str::slug($unreadNotification->data['title'], '-') }}-{{ $unreadNotification->data['id'] }}"
                                            class="link link-secondary">
                                            <h5
                                                class="mb-2 text-2xl font-bold line-clamp-3  tracking-wide text-gray-900  dark:text-white ">
                                                {{ $unreadNotification->data['title'] }}
                                            </h5>
                                        </a>
                                        <p class="mt-3">
                                            <span class="mr-1">by </span>
                                            <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                                href="/users/{{ $unreadNotification->data['auther'] }}">
                                                {{ __($unreadNotification->data['auther']) }}
                                            </a>
                                            <span class="ml-1 text-sm">posted
                                                {{ \Carbon\Carbon::parse($unreadNotification->data['created_at'])->diffForhumans() }}</span>
                                        </p>
                                        <x-buttons.secondary
                                            href="/blogs/{{ Str::slug($unreadNotification->data['title'], '-') }}-{{ $unreadNotification->data['id'] }}"
                                            class="mt-5 sm:hidden" fullWidth="true">Read Blog</x-buttons.secondary>
                                    </div>
                                    <div class="basis-1/3 relative text-center min-h-fit">
                                        <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                            src="https://miro.medium.com/max/1000/1*xRj13VgftcCYP2ppVFmGTw.png"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div
                    class="absolute bottom-0 right-0  text-white capatalize py-2 px-4 leading-6  inline-flex flex-row justify-center items-center no-underline rounded-tl-lg font-semibold cursor-pointer transition duration-200 ease-in-out shadow-rose-100 bg-rose-500">
                    <button wire:click="markAllAsRead()">
                        Mark all as read
                    </button>
                </div>
            </div>
        @endif
        <div class="my-10">
            @foreach ($notifications as $notification)
                @if ($notification->data['type'] == 'new_user')
                    <x-cards.primary-card class="p-4 text-sm flex ">
                        <div class="flex-1 ">
                            <span class="font-medium">User
                                <a href="/users/{{ $notification->data['username'] }}"
                                    class="font-semibold underline hover:text-gray-800 dark:hover:text-gray-900">{{ $notification->data['username'] }}</a>
                            </span>
                            has just landed.
                        </div>
                        <button
                            class="float-right mark-as-read font-semibold underline text-rose-500"
                            data-id="{{ $notification->id }}" wire:click="delete('{{ $notification->id }}')">
                            Delete
                        </button>
                    </x-cards.primary-card>
                @elseif ($notification->data['type'] == 'new_blog')
                    <div
                        class='border border-gray-200  relative  mt-8 first:mt-0 w-full px-2 md:p-2.5 text-base text-left p-1  rounded-lg  font-normal shadow-sm hover:shadow-md'>
                        <div class="flex flex-col-reverse items-stretch justify-center p-4 sm:p-6 sm:flex-row ">
                            <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:pr-4">
                                <div class="flex flex-row mt-3 mb-1 md:mt-0">
                                    <div class="flex-1 flex flex-row items-center">
                                        <button
                                            class="float-right mark-as-read font-semibold underline text-rose-500"
                                            data-id="{{ $notification->id }}"
                                            wire:click="delete('{{ $notification->id }}')">
                                            Delete
                                        </button>
                                    </div>
                                    <div>
                                        <livewire:bookmark :blog_id="$notification->data['id']" :wire:key="$notification->data['id'] " />
                                    </div>
                                </div>

                                <a href="/blogs/{{ Str::slug($notification->data['title'], '-') }}-{{ $notification->data['id'] }}"
                                    class="link link-secondary">
                                    <h5
                                        class="mb-2 text-2xl font-bold line-clamp-3  tracking-wide text-gray-900  dark:text-white ">
                                        {{ $notification->data['title'] }}
                                    </h5>
                                </a>
                                <p class="mt-3">
                                    <span class="mr-1">by </span>
                                    <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                        href="/users/{{ $notification->data['auther'] }}">
                                        {{ __($notification->data['auther']) }}
                                    </a>
                                    <span class="ml-1 text-sm">posted
                                        {{ \Carbon\Carbon::parse($notification->data['created_at'])->diffForhumans() }}</span>
                                </p>
                                <x-buttons.secondary
                                    href="/blogs/{{ Str::slug($notification->data['title'], '-') }}-{{ $notification->data['id'] }}"
                                    class="mt-5 sm:hidden" fullWidth="true">Read Blog</x-buttons.secondary>
                            </div>
                            <div class="basis-1/3 relative text-center min-h-fit">
                                <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                    src="https://miro.medium.com/max/1000/1*xRj13VgftcCYP2ppVFmGTw.png"
                                    alt="">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @if ($unreadNotifications->count() < 1 && $notifications->count() < 1)
                You haven't received any notifications
            @endif
        </div>
    </div>
</div>
