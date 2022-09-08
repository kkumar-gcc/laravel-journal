@props(['blog'])
<div
    {{ $attributes->merge(['class' => 'border border-gray-200  relative  mt-8 mt-3 w-full px-2 md:p-2.5 text-base text-left p-1  rounded-lg  font-normal shadow-sm']) }}>
    <div class="flex flex-col-reverse items-stretch justify-center p-4 sm:p-6 sm:flex-row ">
        <div class="basis-2/3 mt-2 relative leading-normal sm:mt-0 sm:pr-4">
            <div class="flex flex-row mt-3 mb-1 md:mt-0">
                <div class="flex-1 flex flex-row items-center">
                    <div class="mr-2 text-sm">
                        {{ nice_number($blog->bloglikes->where('status', 1)->count()) }} <span>likes</span>
                    </div>
                    <div class="mr-2 text-sm">
                        {{ nice_number($blog->blogviews->count()) }} <span>views</span>
                    </div>
                </div>
                <div>
                    <livewire:bookmark :blog_id="$blog->id" :wire:key="$blog->id" />
                </div>
            </div>

            <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}" class="link link-secondary">
                <h5 class="mb-2 text-2xl font-bold line-clamp-3  tracking-wide text-gray-900  dark:text-white ">
                    {{ $blog->title }}
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
            <x-buttons.secondary href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}" class="mt-5 sm:hidden" fullWidth="true">Read Blog</x-buttons.secondary>
        </div>
        <div
            class="basis-1/3 relative text-center min-h-fit {{ $blog->adult_warning ? 'prose prose-img:blur-lg' : '' }}">
            <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm sm:absolute sm:top-0 sm:left-0 "
                src="https://miro.medium.com/max/1000/1*xRj13VgftcCYP2ppVFmGTw.png" alt="">
        </div>
    </div>
</div>
