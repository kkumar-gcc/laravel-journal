<div>
    @if ($bookmarks->count() > 0)
        <div>
            @foreach ($bookmarks as $bookmark)
                <x-cards.blog-card :blog="$bookmark->blog" />
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
