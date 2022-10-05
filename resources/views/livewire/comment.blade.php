<section class="max-w-full py-8" wire:poll.500s>
    <div wire:offline class="bg-red-300 p-4">
        your are offline now
    </div>
    <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('reply', () => {
        modal = true;
    });
    @this.on('editorClose', () => {
        modal = false;
    })">
        <div x-show="modal" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
            aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="modal=false" style="display: none;">
            <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-20" style="display: none;"></div>
            <div x-show="modal" x-transition="" x-on:click="modal = false"
                class="relative flex min-h-screen items-center justify-center p-4" style="display: none;">
                <div x-on:click.stop="" x-trap.noscroll.inert="modal"
                    class="relative w-full max-w-2xl overflow-y-auto rounded-xl bg-white p-12  shadow-2xl">
                    <header class="flex items-center ">
                        <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700"></h5>
                        <div class="flex-1 flex justify-end">
                            <x-buttons.primary @click="modal=false" class="hover:text-teal-600">
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
                        <livewire:reply :comment_id="$comment_id" :canReply="$canComment" wire:key="reply-{{ $comment_id }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="flex flex-row items-center justify-between mb-6 not-prose">
        <div class="">
            <h2 class="text-2xl font-bold dark:text-white">Comments <span class=""
                    data-comments-count="{{ $comments_count }}">({{ $comments_count }})</span>
            </h2>
        </div>
        <div>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-buttons.primary>Sort By</x-buttons.primary>
                </x-slot>
                <x-slot name="content">
                    <ul>
                        <li>
                            <x-dropdown-link href="/dashboard">
                                {{ __(' Newest') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link href="/settings">
                                {{ __('Most Liked') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <x-dropdown-link href="/settings">
                                {{ __('Most Disliked') }}
                            </x-dropdown-link>
                        </li>
                    </ul>

                </x-slot>
            </x-dropdown>
        </div>

    </header>

    <div class="">
        @auth
            @if ($canComment)
                <div>
                    <div class="flex items-center space-x-4 not-prose">
                        <x-avatar search="{{ auth()->user()->emailAddress() }}" :src="auth()->user()->profile_image = ''"
                            class="h-10 w-10 bg-gray-50 rounded-full" provider="gravatar" />
                        <div class="space-y-1 font-medium ">
                            <p>Add a comment</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <form wire:submit.prevent="comment">
                            @csrf
                            <div class="mb-5 ">
                                {{-- <div wire:ignore>
                                    <div wire:model="message" id="editor" class="relative">
                                        {{ $message }}
                                    </div>
                                </div> --}}
                                <div class="container mx-auto">
                                    <x-milkdown />
                                </div>
                            </div>
                            <x-buttons.secondary type="submit">
                                {{ __('Comment') }}
                            </x-buttons.secondary>
                        </form>
                    </div>
                </div>
            @else
                <div class="not-prose">
                    <div
                        class="flex flex-col items-center justify-center  px-8 py-8 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-teal-200 bg-teal-50 rounded-xl dark:bg-[#fddfd8] ">
                        <p class="text-base">Comments are turned off . <a href="#"
                                class="font-black text-teal-600">learn more</a></p>
                    </div>
                </div>
            @endif
        @else
            <x-cards.primary-card class="flex items-center w-full p-4 space-x-4 not-prose">
                <img class="w-10 h-10 rounded-full cursor-pointer md:w-11 md:h-11 "
                    src="{{ asset(Auth::user()->profile_image ?? 'https://picsum.photos/400/300') }}" alt="User dropdown">
                <div class="space-y-1 font-medium ">
                    <p>Add a comment</p>
                </div>
            </x-cards.primary-card>
        @endauth
        <hr>
        <div class="my-3" id="comments" x-data="{ showReply: false, openEdit: 0 }">
            @foreach ($comments as $comment)
                <x-cards.primary-card class="p-3 md:p-6 group" :default=false x-data="{
                    id: {{ $comment->id }},
                    get editComment() {
                        return this.openEdit === this.id
                    },
                    set editComment(value) {
                        this.openEdit = value ? this.id : null
                    },
                }" id="comment-{{ $comment->id }}">
                    <header class="flex flex-row not-prose">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <x-avatar search="{{ $comment->user->emailAddress() }}" :src="$comment->user->profile_image = ''"
                                    class="h-12 w-12 bg-gray-50 rounded-full" provider="gravatar" />
                                <div class="font-medium ">
                                    <a class="user-popover dark:text-white"
                                        href="/users/{{ $comment->user->username }}"
                                        id="user{{ $comment->id }}-{{ $comment->user_id }}">{{ $comment->user->username }}
                                        @if ($comment->user_id == $comment->blog->user_id)
                                            <span class="modern-badge modern-badge-warning">auther</span>
                                        @endif
                                    </a>
                                    <div class="text-sm">
                                        <x-carbon :date="$comment->created_at" human />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="items-center justify-end hidden group-hover:flex">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <x-buttons.simple>@svg('go-kebab-horizontal-16', 'h-5 w-5')</x-buttons.simple>
                                </x-slot>
                                <x-slot name="content">
                                    <ul>
                                        <li>
                                            <x-dropdown-link
                                                x-clipboard.raw="{{ url()->full() }}/#comment-{{ $comment->id }}">
                                                {{ __(' Copy Link') }}
                                            </x-dropdown-link>
                                        </li>
                                        <li>
                                            <x-dropdown-link href="/dashboard">
                                                {{ __(' Report') }}
                                            </x-dropdown-link>
                                        </li>

                                        @can('update', $comment)
                                            <li>
                                                <x-dropdown-link @click="editComment = ! editComment">
                                                    {{ __('Edit') }}
                                                </x-dropdown-link>
                                            </li>
                                        @endcan
                                        @can('delete', $comment)
                                            <li>
                                                <x-dropdown-link wire:click="delete({{ $comment->id }})"
                                                    class="text-rose-500">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </li>
                                        @endcan
                                    </ul>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </header>
                    <div class="my-3 prose max-w-none sm:max-w-full prose-img:rounded-xl prose-a:text-teal-600 ">
                        <div x-show="!editComment">
                            <x-markdown flavor="github">
                                {!! $comment->body() !!}
                            </x-markdown>
                        </div>
                        <div class="mt-8" x-show="editComment" x-cloak @keyup.enter>
                            <form wire:submit.prevent="update({{ $comment->id() }})" class="mt-4">
                                @csrf
                                <div class="mb-5">
                                    {{-- <div wire:model="body" wire:ignore id="editor1" class="relative">
                                    </div> --}}
                                    <x-milkdown>
                                        <div class="hidden">
                                            <x-markdown flavor="github" anchors>
                                                {!! $comment->body() !!}
                                            </x-markdown>
                                        </div>
                                    </x-milkdown>


                                </div>
                                <x-buttons.secondary class="inline-flex mr-4" type="submit"
                                    @click="editComment = ! editComment">
                                    {{ __('Edit') }}
                                </x-buttons.secondary>
                                <x-buttons.primary @click="editComment=false" wire:click="$emit('destroyEditor')">
                                    {{ __('Cancel') }}
                                </x-buttons.primary>
                            </form>
                        </div>
                    </div>
                    <footer class="mt-2" x-data="{ open: false }">
                        <div class="flex flew-row">
                            <div class="flex flex-row flex-1">
                                <livewire:like-comment :comment_id="$comment->id" :likes_count="$comment->commentlikes->where('status', 1)->count()" :wire:key="$comment->id" />
                                @if ($comment->replies->count() > 0)
                                    <button wire:click="replyIndex({{ $comment->id }})"
                                        class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                        {{ svg('iconsax-lin-message-2', 'mr-2 h-5 w-5') }}
                                        <span class="ml-1 md:ml-2"
                                            x-text="showReply ? 'Hide Replies': {{ $comment->replies->count() }} + ' Replies'">
                                        </span>
                                    </button>
                                @endif
                            </div>
                            <div class="hidden group-hover:flex items-center justify-end">
                                @guest
                                    <button type="button"
                                        class="comment-reply-toggle flex justify-end items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                        data-modal-toggle="loginMessageModal">
                                        <span> Reply</span>
                                    </button>
                                @else
                                    @if ($canComment)
                                        <button type="button" @click="open = ! open"
                                            class="reply-toggle flex justify-end items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                            <span x-text="open ? 'Hide ':' Reply'"></span>
                                        </button>
                                    @endif
                                @endguest
                            </div>
                        </div>
                        @auth
                            <div x-show="open" x-transition x-transition.top.duration.500ms x-cloak>
                                <form wire:submit.prevent="reply({{ $comment->id }})" class="mt-4">
                                    @csrf
                                    <div class="mb-5">
                                        {{-- <div wire:model="message" wire:ignore id="editor{{ $comment_id }}"
                                            class="replyeditor relative">
                                        </div> --}}
                                        <x-milkdown>
                                        </x-milkdown>
                                    </div>
                                    <x-buttons.secondary type="submit">{{ __('Reply') }}
                                    </x-buttons.secondary>
                                    <x-buttons.primary class="ml-4" @click="open=false">{{ __('Cancel') }}
                                    </x-buttons.primary>
                                </form>
                            </div>
                        @endauth
                    </footer>
                </x-cards.primary-card>
            @endforeach
        </div>
        <div class="not-prose"> {{ $comments->links('livewire::tailwind') }}</div>
    </div>

</section>
{{-- @once
    @push('scripts')
        <script data-turbolinks-eval="false">
            document.addEventListener('turbolinks:load', function() {
                const defaultValue = {
                    type: 'html',
                    dom: document.querySelector('#editor'),
                };

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
                                @this.set('message', markdown);
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
                    .use(milkdown.emoji)
                    .use(milkdown.cursor)
                    .use(milkdown.math)
                    .use(milkdown.clipboard)
                    .use(milkdown.menu)
                    .use(
                        milkdown.trailing.configure(milkdown.trailingPlugin, {
                            shouldAppend: (lastNode, state) => lastNode && !['paragraph'].includes(lastNode.type
                                .name),
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
                                                dom: createDropdownItem(ctx.get(themeToolCtx),
                                                    'Custom',
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
                        ctx.set(milkdown.defaultValueCtx, defaultValue);
                    }).create();

                const editor = milkdown.Editor
                    .make()
                    .config((ctx) => {
                        ctx.get(milkdown.listenerCtx)
                            .markdownUpdated((ctx, markdown, prevMarkdown) => {
                                @this.set('message', markdown);
                            })
                        ctx.set(milkdown.rootCtx, document.querySelector("#editor1"));
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

                document.querySelectorAll('.replyeditor').forEach((element) => {
                    milkdown.Editor
                        .make()
                        .config((ctx) => {
                            ctx.get(milkdown.listenerCtx)
                                .markdownUpdated((ctx, markdown, prevMarkdown) => {
                                    @this.set('message', markdown);
                                })
                            ctx.set(milkdown.rootCtx, element);
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
                })

                Livewire.on('commentEdit', (message, comment_id) => {
                    const defaultValue1 = message;
                    editor.then((value) => {
                        value.action(milkdown.replaceAll(message)); // 👉️ "Hello world"
                    }).catch((err) => {
                        console.log(err);
                    });
                })
                // Livewire.on('reply', (message, comment_id) => {
                //     const defaultValue1 = message;
                //     editor2.then((value) => {
                //         value.action(milkdown.replaceAll(message)); // 👉️ "Hello world"
                //     }).catch((err) => {
                //         console.log(err);
                //     });
                // })
                // document.querySelectorAll('.subreplyeditor').forEach((element) => {
                //     milkdown.Editor
                //         .make()
                //         .config((ctx) => {
                //             ctx.get(milkdown.listenerCtx)
                //                 .markdownUpdated((ctx, markdown, prevMarkdown) => {
                //                     @this.set('message', markdown);
                //                 })
                //             ctx.set(milkdown.rootCtx, element);
                //         })
                //         .use(milkdown.nord)
                //         .use(milkdown.commonmark)
                //         .use(milkdown.listener)
                //         .use(milkdown.history)
                //         .use(milkdown.emoji)
                //         .use(milkdown.table)
                //         .use(milkdown.cursor)
                //         .use(milkdown.math)
                //         .use(milkdown.clipboard)
                //         .use(milkdown.menu)
                //         .use(
                //             milkdown.trailing.configure(milkdown.trailingPlugin, {
                //                 shouldAppend: (lastNode, state) => lastNode && !['paragraph'].includes(
                //                     lastNode
                //                     .type.name),
                //             })
                //         )
                //         .use(
                //             milkdown.tooltip.configure(milkdown.tooltipPlugin, {
                //                 top: true,
                //             }))
                //         .use(
                //             milkdown.slash.configure(milkdown.slashPlugin, {
                //                 config: (ctx) => {
                //                     // Get default slash plugin items
                //                     const actions = milkdown.defaultActions(ctx);

                //                     // Define a status builder
                //                     return ({
                //                         isTopLevel,
                //                         content,
                //                         parentNode
                //                     }) => {
                //                         // You can only show something at root level
                //                         if (!isTopLevel) return null;

                //                         // Empty content ? Set your custom empty placeholder !
                //                         if (!content) {
                //                             return {
                //                                 placeholder: 'Type / to use the slash commands...'
                //                             };
                //                         }

                //                         // Define the placeholder & actions (dropdown items) you want to display depending on content
                //                         if (content.startsWith('/')) {
                //                             // Add some actions depending on your content's parent node
                //                             if (parentNode.type.name === 'customNode') {
                //                                 actions.push({
                //                                     id: 'custom',
                //                                     dom: createDropdownItem(ctx.get(
                //                                             themeToolCtx), 'Custom',
                //                                         'h1'),
                //                                     command: () => ctx.get(commandsCtx)
                //                                         .call( /* Add custom command here */ ),
                //                                     keyword: ['custom'],
                //                                     enable: () => true,
                //                                 });
                //                             }

                //                             return content === '/' ? {
                //                                 placeholder: 'Type to filter...',
                //                                 actions,
                //                             } : {
                //                                 actions: actions.filter(({
                //                                         keyword
                //                                     }) =>
                //                                     keyword.some((key) => key.includes(
                //                                         content
                //                                         .slice(1)
                //                                         .toLocaleLowerCase())),
                //                                 ),
                //                             };
                //                         }
                //                     };
                //                 },
                //             }),
                //         )
                //         .use(
                //             milkdown.indent.configure(milkdown.indentPlugin, {
                //                 type: 'space', // available values: 'tab', 'space',
                //                 size: 4,
                //             }),
                //         )
                //         .use(milkdown.diagram)
                //         .create()
                // })

            })
        </script>
    @endpush
@endonce --}}
