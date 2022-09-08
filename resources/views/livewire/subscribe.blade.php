<div>
    @guest
        <x-buttons.secondary type="button">
            {{ svg('iconsax-bro-user-add','mr-2 -ml-1 w-6 h-6') }}
            {{ __('Follow') }}
        </x-buttons.secondary>
    @else
        @if (auth()->user()->id == $user_id)
            <x-buttons.secondary href="/settings">
                {{ svg('coolicon-edit', 'mr-2 -ml-1 w-6 h-6') }}
                {{ __('Edit Profile') }}
            </x-buttons.secondary>
        @else
            <x-buttons.secondary type="button" wire:click.prevent="subscribe()" :default="$subscribed ? false:true" class="{{ $subscribed ? 'text-gray-800 shadow-gray-100 bg-gray-100 border-gray-100':'' }}">
                <span wire:loading.remove>
                    @if ($subscribed)
                    {{ svg('iconsax-bul-user-add', 'mr-2 -ml-1 w-6 h-6') }}
                    @else
                    {{ svg('iconsax-bro-user-add','mr-2 -ml-1 w-6 h-6') }}
                    @endif
                </span>
                <div wire:loading>
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 " xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
                @if ($subscribed)
                    {{ __('Following') }}
                @else
                    {{ __('Follow') }}
                @endif
            </x-buttons.secondary>
            <div class="fixed bottom-3 right-3 p-3 mt-4 bg-white shadow flex flex-shrink-0 rounded-md"
                x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms x-init="@this.on('changed', () => {
                    show = true;
                    setTimeout(() => show = false, 10000)
                })"
                x-cloack style="display:none">
                <div tabindex="0" aria-label="group icon" role="img"
                    class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex flex-shrink-0 items-center justify-center">
                    {{ svg('iconsax-bro-user-add','w-5 h-5') }}
                </div>
                <div class="pl-3 w-full flex items-center justify-center">
                    {{ $message }}
                    <div aria-label="close icon" @click="show=false" role="button"
                        class="ml-3 focus:outline-none cursor-pointer">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg" alt="icon">
                    </div>
                </div>
            </div>
        @endif

    @endguest
</div>
