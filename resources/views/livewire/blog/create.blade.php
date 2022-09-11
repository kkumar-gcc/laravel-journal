<form wire:submit.prevent="submit">
    @csrf
    <div class="p-4 flex flex-row items-center">
        <div class="">
            <x-buttons.primary href="/blogs" class="hover:text-teal-600 mr-4">
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
                                class="hover:text-teal-600 md:hidden">{{ svg('iconsax-bul-book-saved', 'h-6 w-6') }}</span>
                        </x-buttons.primary>
                    </x-slot:title>
                    <div
                        class="relative my-10 prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:w-full mx-auto  prose-a:no-underline  dark:prose-invert prose-a:text-teal-600 dark:prose-a:text-teal-500 min-h-fit h-auto">
                        {{-- <div class="not-prose">
                            @foreach ($blog->tags as $tag)
                                <x-tag :tag=$tag id="tag{{ $blog->id }}-{{ $tag->id }}" />
                            @endforeach
                        </div> --}}
                        @if ($photo)
                            <div class="relative  pt-[60%] rounded-xl sm:pt-[50%] md:pt-[42%] ">
                                <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full m-0 bg-white shadow-md object-fit rounded-xl drop-shadow-md dark:bg-gray-800"
                                    src="{{ $photo->temporaryUrl() }}" alt="" />
                            </div>
                        @endif
                        <div class="my-5">
                            <h1 class="text-3xl my-55 md:text-4xl lg:text-5xl dark:text-white">
                                {{ $title }}
                            </h1>
                            <article class="w-full my-5" id="preview-body">
                                {{ Illuminate\Mail\Markdown::parse($body) }}
                            </article>
                        </div>
                    </div>

                </x-modals.full>

            </div>
            <div>
                <x-buttons.primary class="mr-2 md:mr-4">
                    <span class="hidden md:block">{{ __('Save as draft') }}</span>

                    <span class="hover:text-teal-600 md:hidden">{{ svg('iconsax-bul-book-saved', 'h-6 w-6') }}</span>
                </x-buttons.primary>
            </div>
            <div>
                <x-modals.full modal="isModalOpen">
                    <x-slot:header>
                        Blog Settings
                    </x-slot:header>
                    <x-slot:title>
                        <x-buttons.primary x-on:click="isModalOpen = true" class="hover:text-teal-600 mr-2 md:mr-4">
                            {{ svg('iconsax-bul-setting-2', 'h-6 w-6') }}
                        </x-buttons.primary>
                    </x-slot:title>
                    <div class=" my-6">
                        <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                            for="name">Add a cover image</label>
                        @if ($photo)
                            Photo Preview:
                            <div class="relative  pt-[60%] rounded-xl sm:pt-[50%] md:pt-[42%] ">
                                <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full m-0 bg-white shadow-md object-fit rounded-xl drop-shadow-md dark:bg-gray-800"
                                    src="{{ $photo->temporaryUrl() }}" alt="" />
                            </div>
                        @endif
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <!-- File Input -->

                            <input type="file" wire:model="photo">



                            <!-- Progress Bar -->

                            <div x-show="isUploading">

                                <progress max="100" x-bind:value="progress"></progress>

                            </div>

                        </div>
                        @error('photo')
                            <span class="error">{{ $message }}</span>
                        @enderror
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

        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <div class=" my-6">
            <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700" for="title">Title
                of blog</label>
            <input type="text" id="title" wire:model="title"
                class="border border-gray-300 text-gray-600 text-base font-bold focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                name="title" placeholder="Tittle . . . ." />
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <textarea id="blog-description" class="hidden" name="body"></textarea>
        @error('body')
            <span class="error">{{ $message }}</span>
        @enderror
        <div wire:ignore>
            <div wire:model="body" id="editor"
                class="sticky top-0 z-20 my-10 prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:w-full mx-auto  dark:prose-invert prose-a:text-teal-600 dark:prose-a:text-teal-500">
                <div class="hidden">
                    {{ $body }}
                </div>
            </div>
        </div>
    </div>
</form>
@push('scripts')
    <script type="text/javascript" defer>
        window.onload = function() {
            milkdown.Editor
                .make()
                .config((ctx) => {
                    ctx.get(milkdown.listenerCtx)
                        .beforeMount((ctx) => {
                            console.log("mout")
                            // before the editor mounts
                        })
                        .mounted((ctx) => {
                            // after the editor mounts
                            console.log("mouted")
                        })
                        .updated((ctx, doc, prevDoc) => {
                            // when editor state updates
                        })
                        .markdownUpdated((ctx, markdown, prevMarkdown) => {
                            @this.set('body', markdown);
                        })
                        .blur((ctx) => {
                            // when editor loses focus
                        })
                        .focus((ctx) => {
                            // when focus editor
                        })
                        .destroy((ctx) => {
                            // when editor is being destroyed
                        });
                    ctx.set(milkdown.rootCtx, document.querySelector('#editor'));
                })
                .use(milkdown.nord)
                .use(milkdown.commonmark)
                .use(milkdown.listener)
                .use(milkdown.history)
                .use(milkdown.prism)
                .use(milkdown.block)
                .use(milkdown.emoji)
                .use(milkdown.table)
                .use(milkdown.cursor)
                .use(milkdown.math)
                .use(milkdown.clipboard)
                .use(milkdown.menu)
                .use(
                    milkdown.trailing.configure(milkdown.trailingPlugin, {
                        shouldAppend: (lastNode, state) => lastNode && !['paragraph'].includes(lastNode.type.name),
                    })
                )
                .use(
                    milkdown.tooltip.configure(milkdown.tooltipPlugin, {
                        top: true,
                    }))
                .use(
                    milkdown.slash.configure(milkdown.slashPlugin, {
                        config: (ctx) => {
                            // Get default slash plugin items
                            const actions = milkdown.defaultActions(ctx);

                            // Define a status builder
                            return ({
                                isTopLevel,
                                content,
                                parentNode
                            }) => {
                                // You can only show something at root level
                                if (!isTopLevel) return null;

                                // Empty content ? Set your custom empty placeholder !
                                if (!content) {
                                    return {
                                        placeholder: 'Type / to use the slash commands...'
                                    };
                                }

                                // Define the placeholder & actions (dropdown items) you want to display depending on content
                                if (content.startsWith('/')) {
                                    // Add some actions depending on your content's parent node
                                    if (parentNode.type.name === 'customNode') {
                                        actions.push({
                                            id: 'custom',
                                            dom: createDropdownItem(ctx.get(themeToolCtx), 'Custom',
                                                'h1'),
                                            command: () => ctx.get(commandsCtx)
                                                .call( /* Add custom command here */ ),
                                            keyword: ['custom'],
                                            enable: () => true,
                                        });
                                    }

                                    return content === '/' ? {
                                        placeholder: 'Type to filter...',
                                        actions,
                                    } : {
                                        actions: actions.filter(({
                                                keyword
                                            }) =>
                                            keyword.some((key) => key.includes(content.slice(1)
                                                .toLocaleLowerCase())),
                                        ),
                                    };
                                }
                            };
                        },
                    }),
                )
                .use(
                    milkdown.indent.configure(milkdown.indentPlugin, {
                        type: 'space', // available values: 'tab', 'space',
                        size: 4,
                    }),
                )
                .use(milkdown.diagram)
                .config((ctx) => {
                    ctx.set(milkdown.defaultValueCtx, milkdown.defaultValue);
                }).create();
        }
    </script>
@endpush
