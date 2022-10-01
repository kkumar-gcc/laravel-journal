<div class="not-prose">
    @if ($drafts->count() > 0)
        <div>
            @foreach ($drafts as $draft)
            <x-cards.blog-card :blog="$draft" :private="true"/>
            @endforeach
            {!! $drafts->withQueryString()->links('pagination::tailwind') !!}
        </div>
    @else
        <div class="py-3 px-4 rounded-xl text-base  text-gray-700 dark:text-gray-300   dark:bg-gray-800 ">
            You don't have any drafted blog.
        </div>
    @endif
</div>
