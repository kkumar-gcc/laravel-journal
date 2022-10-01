<div class="not-prose ">
    <x-cards.primary-card :default=false class="p-0">
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Social Links</h3>
        </header>
        <div class="border-t py-4 px-5 last:rounded-b-xl border-gray-200">
            <div>
                <div class="fixed top-3 right-3 p-3 mt-4 z-20 bg-white shadow flex flex-shrink-0 rounded-md"
                    x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms
                    x-init="@this.on('changed', () => {
                        show = true;
                        setTimeout(() => show = false, 10000)
                    })" x-cloack style="display:none">
                    <div tabindex="0" aria-label="group icon" role="img"
                        class="focus:outline-none w-8 h-8 flex flex-shrink-0 items-center justify-center">
                        {{ svg('iconsax-bul-tick-circle', 'h-6 w-6 text-teal-500') }}

                    </div>
                    <div class="pl-3 w-full flex items-center justify-center">
                        @if (session()->has('message'))
                            {{ session('message') }}
                        @endif
                        <div aria-label="close icon" @click="show=false" role="button"
                            class="ml-3 focus:outline-none cursor-pointer">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg"
                                alt="icon">
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="update" id="profile_update" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="MAX_FILE_SIZE" value="30000000" /> --}}
                {{-- <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="first_name">Profile Picture</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col w-full h-32 border-4 border-teal-400 border-dashed hover:bg-gray-100 hover:border-gray-300">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Attach a file</p>
                            </div>
                            <input type="file" class="opacity-0" />
                        </label>
                    </div>
                    <div class="input-error" id="profileImageError"></div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="last_name">Background Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col w-full h-32 border-4 border-teal-400 border-dashed hover:bg-gray-100 hover:border-gray-300">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Attach a file</p>
                            </div>
                            <input type="file" class="opacity-0" />
                        </label>
                    </div>
                    <div class="input-error" id="backgroundImageError"></div>
                </div> --}}

                <div class="mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="username">Username</label>
                    <x-form.input-field type="text" id="username" wire:model="username" />
                    @error('username')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4"> <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="name">Name</label>
                    <x-form.input-field type="text" id="name" wire:model="name" />
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="location">location</label>
                    <x-form.input-field type="text" id="location" wire:model="location" />
                    @error('location')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="first_name">First Name</label>
                        <x-form.input-field type="text" id="first_name" wire:model="firstName" />
                        @error('firstName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="last_name">Last Name</label>
                        <x-form.input-field type="text" id="last_name" wire:model="lastName" />
                        @error('lastName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class=" mb-5">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white" for="short_bio">Short
                        Bio</label>
                    <textarea id="short_bio"
                        class="border border-gray-300 text-gray-600 text-sm focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                        maxlength="200" rows="4" wire:model="shortBio">{{ old('short_bio', $user->short_bio ?? '') }}</textarea>
                    @error('shortBio')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white" for="editor2">About
                        Me</label>
                    <div>
                        <div wire:model="aboutMe" id="editor3" wire:ignore
                            class="sticky top-0 z-20 my-10 prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:w-full mx-auto  dark:prose-invert prose-a:text-teal-600 dark:prose-a:text-teal-500">
                            <div class="hidden">
                                <x-markdown flavor="github" :anchors="true" theme="github-dark">
                                    {!! $aboutMe !!}
                                </x-markdown>
                            </div>
                        </div>
                    </div>
                    @error('aboutMe')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="website_url">Website Url</label>
                    <x-form.input-field type="url" id="website_url" placeholder="https://website.com"
                        wire:model="websiteUrl" />
                    @error('websiteUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <x-buttons.secondary type="submit" fullWidth={true}>save profile info</x-buttons.secondary>
            </form>
        </div>
    </x-cards.primary-card>
</div>
@push('scripts')
    <script defer>
        function myvar() {
            const defaultValue = {
                type: 'html',
                dom: document.querySelector('#editor3'),
            };
            milkdown.Editor
                .make()
                .config((ctx) => {
                    ctx.get(milkdown.listenerCtx)
                        .markdownUpdated((ctx, markdown, prevMarkdown) => {
                            @this.set('aboutMe', markdown);
                        })
                    ctx.set(milkdown.rootCtx, document.querySelector('#editor3'));
                    ctx.set(milkdown.defaultValueCtx, defaultValue);
                })
                .use(milkdown.nord)
                .use(milkdown.commonmark)
                .use(milkdown.listener)
                .use(milkdown.history)
                .use(milkdown.emoji)
                .use(milkdown.table)
                .use(milkdown.cursor)
                .use(milkdown.math)
                .use(milkdown.clipboard)
                .use(milkdown.menu)
                .use(
                    milkdown.trailing.configure(milkdown.trailingPlugin, {
                        shouldAppend: (lastNode, state) => lastNode && !['paragraph'].includes(
                            lastNode
                            .type.name),
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
                                            dom: createDropdownItem(ctx.get(
                                                    themeToolCtx), 'Custom',
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
                                            keyword.some((key) => key.includes(
                                                content
                                                .slice(1)
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
                .create()
        }
        window.onload = myvar;
        // document.addEventListener("turbolinks:load", myvar());
    </script>
@endpush
