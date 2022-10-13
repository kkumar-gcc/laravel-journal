<form wire:submit.prevent="submit">
    @csrf
    <div class="p-4 flex flex-row items-center">
        <div class="">
            <x-buttons.primary href="/blogs" class="hover:text-skin-600 mr-4">
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
                <x-modals.full modal="previewModal">
                    <x-slot:header>
                        preview
                    </x-slot:header>
                    <x-slot:title>
                        <x-buttons.primary x-on:click="previewModal = true" class="mr-2 md:mr-4">
                            <span class="hidden md:block">{{ __('preview') }}</span>
                            <span
                                class="hover:text-skin-600 md:hidden">{{ svg('iconsax-bul-book-saved', 'h-6 w-6') }}</span>
                        </x-buttons.primary>
                    </x-slot:title>
                    <div
                        class="relative my-10 prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:w-full mx-auto  prose-a:no-underline  dark:prose-invert prose-a:text-skin-600 dark:prose-a:text-skin-500 min-h-fit h-auto">
                        {{-- <div class="not-prose">
                            @foreach ($blog->tags as $tag)
                                <x-tag :tag=$tag id="tag{{ $blog->id }}-{{ $tag->id }}" />
                            @endforeach
                        </div> --}}
                        @if ($coverImage)
                            <div class="relative  pt-[60%] rounded-xl sm:pt-[50%] md:pt-[42%] ">
                                <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full m-0 bg-skin-base shadow-md object-fit rounded-xl drop-shadow-md dark:bg-gray-800"
                                    src="{{ $coverImage->temporaryUrl() }}" alt="" />
                            </div>
                        @endif
                        <div class="my-5">
                            <h1 class="text-3xl my-55 md:text-4xl lg:text-5xl dark:text-white">
                                {{ $title }}
                            </h1>
                            <article class="w-full my-5" id="preview-body">
                                <x-markdown flavor="github">
                                    {!! $body !!}
                                </x-markdown>
                            </article>
                        </div>
                    </div>

                </x-modals.full>

            </div>
            <div>
                <x-buttons.primary class="mr-2 md:mr-4" wire:click="draft">
                    <span class="hidden md:block">{{ __('Save as draft') }}</span>
                    <span class="hover:text-skin-600 md:hidden">{{ svg('iconsax-bul-book-saved', 'h-6 w-6') }}</span>
                </x-buttons.primary>
            </div>
            <div>
                <x-modals.full modal="isModalOpen">
                    <x-slot:header>
                        Blog Settings
                    </x-slot:header>
                    <x-slot:title>
                        <x-buttons.primary x-on:click="isModalOpen = true" class="hover:text-skin-600 mr-2 md:mr-4">
                            {{ svg('iconsax-bul-setting-2', 'h-6 w-6') }}
                        </x-buttons.primary>
                    </x-slot:title>
                    <div class="mb-4">
                        <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700">Add a
                            cover image</label>
                        <div class="flex flex-row mb-8 items-center">
                            <div class="">
                                @if ($coverImage)
                                    <img src="{{ $coverImage->temporaryUrl() }}"
                                        class="max-h-56 max-w-[224px] bg-gray-50 mr-8"
                                        alt="" />
                                @endif
                            </div>
                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress" class="flex-1">
                                <!-- File Input -->
                                <input type="file" wire:model="coverImage" id="cover_image" class="sr-only" />
                                <label
                                    class="bg-skin-base  capatalize py-2 px-4 leading-6  border inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-sm shadow-gray-100"
                                    for="cover_image">
                                    change
                                </label>
                                <div x-show="isUploading" class="mb-2">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                <x-error class="text-red-500" field="coverImage" />
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                            for="canonical_link">Customize Canonical Link</label>
                        <x-form.input-field type="text" id="canonical_link" wire:model="title"
                            placeholder="Type the canonical link" />
                        <x-error field="canonical_link" class="text-rose-500" />
                    </div>
                    <div class=" my-6">
                        <div x-data="{ tags: @entangle('tags'), newTag: '' }">
                            <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                                for="name">Tags</label>
                            <template x-for="tag in tags">
                                <input type="hidden" :value="tag" name="tags">
                            </template>
                            <div class="tags-input">
                                <template x-for="tag in tags" class="my-4" :key="tag" wire:ignore>
                                    <span
                                        class="inline-flex py-1 px-2 mb-2 mx-[5px] text-[10px] leading-4 first:ml-0 font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600 before:content-['#'] before:mr-0.5 ">
                                        <span x-text="tag"></span>
                                        <button type="button" class="ml-2 border-l "
                                            @click="tags = tags.filter(i => i !== tag)">
                                            &times;
                                        </button>
                                    </span>
                                </template>
                                <x-form.input-field type="text" wire:model="search"
                                    @keydown.enter.prevent="if (newTag.trim() !== '' && !tags.includes(newTag)) { tags.push(newTag.trim()); newTag = ''} newTag = ''"
                                    @keydown.space.prevent="if (newTag.trim() !== '') tags.push(newTag.trim()); newTag = ''"
                                    @keydown.backspace="if (newTag.trim() === '') tags.pop()" x-model="newTag"
                                    x-bind:placeholder="(tags.length < 5) ? 'Add tags . . .' : 'you can only choose 5 tags.'"
                                    x-bind:disabled="(tags.length < 5) ? false: true" />
                                <p class="mt-2 mb-4 text-sm text-gray-700 font-semibold">press <kbd
                                        class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-md">Enter</kbd>
                                    or <kbd
                                        class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-md">Space</kbd>
                                    , to add new tag, or select an existing tag by clicking on it.</p>
                                <x-error field="tags" class="text-rose-500" />
                                <div :class="(tags.length < 5) ? '' : 'hidden'">
                                    @if (count($searchTags) > 0)
                                        <div class="z-50 mt-2 w-full origin-top-left left-0 shadow-md ">
                                            @foreach ($searchTags as $tag)
                                                <button
                                                    class="last:rounded-b-lg w-full ring-1 px-4 py-3.5 ring-black ring-opacity-5  bg-skin-base hover:cursor-pointer"
                                                    @click.prevent="if (tags.length<5 && !tags.includes('{{ $tag->title }}')) tags.push('{{ $tag->title }}') newTag = ''">

                                                    <span
                                                        class="inline-flex py-1 px-2 mb-2 mx-[5px] text-[10px] leading-4 first:ml-0 font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600 before:content-['#'] before:mr-0.5 ">
                                                        {{ $tag->title() }}
                                                    </span>
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </x-modals.full>
            </div>
            <div>
                <x-buttons.secondary type="submit">{{ __('Publish') }}
                </x-buttons.secondary>
            </div>
        </div>

    </div>
    <div class=" mt-2 text-gray-700 px-6 sm:mt-6 md:px-20">
        <h1 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700 mb-4">Create Blog</h1>
        <div class="my-4">
            <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                for="title">Title
                of blog</label>
            <x-form.input-field type="text" id="title" wire:model="title" placeholder="Tittle . . . ." />
            <x-error field="title" class="text-rose-500" />
        </div>
        <x-error field="body" class="text-rose-500" />
        <div>
            <x-milkdown>
                <div class="hidden">
                    <x-markdown flavor="github" anchors theme="github-dark">
                        {!! $body !!}
                    </x-markdown>
                </div>
            </x-milkdown>
        </div>
    </div>
</form>
