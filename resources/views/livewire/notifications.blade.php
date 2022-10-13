<div>
    <x-slot name="sidebar">
        <x-sidebar :topTags="false" :topUsers="false">
            <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                <ul class="space-y-2">
                    <li>
                        <a wire:click="sortBy('all')"
                            class="flex items-center p-2 text-base cursor-pointer font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'all' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3" >All</span>
                        </a>
                    </li>
                    <li>
                        <a wire:click="sortBy('new_blog')"
                            class="flex items-center p-2 text-base cursor-pointer font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'new_blog' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Blogs</span>
                        </a>
                    </li>
                    <li>
                        <a wire:click="sortBy('new_user')"
                            class="flex items-center p-2 text-base cursor-pointer font-normal text-gray-900 rounded-lg dark:text-white {{ $tab == 'new_user' ? 'bg-gray-100 dark:bg-gray-700' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Comments</span>
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

                                        <a href="/blogs/{{ $unreadNotification->data['slug'] }}"
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
                                            href="/blogs/{{ $unreadNotification->data['slug'] }}"
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

                                <a href="/blogs/{{ $notification->data['slug'] }}"
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
                                    href="/blogs/{{ $notification->data['slug'] }}"
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
