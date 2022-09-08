@if ($bookmarks->isNotEmpty())
    @foreach ($bookmarks as $bookmark)
        <x-cards.blog-card :blog="$bookmark->blog" />
    @endforeach
    {!! $bookmarks->withQueryString()->links('pagination::tailwind') !!}
@else
    <div
        class="py-4 px-5 rounded-lg text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        {{ $user->username }} has no bookmarked blogs.
    </div>
@endif

