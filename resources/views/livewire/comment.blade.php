<section class="max-w-full py-8" wire:poll.500s>
    <div wire:offline class="bg-red-300 p-4">
        your are offline now
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
                <div class="flex items-center space-x-4 not-prose">
                    <img class="w-10 h-10 rounded-full cursor-pointer "
                        src="{{ asset(Auth::user()->profile_image ?? 'https://picsum.photos/400/300') }}"
                        alt="User dropdown">
                    <div class="space-y-1 font-medium ">
                        <p>Add a comment</p>
                    </div>
                </div>
                <div class="mt-4">
                    <form wire:submit.prevent="comment">
                        @csrf
                        <div class="mb-5 ">
                            <div wire:ignore>
                                <div wire:model="message" id="editor" class="relative">
                                    {{ $message }}
                                </div>
                            </div>
                        </div>
                        <x-buttons.secondary type="submit">{{ __('Comment') }}</x-buttons.secondary>
                    </form>
                </div>
                <div x-data="{ modal: false }" x-init="@this.on('commentEdit', () => {
                    modal = true;
                });
                @this.on('commentClose', () => {
                    modal = false;
                })" x-trap.noscroll.inert="modal">
                    <div x-show="modal" x-cloak @keyup.escape.window="modal=false" style="display:none"
                        class="fixed inset-0 w-screen min-h-screen h-auto overflow-y-scroll z-[100] bg-black bg-opacity-20 flex items-center justify-center px-4 py-2 md:px-0">
                        <div x-show="modal" x-cloak @click.away="modal=false" x-transition.duration.500ms
                            class='relative w-full max-w-2xl   overflow-y-scroll rounded-xl bg-white p-12 shadow-lg'>
                            <form wire:submit.prevent="update({{ $comment_id }})" class="mt-4">
                                @csrf
                                <div class="mb-5">
                                    <div <div wire:model="editMessage" wire:ignore id="editor{{ $comment_id }}"
                                        class="relative">

                                    </div>
                                </div>
                                <x-buttons.secondary class="inline-flex mr-4" type="submit">{{ __('Edit') }}
                                </x-buttons.secondary>
                                <x-buttons.primary @click="modal=false" wire:click="$emit('destroyEditor')">
                                    {{ __('Cancel') }}
                                </x-buttons.primary>
                            </form>
                        </div>

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
        <div class="my-3" id="comments">
            @foreach ($comments as $comment)
                <x-cards.primary-card x-data="{ showReply: false, editComment: false }" class="p-3 md:p-6" :default=false
                    id="comment-{{ $comment->id }}">
                    <header class="flex flex-row not-prose">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <img class="w-10 h-10 rounded-full md:w-11 md:h-11"
                                    src="{{ asset($comment->user->profile_image) }}"
                                    onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $comment->user->username }}.svg`"
                                    alt="">
                                <div class="font-medium ">
                                    <a class="user-popover dark:text-white"
                                        href="/users/{{ $comment->user->username }}"
                                        id="user{{ $comment->id }}-{{ $comment->user_id }}">{{ $comment->user->username }}
                                        @if ($comment->user_id == $comment->blog->user_id)
                                            <span class="modern-badge modern-badge-warning">auther</span>
                                        @endif
                                    </a>
                                    <div class="text-sm">
                                        {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end ">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <x-buttons.simple>@svg('go-kebab-horizontal-16', 'h-5 w-5')</x-buttons.simple>
                                </x-slot>
                                <x-slot name="content">
                                    <ul>
                                        <li>
                                            <x-dropdown-link x-clipboard.raw="{{ url()->current() }}#comments">
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
                                                <x-dropdown-link wire:click="edit({{ $comment->id }})">
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
                        <x-markdown flavor="github" :anchors="true" theme="github-dark">
                            {!! $comment->body() !!}
                        </x-markdown>
                    </div>
                    <footer class="mt-2" x-data="{ open: false }">
                        <div class="flex flew-row">
                            <div class="flex flex-row flex-1">
                                <livewire:like-comment :comment_id="$comment->id" :likes_count="$comment->commentlikes->where('status', 1)->count()" :wire:key="$comment->id" />
                                @if ($comment->replies->count() > 0)
                                    <button @click="showReply = ! showReply"
                                        class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                        {{ svg('iconsax-lin-message-2', 'mr-2 h-5 w-5') }}
                                        <span class="ml-1 md:ml-2"
                                            x-text="showReply ? 'Hide Replies': {{ $comment->replies->count() }} + ' Replies'">
                                        </span>
                                    </button>
                                @endif
                            </div>
                            <div class="flex items-center justify-end">
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
                                    <div class=" mb-5">
                                        <div wire:ignore>
                                            <textarea wire:model="message" class="editor min-h-fit h-48 " name="message" id="comment_reply-{{ $comment->id }}"
                                                placeholder="Type your comment... "></textarea>
                                        </div>
                                    </div>
                                    <x-buttons.secondary type="submit">{{ __('Reply') }}
                                    </x-buttons.secondary>
                                    <x-buttons.primary class="ml-4" @click="open = ! open">{{ __('Cancel') }}
                                    </x-buttons.primary>
                                </form>
                            </div>
                            {{-- <div x-show="editComment" x-transition x-transition.top.duration.500ms x-cloak>
                                <livewire:edit-comment :message="$comment->body()" :comment_id="$comment->id"
                                    wire:key="edit-{{ $comment->id }}" />
                            </div> --}}
                        @endauth
                    </footer>
                    {{-- @auth
                            @if ($blog->comment_access == 'enable')
                                <div class="hidden mt-4" id="commentReply-{{ $comment->id }}">
                                    <form method="POST" class="comment-reply-form"
                                        id="blog_comment_form_{{ $comment->id }}">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="replied_user_id" value="{{ $comment->user_id }}">
                                        <textarea type="text" class="form-control" name="content" id="editor2" placeholder="type comment reply ..."></textarea>
                                        <button type="submit"
                                            class="inline-block font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline my-1.5 cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-teal-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800">{{ __('Reply') }}</button>
                                    </form>
                                </div>
                            @endif
                        @endauth --}}
                    <div x-show="showReply" x-transition x-transition.top.duration.500ms x-cloak
                        class="p-2 mt-3 border-l-4 border-gray-200 dark:border-gray-700">

                        <livewire:reply :comment_id="$comment->id" :canReply="$canComment" wire:key="reply-{{ $comment->id }}" />
                    </div>
                </x-cards.primary-card>
            @endforeach
        </div>
        <div class="not-prose"> {{ $comments->links('livewire::tailwind') }}</div>
    </div>

</section>
@push('scripts')
    <script type="text/javascript" defer>
        window.onload = function() {
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
                    ctx.set(milkdown.defaultValueCtx, defaultValue);
                }).create();
            Livewire.on('commentEdit', (editMessage, comment_id) => {
                Livewire.on('destroyEditor', () => {
                    alert('hello motherfucker');
                })
                const defaultValue1 = editMessage;
                const id = "#editor" + comment_id;
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
                                @this.set('editMessage', markdown);
                            })
                            .blur((ctx) => {
                                // when editor loses focus
                            })
                            .focus((ctx) => {
                                // when focus editor
                            })
                            .destroy((ctx) => {
                                // when editor is being destroyed
                                console.log("destroyed");
                            });
                        ctx.set(milkdown.rootCtx, document.querySelector(id));
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
                    .config((ctx) => {
                        ctx.set(milkdown.defaultValueCtx, editMessage);
                    })
                    .create();

            })
        }
    </script>
@endpush
