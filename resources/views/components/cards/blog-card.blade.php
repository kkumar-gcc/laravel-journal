@props(['blog', 'private' => false,'pin'=>false])
<div
    {{ $attributes->merge(['class' => 'border border-gray-200  relative  mt-8 first:mt-0 mt-3 w-full px-2 md:p-2.5 text-base text-left p-1  rounded-lg  font-normal shadow-sm hover:shadow-md']) }}>
    <div class="flex flex-col-reverse items-stretch justify-center p-4 sm:p-6 sm:flex-row ">
        <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:pr-4">
            <div class="flex flex-row mt-3 mb-1 md:mt-0">
                <div class="flex-1 flex flex-row items-center">
                    <div class="mr-2 text-sm">
                        {{ $blog->bloglikes->where('status', 1)->count() }} <span>likes</span>
                    </div>
                    <div class="mr-2 text-sm">
                        {{ $blog->blogviews->count() }} <span>views</span>
                    </div>
                </div>
                <div>
                    @if ($private)
                        <div>
                            @can('update', $blog)
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <x-buttons.primary class="border hover:text-teal-600 px-2">
                                        {{ svg('iconsax-bul-setting-2', 'h-4 w-4') }}
                                    </x-buttons.primary>
                                </x-slot>
                                <x-slot name="content">
                                    <ul>
                                        <li>
                                            <x-dropdown-link
                                                href="/blogs/edit/{{ $blog->slug }}"
                                                class="flex ">
                                                {{ __(' Edit') }}
                                            </x-dropdown-link>
                                        </li>
                                        <li>
                                            <x-dropdown-link
                                                href="/blogs/manage/{{ $blog->slug }}"
                                                class="flex ">
                                                {{ __('Manage') }}
                                            </x-dropdown-link>
                                        </li>
                                        <li>
                                            <x-dropdown-link
                                                href="/blogs/stats/{{ $blog->slug }}"
                                                class="flex ">
                                                {{ __('Stats') }}
                                            </x-dropdown-link>
                                        </li>
                                    </ul>

                                </x-slot>
                            </x-dropdown>
                            @endcan
                        </div>
                    @elseif($pin)
                        {{ $slot }}
                    @else
                        <livewire:bookmark :blog_id="$blog->id" :wire:key="$blog->id" />
                    @endif
                </div>
            </div>

            <a href="/blogs/{{ $blog->slug }}" class="link link-secondary">
                <h5 class="mb-2 text-2xl font-bold line-clamp-3  tracking-wide text-gray-900  dark:text-white ">
                    {{ $blog->title() }}
                </h5>
            </a>
            {{-- <p>{{ $blog->excerpt(50) }}</p> --}}
            @foreach ($blog->tags as $tag)
                <x-tag :tag=$tag id="tag{{ $blog->id }}-{{ $tag->id }}" />
            @endforeach
            <p class="mt-3">
                <span class="mr-1">by </span>
                <a class="text-sm font-medium text-gray-900 truncate dark:text-white user-popover"
                    href="/users/{{ $blog->user->username }}" id="user{{ $blog->id }}-{{ $blog->user_id }}">
                    {{ __($blog->user->username) }}
                </a>
                <span class="ml-1 text-sm">posted
                    {{ \Carbon\Carbon::parse($blog->created_at)->diffForhumans() }}</span>
            </p>
            <x-buttons.secondary href="/blogs/{{ $blog->slug }}"
                class="mt-5 sm:hidden" fullWidth="true">Read Blog</x-buttons.secondary>
        </div>
        <div
            class="basis-1/3 relative text-center min-h-fit {{ $blog->adult_warning ? 'prose prose-img:blur-lg' : '' }}">
            <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                src="https://miro.medium.com/max/1000/1*xRj13VgftcCYP2ppVFmGTw.png" alt="">
        </div>
    </div>
</div>
