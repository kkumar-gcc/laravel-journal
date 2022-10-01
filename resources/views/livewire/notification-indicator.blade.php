<div>
    <a href="/notifications" class="inline-flex relative items-center p-1 text-sm font-medium text-center ">
        {{ svg('iconsax-lin-notification-bing', 'w-6 h-6') }}
        <span class="sr-only">Notifications</span>
        @if (auth()->user()->unreadNotifications->count() > 0 &&
            auth()->user()->unreadNotifications->count() <= 9)
            <div
                class="inline-flex absolute -top-2 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-rose-500 rounded-full border-2 border-white ">
                {{ auth()->user()->unreadNotifications->count() }}
            </div>
        @elseif(auth()->user()->unreadNotifications->count() > 9)
            <div
                class="inline-flex absolute -top-2 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-rose-500 rounded-full border-2 border-white ">
                9+
            </div>
        @endif
    </a>
</div>
