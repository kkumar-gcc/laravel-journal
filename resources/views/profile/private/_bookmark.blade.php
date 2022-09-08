<div>
    @if ($bookmarks->count() > 0)
        <div>
            @foreach ($bookmarks as $bookmark)
                <x-cards.blog-card :blog="$bookmark->blog" />
                {{-- <div class="relative mt-3  w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal  hover:bg-gray-50 hover:border-gray-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
            id="blog-{{ $bookmark->blog->id }}">
            <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                <div class="basis-1/3 relative text-center min-h-fit">
                    <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                        src="https://picsum.photos/400/300" alt="">
                </div>
                <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                    <div class="flex flex-row mt-3 mb-1 md:mt-0">
                        <div class="flex-1 flex flex-row items-center">
                            <div class="mr-2 text-sm">
                                {{ nice_number($bookmark->blog->bloglikes->where('status', 1)->count()) }} <span>likes</span>
                            </div>
                            <div class="mr-2 text-sm">
                                {{ nice_number($bookmark->blog->blogviews->count()) }} <span>views</span>
                            </div>
                        </div>
                        <div>
                            @guest
                            <button type="button"
                                    class="flex flex-row items-center mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2"
                                    data-modal-toggle="loginMessageModal">
                                    <span title="Bookmark this Article">
                                        @svg('gmdi-bookmark-add-o', 'h-5 w-5') </span>
                                </button>
                            @else
                                @if (auth()->user()->id != $bookmark->blog->user_id)
                                    <form method="POST" id="bookmark-{{ $bookmark->blog->id }}" class="bookmark_form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="user_id" id="user_bookmark_id_{{ $bookmark->blog->id }}"
                                            value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="blog_id" id="blog_bookmark_id_{{ $bookmark->blog->id }}"
                                            value="{{ $bookmark->blog->id }}">
                                        <button type="submit"
                                            class="flex flex-row items-center mr-1  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2"
                                            >
                                            <span class="bookmark_btn_{{ $bookmark->blog->id }}"
                                                id="bookmark_btn_{{ $bookmark->blog->id }}" title="Bookmark this Article">
                                                @if ($bookmark->blog->isBookmarked())
                                                    @svg('gmdi-bookmark-added-r', 'w-5 h-5 text-rose-500')
                                                @else
                                                    @svg('gmdi-bookmark-add-o', 'h-5 w-5')
                                                @endif
                                            </span>
                                        </button>
                                    </form>
                                @endif
                            @endguest
                        </div>
                    </div>
                    <a href="/blogs/{{ Str::slug($bookmark->blog->title, '-') }}-{{ $bookmark->blog->id }}"
                        class="link link-secondary">
                        <h5
                            class="mb-2 text-2xl font-bold line-clamp-3 tracking-tight text-gray-900 dark:text-white">
                            {{ $bookmark->blog->title }}
                        </h5>
                    </a>
                    <p class="font-normal line-clamp-3  sm:hidden">
                        {!! Str::words(strip_tags($bookmark->blog->description), 50) !!}
                    </p>
                    @foreach ($bookmark->blog->tags as $tag)
                        <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                            id="tag{{ $bookmark->blog->id }}-{{ $tag->id }}">
                            <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                #{{ $tag->title }}
                            </span>
                        </a>
                    @endforeach
                    <p class="mt-3">
                        <span class="mr-1">By </span>
                        <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                            href="/users/{{ $bookmark->blog->user->username }}"
                            id="user{{ $bookmark->blog->id }}-{{ $bookmark->blog->user_id }}">
                            {{ __($bookmark->blog->user->username) }}
                        </a>
                        <span class="text-sm ml-1">posted 3 weeks ago</span>
                    </p>
                    <a class="e-btn e-btn-dark e-btn-lg mt-5 w-full sm:hidden"
                        href="/blogs/{{ Str::slug($bookmark->blog->title, '-') }}-{{ $bookmark->blog->id }}">
                        Read
                        Article
                    </a>
                </div>
            </div>
        </div> --}}
            @endforeach
            {!! $bookmarks->withQueryString()->links('pagination::tailwind') !!}
        </div>
    @else
        <div
            class="py-4 px-5 rounded-xl text-base border text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
            You haven't bookmarked any blog.
        </div>
    @endif

</div>
