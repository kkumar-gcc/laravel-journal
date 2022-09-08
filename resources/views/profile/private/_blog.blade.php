<div class="not-prose">
    @if ($blogs->count() > 0)
        @foreach ($blogs as $blog)
            <x-cards.blog-card :blog="$blog" />
            {{-- <div class="relative mt-3 w-full p-2.5 text-base text-left  border border-transparent rounded-3xl font-normal hover:bg-gray-50 hover:border-gray-200 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                    id="blog-{{ $blog->id }}">
                    <div class="flex flex-col items-stretch justify-center p-6 sm:flex-row">
                        <div class="relative text-center basis-1/3 min-h-fit">
                            <img class="relative block object-cover w-full h-full shadow-md rounded-xl hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                                src="https://picsum.photos/400/300" alt="">
                        </div>
                        <div class="relative mt-2 leading-normal basis-2/3 sm:mt-0 sm:px-4">
                            <div class="flex flex-row mt-3 mb-1 md:mt-0">
                                <div class="flex flex-row items-center flex-1">
                                    <div class="mr-2 text-sm">
                                        {{ nice_number($blog->bloglikes->where('status', 1)->count()) }}
                                        <span>likes</span>
                                    </div>
                                    <div class="mr-2 text-sm">
                                        {{ nice_number($blog->blogviews->count()) }} <span>views</span>
                                    </div>
                                </div>
                                <div>
                                    @can('isBlogOwner', $blog)
                                        <div class="flex justify-end not-prose">
                                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                                <a type="button" data-tooltip-target="tooltip-edit" data-tooltip-trigger="hover"
                                                    href="/blogs/edit/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-50 hover:text-rose-600 focus:z-10 focus:ring-2 focus:ring-rose-600 focus:text-rose-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-rose-500 dark:focus:text-white">
                                                    {{ svg('coolicon-edit', 'w-3 h-3 fill-current') }}
                                                </a>
                                                <div id="tooltip-edit" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                    edit
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                                <a type="button" data-tooltip-target="tooltip-manage" data-tooltip-trigger="hover"
                                                    href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-rose-600 focus:z-10 focus:ring-2 focus:ring-rose-600 focus:text-rose-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-rose-500 dark:focus:text-white">
                                                    <svg aria-hidden="true" class="w-3 h-3 fill-current"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <div id="tooltip-manage" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                    manage
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                                <a type="button" data-tooltip-target="tooltip-stats" data-tooltip-trigger="hover"
                                                    href="/blogs/stats/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-rose-600 focus:z-10 focus:ring-2 focus:ring-rose-600 focus:text-rose-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-rose-500 dark:focus:text-white">
                                                    @svg('icomoon-stats-bars', 'w-3 h-3 fill-current')
                                                </a>
                                                <div id="tooltip-stats" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                    see stats
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                            </div>

                            <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="link link-secondary">
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-3 dark:text-white ">
                                    {{ $blog->title }}
                                </h5>
                            </a>
                            <p class="font-normal line-clamp-3 sm:hidden">
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
                                <span class="mr-1">by </span>
                                <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                                    href="/users/{{ $blog->user->username }}"
                                    id="user{{ $blog->id }}-{{ $blog->user_id }}">
                                    {{ __($blog->user->username) }}
                                </a>
                                <span class="ml-1 text-sm">posted 3 weeks ago</span>
                            </p>
                            <a class="w-full mt-5 e-btn e-btn-dark e-btn-lg sm:hidden"
                                href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}">
                                Read
                                Article
                            </a>
                        </div>
                    </div>
                </div> --}}
        @endforeach
        {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
    @else
        <div
            class="px-5 py-4 text-base text-gray-700 border rounded-xl dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800 ">
            You haven't published any blog.
        </div>
    @endif
</div>
