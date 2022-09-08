<div class="">
    @if ($pins->count() > 0)
        <article class="mt-4">
            @foreach ($pins as $pin)
                <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal  hover:bg-gray-50 hover:border-gray-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                    id="blog-{{ $pin->blog->id }}">
                    <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                        <div class="basis-1/3 relative text-center min-h-fit">
                            <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                            <div class="flex flex-row mt-3 mb-1 md:mt-0">
                                <div class="flex-1 flex flex-row items-center">
                                    <div class="mr-2 text-sm">
                                        {{ $pin->blog->bloglikes->where('status', 1)->count() }}
                                        <span>likes</span>
                                    </div>
                                    <div class="mr-2 text-sm">
                                        {{ $pin->blog->blogviews->count()}} <span>views</span>
                                    </div>
                                </div>
                                <div>
                                    @auth
                                        <form method="POST" id="blogPin-{{ $pin->blog->id }}" class="blogpin_form">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="blog_id" value="{{ $pin->blog->id }}">
                                            <button type="submit"
                                                class=" flex flex-row items-center mr-1  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2">
                                                <span class="book_pin_btn_{{ $pin->blog->id }}"
                                                    id="book_pin_btn_{{ $pin->blog->id }}" title="Bookmark this Article">
                                                    @if ($pin->blog->pinned)
                                                        @svg('tabler-pinned-off', 'w-5 h-5 text-rose-600 dark:text-rose-500')
                                                    @else
                                                        @svg('tabler-pin', 'h-5 w-5')
                                                    @endif
                                                </span>
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>

                            <a href="/blogs/{{ Str::slug($pin->blog->title, '-') }}-{{ $pin->blog->id }}"
                                class="link link-secondary">
                                <h5
                                    class="mb-2 text-2xl font-bold line-clamp-3 tracking-tight text-gray-900 dark:text-white">
                                    {{ $pin->blog->title }}
                                </h5>
                            </a>
                            <p class="font-normal line-clamp-3 text-gray-700 dark:text-gray-400 sm:hidden">
                                {!! Str::words(strip_tags($pin->blog->description), 50) !!}
                            </p>
                            @foreach ($pin->blog->tags as $tag)
                                <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                    id="tag{{ $pin->blog->id }}-{{ $tag->id }}">
                                    <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                        #{{ $tag->title }}
                                    </span>
                                </a>
                            @endforeach
                            <p class="mt-3">
                                <span class="mr-1">By </span>
                                <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                    href="/users/{{ $pin->blog->user->username }}"
                                    id="user{{ $pin->blog->id }}-{{ $pin->blog->user_id }}">
                                    {{ __($pin->blog->user->username) }}
                                </a>
                                <span class="text-sm ml-1">posted 3 weeks ago</span>
                            </p>
                            <a class="e-btn e-btn-dark e-btn-lg mt-5 w-full sm:hidden"
                                href="/blogs/{{ Str::slug($pin->blog->title, '-') }}-{{ $pin->blog->id }}">
                                Read
                                Article
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </article>
    @else
        <div class="py-4 px-5 rounded-xl text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
            You haven't pinned any blog.
        </div>
    @endif

    @if ($pins->count() <= 5)
        @if ($blogs->count() > 0)
            <h4 class="card-title mt-5 mb-3">Pin Blog (remaining <?php echo 5 - $pins->count(); ?>)</h4>
            <div>
                @foreach ($blogs as $blog)
                    <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal hover:bg-gray-50 hover:border-gray-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                        id="blog-{{ $blog->id }}">
                        <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                            <div class="basis-1/3 relative text-center min-h-fit">
                                <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                    src="https://picsum.photos/400/300" alt="">
                            </div>
                            <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:px-4">
                                <div class="flex flex-row mt-3 mb-1 md:mt-0">
                                    <div class="flex-1 flex flex-row items-center">
                                        <div class="mr-2 text-sm">
                                            {{$blog->bloglikes->where('status', 1)->count() }}
                                            <span>likes</span>
                                        </div>
                                        <div class="mr-2 text-sm">
                                            {{$blog->blogviews->count()}} <span>views</span>
                                        </div>
                                    </div>
                                    <div>
                                        <form method="POST" id="blogPin-{{ $blog->id }}" class="blogpin_form">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                            <button type="submit"
                                                class=" flex flex-row items-center mr-1  hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2">
                                                <span class="book_pin_btn_{{ $blog->id }}"
                                                    id="book_pin_btn_{{ $blog->id }}"
                                                    title="Bookmark this Article">
                                                    @if ($blog->pinned)
                                                        @svg('tabler-pinned-off', 'w-5 h-5 text-rose-600 dark:text-rose-500')
                                                    @else
                                                        @svg('tabler-pin', 'h-5 w-5')
                                                    @endif
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                    class="link link-secondary">
                                    <h5
                                        class="mb-2 text-2xl font-bold line-clamp-3 tracking-tight text-gray-900 dark:text-white">
                                        {{ $blog->title }}
                                    </h5>
                                </a>
                                <p class="font-normal line-clamp-3  sm:hidden">
                                    {!! Str::words(strip_tags($blog->description), 50) !!}
                                </p>
                                @foreach ($blog->tags as $tag)
                                    <a href="/blogs/tagged/{{ $tag->title }}" class="tag-popover"
                                        id="tag{{ $blog->id }}-{{ $tag->id }}">
                                        <span class="modern-badge  modern-badge-{{ $tag->color }}">
                                            #{{ $tag->title }}
                                        </span>
                                    </a>
                                @endforeach
                                <p class="mt-3">
                                    <span class="mr-1">By </span>
                                    <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                        href="/users/{{ $blog->user->username }}"
                                        id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                        {{ __($blog->user->username) }}
                                    </a>
                                    <span class="text-sm ml-1">posted 3 weeks ago</span>
                                </p>
                                <a class="e-btn e-btn-dark e-btn-lg mt-5 w-full sm:hidden"
                                    href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}">
                                    Read
                                    Article
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
            </div>
        @endif
    @endif
</div>
