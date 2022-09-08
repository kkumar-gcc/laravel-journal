<section class="max-w-full py-8" wire:poll.500s>
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
                        <div class=" mb-5">
                            <div class="form-outline">
                                <textarea wire:model="description" type="text" id="editor2"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500 focus:placeholder:placeholder-teal-600 focus:text-teal-600"
                                    name="short_bio" data-mdb-showcounter="true" maxlength="200" rows="4" wire:model="description"
                                    placeholder="Type your comment... "></textarea>
                                <div class="form-helper"></div>
                            </div>
                        </div>
                        <x-buttons.secondary type="submit" fullWidth={true}>{{ __('Comment') }}</x-buttons.secondary>
                    </form>
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
                        {!! $comment->description !!}
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
                                        <div class="form-outline">
                                            <textarea wire:model="description" type="text" id="editor2"
                                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500 focus:placeholder:placeholder-teal-600 focus:text-teal-600"
                                                name="description" maxlength="200" rows="4" placeholder="Type your reply... "></textarea>
                                            <div class="form-helper"></div>
                                        </div>
                                    </div>
                                    <x-buttons.secondary type="submit">{{ __('Reply') }}
                                    </x-buttons.secondary>
                                    <x-buttons.primary class="ml-4" @click="open = ! open">{{ __('Cancel') }}
                                    </x-buttons.primary>
                                </form>
                            </div>
                            <div x-show="editComment" x-transition x-transition.top.duration.500ms x-cloak>
                                <livewire:edit-comment :description="$comment->description" :comment_id="$comment->id"
                                    wire:key="edit-{{ $comment->id }}" />
                            </div>
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
