<div class="">
    <div wire:loading class="fixed bg-white bottom-3 left-3 mb-2 flex justify-center">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </div>
    @if ($pins->count() > 0)
        <article class="mt-4">
            <div class="relative py-3 px-3 sm:px-6 sm:py-6 border-2 border-teal-500 rounded-lg ">
                <div
                    class="absolute top-0 -left-0  text-white capatalize py-2 px-4 leading-6  inline-flex flex-row justify-center items-center no-underline rounded-br-lg font-semibold cursor-pointer transition duration-200 ease-in-out shadow-teal-100 bg-teal-500">
                    Pinned
                </div>
                <div class="my-10">
                    @foreach ($pins as $pin)
                        <x-cards.blog-card :blog="$pin->blog" :pin="true">
                            <x-buttons.simple wire:click.prevent="pin({{ $pin->blog_id }})" :default=false
                                class="hover:bg-rose-50 hover:text-rose-500  focus:ring-rose-100"
                                :wire:key="$pin->blog_id">
                                <span title="Bookmark this Article">
                                    {{ svg('iconsax-two-tag-cross', 'h-6 w-6') }}
                                </span>
                            </x-buttons.simple>
                        </x-cards.blog-card>
                    @endforeach
                </div>
                <div
                    class="absolute bottom-0 right-0  text-white capatalize py-2 px-4 leading-6  inline-flex flex-row justify-center items-center no-underline rounded-tl-lg font-semibold cursor-pointer transition duration-200 ease-in-out shadow-teal-100 bg-teal-500">
                    Pinned
                </div>
            </div>
        </article>
    @else
        <div
            class="py-4 px-5 rounded-xl text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
            You haven't pinned any blog.
        </div>
    @endif

    @if ($pins->count() < 5)
        @if ($blogs->count() > 0)
            <h4 class="card-title mt-5 mb-3">Pin Blog (remaining <?php echo 5 - $pins->count(); ?>)</h4>
            <div>
                @foreach ($blogs as $blog)
                    <x-cards.blog-card :blog="$blog" :pin="true">
                        <x-buttons.simple wire:click.prevent="pin({{ $blog->id }})" :default=false
                            class="hover:bg-teal-50 hover:text-teal-500  focus:ring-teal-100" :wire:key="$blog->id">
                            <span title="Bookmark this Article">
                                {{ svg('iconsax-out-tag-2', 'h-6 w-6') }}

                            </span>
                        </x-buttons.simple>
                    </x-cards.blog-card>
                @endforeach
                {!! $blogs->withQueryString()->links('livewire::tailwind') !!}
            </div>
        @endif
    @endif
    <div class="fixed bottom-3 z-20 right-3 p-3 mt-4 bg-white shadow flex flex-shrink-0 rounded-md"
        x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms x-init="@this.on('changed', () => {
            show = true;
            setTimeout(() => show = false, 5000)
        })"
        x-cloack style="display:none">
        <div class=" flex-1 flex flex-shrink-0 items-center justify-center">
            @if ($pinned)
                {{ svg('iconsax-out-tag-2', 'h-6 w-6') }}
            @else
                {{ svg('iconsax-two-tag-cross', 'h-6 w-6') }}
            @endif
        </div>
        <div class="pl-3 w-full flex items-center justify-center">
            {{ $message }}
            <div aria-label="close icon" @click="show=false" role="button"
                class="ml-3 focus:outline-none cursor-pointer">
                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg" alt="icon">
            </div>
        </div>
    </div>
</div>
