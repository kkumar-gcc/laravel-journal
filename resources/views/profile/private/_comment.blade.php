@if ($comments->count() > 0)
    <x-cards.primary-card :default=false>
        <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white border-b">
            <span class="modern-badge modern-badge-danger">Comments</span>
        </header>
        {{-- <header class="py-3 px-4 text-2xl font-bold tracking-wide text-gray-700 dark:text-white">
                <h3> Comments</h3>
            </header> --}}
        <ul class="p-0 list-none">
            @foreach ($comments as $comment)
                <li
                    class=" py-3 px-4 last:rounded-b-lg  dark:hover:text-white hover:bg-gray-50 hover:shadow-sm dark:bg-gray-800 dark:hover:bg-gray-700">
                    <a href="#">{{ $comment->blog->title }}</a>
                    <span class="text-muted ">
                        {!! Str::words($comment->description, 1000) !!}
                    </span>
                </li>
            @endforeach
            <li
                class=" py-3 px-4 last:rounded-b-lg  dark:hover:text-white hover:bg-gray-50 hover:shadow-sm dark:bg-gray-800 dark:hover:bg-gray-700">
                <a href="/href" class="text-teal-500">View all {{ $comments->count() }} comments</a>
                {{-- <span class="text-muted ">
                    {!! Str::words($comment->description, 1000) !!}
                </span> --}}
            </li>
        </ul>
    </x-cards.primary-card>

    {{-- {!! $comments->withQueryString()->links('pagination::tailwind') !!} --}}
@else
    <div
        class="py-4 px-5 rounded-xl text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        You haven't written any comment.
    </div>
@endif
