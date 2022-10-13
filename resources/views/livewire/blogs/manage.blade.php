<div class="relative w-full mt-3">
    <div class="fixed top-3 right-3 p-3 mt-4 z-20 bg-skin-base shadow flex flex-shrink-0 rounded-md"
        x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms x-init="@this.on('changed', () => {
            show = true;
            setTimeout(() => show = false, 10000)
        })" x-cloack
        style="display:none">
        <div tabindex="0" aria-label="group icon" role="img"
            class="focus:outline-none w-8 h-8 flex flex-shrink-0 items-center justify-center">
            {{ svg('iconsax-bul-tick-circle', 'h-6 w-6 text-skin-500') }}

        </div>
        <div class="pl-3 w-full flex items-center justify-center">
            @if (session()->has('message'))
                {{ session('message') }}
            @endif
            <div aria-label="close icon" @click="show=false" role="button"
                class="ml-3 focus:outline-none cursor-pointer">
                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg" alt="icon">
            </div>
        </div>
    </div>
    <div class="tabs mb-4  mt-4 dark:border-gray-700 overflow-y-hidden">
        <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-base font-semibold text-center -primary "
            role="tablist">
            <li class="mr-2" role="presentation">
                <a
                    class="inline-block p-4 rounded-t-lg  cursor-pointer border-b-4  {{ $tab == 'manage' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}">Settings</a>
            </li>
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg cursor-pointer border-b-4 {{ $tab == 'edit' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    href="/blogs/edit/{{ $blog->slug }}" role="tab">Edit</a>
            </li>
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg  cursor-pointer border-b-4  {{ $tab == 'stats' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    href="/blogs/stats/{{ $blog->slug }}" role="tab">Stats</a>
            </li>
        </ul>
    </div>
    <section id="general">
        <div class="relative my-5 w-full">
            <h3 class="py-3 px-4 text-3xl font-bold tracking-wide text-gray-600">Settings</h3>
            <div class="px-5 py-4">
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="mb-6">
                        <label for="general_comment"
                            class="text-xl font-semibold line-clamp-3  tracking-wide  block mb-4  text-gray-700">Comments</label>
                        <div class="flex items-center flex-col justify-start">
                            <label class="w-full flex items-center mb-2 cursor-pointer">
                                <input type="radio" class="form-radio " wire:model="comment_access" value="enable">
                                <span class="ml-2">Allow all comments</span>
                            </label>
                            <label class="w-full flex items-center mb-2 cursor-pointer">
                                <input type="radio" class="form-radio" wire:model="comment_access" value="disable">
                                <span class="ml-2">Disable comments</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="general_comment"
                            class="text-xl font-semibold line-clamp-3  tracking-wide  block mb-4  text-gray-700">Reader
                            access</label>
                        <div class="flex items-center flex-col justify-start">
                            <label class="w-full flex items-center mb-2 cursor-pointer">
                                <input type="radio" class="form-radio" wire:model="blog_access" value="private">
                                <span class="ml-2">Private</span>
                            </label>
                            <label class="w-full flex items-center mb-2 cursor-pointer">
                                <input type="radio" class="form-radio" wire:model="blog_access" value="subscriber">
                                <span class="ml-2">Followers</span>
                            </label>
                            <label class="w-full flex items-center mb-2 cursor-pointer">
                                <input type="radio" class="form-radio" wire:model="blog_access" value="public">
                                <span class="ml-2">Public</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="general_comment"
                            class="text-xl font-semibold line-clamp-3  tracking-wide  block mb-4  text-gray-700">Adult
                            content</label>
                        <div class="">
                            <div class="w-full mt-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4" wire:model="adult_warning" />
                                    <span class="ml-2">Show warning to blog readers</span>
                                </label>
                            </div>
                            <div class="w-full mt-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="w-4 h-4" wire:model="age_confirmation" />
                                    <span class="ml-2">Show warning to blog readers</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <x-buttons.secondary type="submit">Save</x-buttons.secondary>
                </form>
            </div>
        </div>
    </section>
    @can('delete', $blog)
        <section id="delete" class="mt-8">
            <x-cards.primary-card :default=false class="border-rose-500">
                <header class="px-5 py-4 text-2xl font-semibold text-rose-500 dark:text-white">
                    <h3>Delete Blog</h3>
                </header>
                <div
                    class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl dark:hover:text-white dark:border-gray-700 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                    <p>Once you delete your blog, there is no going back. Please be certain.</p>
                    <x-buttons.secondary wire:click="$emit('deleteBlog')" :default="false"
                        class="mt-3 bg-rose-500 border-rose-500 text-white">Delete
                        Blog
                    </x-buttons.secondary>
                </div>
            </x-cards.primary-card>
        </section>
        <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('deleteBlog', () => {
            modal = true;
        });
        @this.on('closeModal', () => {
            modal = false;
        })">
            <div x-show="modal" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
                aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="modal=false" style="display: none;">
                <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-20" style="display: none;"></div>
                <div x-show="modal" x-transition="" x-on:click="modal = false"
                    class="relative flex min-h-screen items-center justify-center p-4" style="display: none;">
                    <div x-on:click.stop="" x-trap.noscroll.inert="modal"
                        class="relative w-full max-w-2xl overflow-y-auto rounded-xl bg-skin-base p-12  shadow-2xl">
                        <header class="flex items-center ">
                            <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700"></h5>
                            <div class="flex-1 flex justify-end">
                                <x-buttons.primary @click="modal=false" class="hover:text-skin-600">
                                    <svg class="h-6 w-6" viewBox="0 0 456 512" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor">
                                        <title>cancel</title>
                                        <path
                                            d="M64 388L196 256 64 124 96 92 228 224 360 92 392 124 260 256 392 388 360 420 228 288 96 420 64 388Z">
                                        </path>
                                    </svg>
                                </x-buttons.primary>
                            </div>
                        </header>
                        <div class="mt-8">
                            <form wire:submit.prevent="delete()">
                                @csrf
                                @method('DELETE')
                                <p class="text-base font-semibold">Are you sure that you want to delete <b
                                        class="uppercase">{{ $blog->title }}</b> blog?</p>
                                <x-buttons.danger type="submit" class="mt-6">{{ __('delete') }}
                                </x-buttons.danger>
                                <x-buttons.primary class="mt-6 ml-2">{{ __('cancel') }}
                                </x-buttons.primary>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</div>
