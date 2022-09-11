<x-default-layout>
    <?php
    function nice_number($n)
    {
        $n = 0 + str_replace(',', '', $n);
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) . 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) . 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) . 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) . 'k ';
        }
        return number_format($n);
    }
    ?>
    {{-- <form method="POST" action="{{ Route('blog.create') }}">
        @csrf
        @method('PUT')
        <div class="p-4 flex flex-row items-center">
            <div class="">
                <x-buttons.primary href="{{ url()->previous() ?? '/blogs' }}" class="hover:text-teal-600 mr-4">
                    <svg class="h-6 w-6" viewBox="0 0 456 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <title>cancel</title>
                        <path
                            d="M64 388L196 256 64 124 96 92 228 224 360 92 392 124 260 256 392 388 360 420 228 288 96 420 64 388Z">
                        </path>
                    </svg>
                </x-buttons.primary>
            </div>
            <div class="flex-1 flex justify-end items-center">
                <div>
                    <x-buttons.primary class="mr-2 md:mr-4">
                        <span class="hidden md:block">{{ __('Save as draft') }}</span>

                        <span
                            class="hover:text-teal-600 md:hidden">{{ svg('iconsax-bul-book-saved', 'h-6 w-6') }}</span>
                    </x-buttons.primary>
                </div>
                <div>
                    <x-modals.full modal="isModalOpen">
                        <x-slot:title>
                            <x-buttons.primary x-on:click="isModalOpen = true" class="hover:text-teal-600 mr-2 md:mr-4">
                                {{ svg('iconsax-bul-setting-2', 'h-6 w-6') }}
                            </x-buttons.primary>
                        </x-slot:title>
                        <div class=" my-6">
                            <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                for="name">Add a cover image</label>
                            <input type="text" id="name"
                                class="border border-gray-300 text-gray-600 text-base font-bold focus:shadow-md focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                                name="name" value="{{ old('title', $user->name ?? '') }}"
                                placeholder="Type the canonical link" />
                            <div class="input-error" id="nameError"></div>
                        </div>
                        <div class=" my-6">
                            <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                for="canonical_link">Customize Canonical Link</label>
                            <input type="text" id="canonical_link"
                                class="border border-gray-300 text-gray-600 text-base font-bold focus:shadow-md focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                                name="canonical_link" value="{{ old('canonical_link', $blog->canonical_link ?? '') }}"
                                placeholder="Type the canonical link" />
                        </div>
                        <div class=" my-6">
                            <livewire:tag-input />
                        </div>
                    </x-modals.full>
                </div>
                <div>
                    <x-buttons.secondary type="submit">{{ __('Publish') }}
                    </x-buttons.secondary>
                </div>
            </div>

        </div>
        <div class=" px-2 mt-2 text-gray-700 sm:px-6 sm:mt-6 md:px-20">
            <h1 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700 mb-4">Create Blog</h1>

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class=" my-6">
                <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                    for="title">Title of blog</label>
                <input type="text" id="title"
                    class="border border-gray-300 text-gray-600 text-base font-bold focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                    name="title" value="{{ old('title', $draft->title ?? '') }}" placeholder="Tittle . . . ." />
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <textarea id="blog-description" class="hidden" name="body"></textarea>
            <div id="editor"
                class="relative my-10 prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:w-full mx-auto  dark:prose-invert prose-a:text-teal-600 dark:prose-a:text-teal-500">
                <div class="hidden">
                </div>
            </div>
        </div>
    </form> --}}
    <livewire:blog.create />
</x-default-layout>
