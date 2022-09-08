<section class="max-w-full py-8">

    <header class="flex flex-row items-center justify-between mb-6 not-prose">
        <div class="">
            <h2 class="text-2xl font-bold dark:text-white">Comments <span class=""
                    data-comments-count="{{ $blog->comments->count() }}">({{ $blog->comments->count() }})</span>
            </h2>
        </div>
        <div>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-buttons.primary >Sort By</x-buttons.primary>
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
            {{-- <x-dropdowns.primary right={true}>
                <x-slot:title> Sort By </x-slot:title>
                <ul>
                    <li>
                        <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=newest#comments" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                            Newest
                        </a>
                    </li>
                    <li>
                        <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=likes#comments" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                            Most Liked
                        </a>
                    </li>
                    <li>
                        <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}?tab=dislikes#comments" class="block hover:bg-gray-50 whitespace-no-wrap py-2 px-4">
                            Most Disliked
                        </a>
                    </li>
                </ul>
            </x-dropdowns.primary> --}}
        </div>
    </header>
    <div class="">
        @auth
            @if ($blog->comment_access == 'enable')
                <div class="flex items-center space-x-4 not-prose">
                    <img class="w-10 h-10 rounded-full cursor-pointer "
                        src="{{ asset(Auth::user()->profile_image ?? 'https://picsum.photos/400/300') }}"
                        alt="User dropdown">
                    <div class="space-y-1 font-medium ">
                        <p>Add a comment</p>
                        {{-- <div class="text-sm text-gray-500 dark:text-gray-400">Joined in August 2014</div> --}}
                    </div>
                </div>
                <div class="mt-2">

                    <div class="form">
                        <form method="POST" id="blog_comment_form">
                            @csrf
                            @method('put')
                            <input type="hidden" name="blog_id" id="comment_blog_id" value="{{ $blog->id }}">
                            <input type="hidden" name="user_id" id="comment_user_id" value="{{ auth()->user()->id }}">
                            <textarea type="text" class="form-control" name="comment" id="editor2" placeholder="Type your comment... "></textarea>
                            <button type="submit"
                                class="inline-block font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline my-1.5 cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">{{ __('Comment') }}</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="not-prose">
                    <div
                        class="flex flex-col items-center justify-center  px-8 py-8 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-rose-200 bg-rose-50 rounded-xl dark:bg-[#fddfd8] ">
                        <p class="text-base">Comments are turned off . <a href="#"
                                class="font-black text-rose-600">learn more</a></p>
                    </div>
                </div>
            @endif
        @else
            @if ($blog->comment_access == 'disable')
                <div class="not-prose">
                    <div
                        class="flex flex-col items-center justify-center  px-8 py-8 mb-4 text-sm text-[#1f2833] leading-6 border not-prose  border-rose-200 bg-rose-50 rounded-xl dark:bg-[#fddfd8] ">
                        <p class="text-base">Comments are turned off . <a href="#"
                                class="font-black text-rose-600">learn more</a></p>
                    </div>
                </div>
            @else
                <button type="button"
                    class="flex items-center w-full p-4 space-x-4 border border-gray-200 not-prose rounded-xl hover:border-rose-600 dark:border-gray-700 dark:hover:border-rose-500"
                    data-modal-toggle="loginMessageModal">
                    <img class="w-10 h-10 rounded-full cursor-pointer md:w-11 md:h-11 "
                        src="{{ asset(Auth::user()->profile_image ?? 'https://picsum.photos/400/300') }}"
                        alt="User dropdown">
                    <div class="space-y-1 font-medium ">
                        <p>Add a comment</p>
                        {{-- <div class="text-sm text-gray-500 dark:text-gray-400">Joined in August 2014</div> --}}
                    </div>
                </button>
            @endif

        @endauth
        <hr>
        <div class="my-3" id="comments">
            <div class="">
                <div id="new-comment">
                </div>
                @foreach ($comments as $comment)
                <x-cards.primary-card x-data="{ open: false }" class="p-3 md:p-6" :default=false id="comment-{{ $comment->id }}">
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
                                            @if ($comment->user_id == $blog->user_id)
                                                <span class="modern-badge modern-badge-warning">auther</span>
                                            @endif
                                        </a>
                                        <div class="text-sm">
                                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end ">
                                <button type="button"
                                    class="hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                    @svg('go-kebab-horizontal-16', 'h-5 w-5')
                                </button>
                            </div>
                        </header>
                        <div class="my-3 prose max-w-none sm:max-w-full prose-img:rounded-xl prose-a:text-rose-600 ">
                            {!! $comment->description !!}
                        </div>
                        <footer class="mt-2">
                            <div class="flex flew-row">
                                <div class="flex flex-row flex-1">
                                    @guest
                                        <button type="button"
                                            class="flex flex-row items-center mr-2 md:mr-3 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                            data-modal-toggle="loginMessageModal">
                                            {{ svg('grommet-like', 'h-4 w-4') }}
                                            <span class="ml-3">
                                                {{ nice_number($comment->commentlikes->where('status', 1)->count()) }}</span>
                                        </button>
                                        <button type="button"
                                            class="flex flex-row items-center mr-2 md:mr-3 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                            data-modal-toggle="loginMessageModal">
                                            {{ svg('grommet-dislike', 'h-4 w-4') }}
                                        </button>
                                    @else
                                        <form method="POST" id="comment_like_form_{{ $comment->id }}"
                                            class="d-inline comment-like">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="comment_id"
                                                id="comment_like_id_{{ $comment->id }}" value="{{ $comment->id }}">
                                            <input type="hidden" name="user_id" id="user_like_id_{{ $comment->id }}"
                                                value="{{ auth()->user()->id }}">
                                            <button type="submit" id="comment-like-{{ $comment->id }}"
                                                class="flex flex-row items-center {{ $comment->isAuthUserLikedComment() ? 'bg-red-500' : '' }}  mr-2 md:mr-3 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                {{ svg('grommet-like', 'h-4 w-4') }}
                                                <span class="ml-3">
                                                    {{ nice_number($comment->commentlikes->where('status', 1)->count()) }}</span>
                                            </button>
                                        </form>
                                        <form method="post" id="comment_dislike_form_{{ $comment->id }}"
                                            class="d-inline comment-dislike">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="comment_id"
                                                id="comment_dislike_id_{{ $comment->id }}" value="{{ $comment->id }}">
                                            <input type="hidden" name="user_id"
                                                id="user_dislike_id_{{ $comment->id }}"
                                                value="{{ auth()->user()->id }}">
                                            <button type="submit" id="comment-dislike-{{ $comment->id }}"
                                                class="flex flex-row mr-2 md:mr-3 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                {{ svg('grommet-dislike', 'h-4 w-4') }}
                                            </button>
                                        </form>
                                    @endguest
                                    @if ($comment->replies->count() > 0)
                                        <button  @click="open = ! open"
                                            class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                            @svg('coolicon-message-round', 'h-5 w-5')
                                            <span class="ml-1 md:ml-2" x-text="open ? 'Hide Replies': {{ nice_number($comment->replies->count()) }} + ' Replies'">
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
                                        @if ($blog->comment_access == 'enable')
                                            <button type="button"
                                                class="reply-toggle flex justify-end items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                                data-reply-toggle="commentReply-{{ $comment->id }}">
                                                <span> Reply</span>
                                            </button>
                                        @endif
                                    @endguest

                                </div>
                            </div>
                        </footer>
                        @auth
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
                                            class="inline-block font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline my-1.5 cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">{{ __('Reply') }}</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                         <div x-show="open" x-transition x-collapse.duration.1000ms x-cloak class="p-2 mt-3 border-l-4 border-gray-200 dark:border-gray-700"
                            id="replyToggle-{{ $comment->id }}">


                            @foreach ($comment->replies as $reply)
                                <div class="w-full p-4 px-4 my-3 border border-gray-200 not-prose rounded-xl hover:border-rose-600 active:border-rose-600 dark:border-gray-700 dark:hover:border-rose-500"
                                    id="reply-{{ $reply->id }}">
                                    <header class="flex flex-row not-prose">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-4 user-popover">
                                                <img class="w-10 h-10 rounded-full md:w-11 md:h-11"
                                                    src="{{ asset($reply->user->profile_image) }}"
                                                    onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $reply->user->username }}.svg`"
                                                    alt="">
                                                <div class="font-medium">
                                                    <a class="user-popover dark:text-white"
                                                        href="/users/{{ $reply->user->username }}"
                                                        id="user{{ $reply->id }}-{{ $reply->user_id }}">{{ $comment->user->username }}
                                                        @if ($reply->user_id == $blog->user_id)
                                                            <span
                                                                class="modern-badge modern-badge-warning">auther</span>
                                                        @endif
                                                    </a>
                                                    <div class="text-sm ">
                                                        {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end ">
                                            <button type="button"
                                                class=" hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                @svg('go-kebab-horizontal-16', 'h-5 w-5')
                                            </button>
                                        </div>
                                    </header>
                                    <div class="my-3">
                                        {!! $reply->description !!}
                                    </div>
                                    <footer class="mt-2">
                                        <div class="flex flew-row">
                                            <div class="flex flex-row flex-1">
                                                @guest
                                                    <button type="button"
                                                        class="flex flex-row items-center mr-3 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                                        data-modal-toggle="loginMessageModal">
                                                        {{ svg('grommet-like', 'h-4 w-4') }}
                                                        <span class="ml-3 -mt-0.5">
                                                            {{ nice_number($reply->replylikes->where('status', 1)->count()) }}</span>
                                                    </button>
                                                    <button type="button"
                                                        class="flex flex-row items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                                        data-modal-toggle="loginMessageModal">
                                                        {{ svg('grommet-dislike', 'h-4 w-4') }}
                                                    </button>
                                                @else
                                                    <form method="POST" id="reply_like_form_{{ $reply->id }}"
                                                        class="d-inline reply-like">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="reply_id"
                                                            id="reply_like_id_{{ $reply->id }}"
                                                            value="{{ $reply->id }}">
                                                        <input type="hidden" name="user_id"
                                                            id="user_like_id_{{ $reply->id }}"
                                                            value="{{ auth()->user()->id }}">
                                                        <button type="submit" id="reply-like-{{ $reply->id }}"
                                                            class="flex flex-row items-center  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                            {{ svg('grommet-like', 'h-4 w-4') }}
                                                            <span class="ml-3 -mt-0.5">
                                                                {{ nice_number($reply->replylikes->where('status', 1)->count()) }}</span>
                                                        </button>
                                                    </form>
                                                    <form method="post" id="reply_dislike_form_{{ $reply->id }}"
                                                        class="d-inline reply-dislike">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="reply_id"
                                                            id="reply_dislike_id_{{ $reply->id }}"
                                                            value="{{ $reply->id }}">
                                                        <input type="hidden" name="user_id"
                                                            id="user_dislike_id_{{ $reply->id }}"
                                                            value="{{ auth()->user()->id }}">
                                                        <button type="submit" id="reply-dislike-{{ $reply->id }}"
                                                            class="flex flex-row items-center mr-3 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                                            {{ svg('grommet-dislike', 'h-4 w-4') }}
                                                        </button>
                                                    </form>
                                                @endguest
                                            </div>
                                            <div class="flex items-center justify-end">
                                                @guest
                                                    <button type="button"
                                                        class="flex justify-end items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                                        data-modal-toggle="loginMessageModal">
                                                        Reply
                                                    </button>
                                                @else
                                                    @if ($blog->comment_access == 'enable')
                                                        <button type="button"
                                                            class="reply-toggle flex justify-end items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                                            data-reply-toggle="replyForm-{{ $reply->id }}">
                                                            <span> Reply</span>
                                                        </button>
                                                    @endif
                                                @endguest
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                                @auth
                                    @if ($blog->comment_access == 'enable')
                                        <div class="hidden" id="replyForm-{{ $reply->id }}">
                                            <form method="POST" class="comment-reply-form "
                                                id="comment_reply_form_{{ $reply->id }}">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <input type="hidden" name="replied_user_id"
                                                    value="{{ $reply->user_id }}">
                                                <textarea type="text" class="form-control" name="content" id="editor2">
                                            <a class="link link-secondary text-danger user-popover" id="commentReply{{ auth()->user()->id }}-{{ $reply->user_id }}" style="text-decoration:none;color:red" href="/users/{{ $reply->user->username }}"><code> {{ '@' }}{{ $reply->user->username }}</code></a>
                                        </textarea>
                                                <button type="submit"
                                                    class="inline-block font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline my-1.5 cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-2 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800">{{ __('Reply') }}</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            @endforeach
                            <div id="new-reply-{{ $comment->id }}">
                            </div>
                        </div>

                </x-cards.primary-card>
                @endforeach

            </div>
        </div>
        <div class="not-prose"> {!! $comments->withQueryString()->links('pagination::tailwind') !!}</div>
    </div>

</section>
