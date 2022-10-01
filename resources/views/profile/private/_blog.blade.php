<div class="not-prose">
    @if ($blogs->count() > 0)
        @foreach ($blogs as $blog)
            <x-cards.blog-card :blog="$blog" :private="true" />
        @endforeach
        {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
    @else
        <div
            class="px-5 py-4 text-base text-gray-700 border rounded-xl dark:text-gray-300 dark:border-gray-700 dark:bg-gray-800 ">
            You haven't published any blog.
        </div>
    @endif
</div>
