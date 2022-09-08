<div class="col-span-2 grid grid-cols-2 gap-0">
    @guest
        <div class="flex justify-center items-center">
            <x-buttons.simple :default=false class=" hover:bg-rose-50 hover:text-rose-500  focus:ring-rose-100 ">
                <span title="Like this blog" class="flex flex-row items-center mr-1">
                    {{ svg('iconsax-lin-like-1', 'h-6 w-6') }}
                    <span class="ml-3">
                        {{ $likes_count }}</span>
                </span>
            </x-buttons.simple>
        </div>
        <div class="flex justify-center items-center">
            <x-buttons.simple :default=false class=" hover:bg-rose-50 hover:text-rose-500  focus:ring-rose-100 ">
                <span title="DisLike this blog" class="flex flex-row items-center mr-1">
                    {{ svg('iconsax-lin-dislike', 'h-6 w-6') }}
                </span>
            </x-buttons.simple>
        </div>
    @else
        <div class="flex justify-center items-center">
            <x-buttons.simple wire:click.prevent="like()" :default=false
                class=" hover:bg-rose-50 hover:text-rose-500  focus:ring-rose-100 ">
                <span title="Like this blog" class=" flex flex-row items-center mr-1">
                    @if ($isLiked)
                        {{ svg('iconsax-bul-like-1', 'h-6 w-6 text-rose-500') }}
                    @else
                        {{ svg('iconsax-lin-like-1', 'h-6 w-6') }}
                    @endif
                    <span class="{{ $isLiked ? 'text-rose-500 ' : ' ' }} ml-3">
                        {{ $likes_count }}</span>
                </span>
            </x-buttons.simple>
        </div>
        <div class="flex justify-center items-center">
            <x-buttons.simple wire:click.prevent="dislike()">
                <span title="dislike this blog" class="flex flex-row items-center">
                    @if ($isDisliked)
                        {{ svg('iconsax-bul-dislike', 'h-6 w-6 text-gray-500') }}
                    @else
                        {{ svg('iconsax-lin-dislike', 'h-6 w-6') }}
                    @endif
                </span>
            </x-buttons.simple>
        </div>
        <div wire:offline>

            You are now offline.

        </div>

    @endguest
</div>
