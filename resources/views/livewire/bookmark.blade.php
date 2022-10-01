<div class="flex justify-center">
    @guest
        <x-buttons.simple wire:click.prevent="bookmark()" :default=false
            class="hover:bg-teal-50 hover:text-teal-500  focus:ring-teal-100">
            <span title="Bookmark this Article">
                {{ svg('iconsax-out-archive-tick', 'h-6 w-6') }}
            </span>
        </x-buttons.simple>
    @else
        <x-buttons.simple wire:click.prevent="bookmark()" :default=false
            class="hover:bg-teal-50 hover:text-teal-500  focus:ring-teal-100">
            <span title="Bookmark this Article">
                @if ($bookmarked)
                    {{ svg('iconsax-bul-archive-tick', 'w-6 h-6 text-teal-500') }}

                @else
                    {{ svg('iconsax-out-archive-tick', 'h-6 w-6') }}
                @endif
            </span>
        </x-buttons.simple>
        <div class="fixed bottom-3 right-3 p-3 mt-4 z-20 bg-white shadow flex flex-shrink-0 rounded-md"
            x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms x-init="@this.on('changed', () => {
                show = true;
                setTimeout(() => show = false, 10000)
            })" x-cloack
            style="display:none">
            <div tabindex="0" aria-label="group icon" role="img"
                class="focus:outline-none w-8 h-8 flex flex-shrink-0 items-center justify-center">
                {{ svg('iconsax-out-archive-tick', 'h-6 w-6') }}
            </div>
            <div class="pl-3 w-full flex items-center justify-center">
                {{ $message }}
                <div aria-label="close icon" @click="show=false" role="button"
                    class="ml-3 focus:outline-none cursor-pointer">
                    <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg" alt="icon">
                </div>
            </div>
        </div>
    @endguest

</div>
