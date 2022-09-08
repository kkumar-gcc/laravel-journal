@forelse ($pins as $pin)
    <x-cards.blog-card :blog="$pin->blog" />
    {!! pins->withQueryString()->links('pagination::tailwind') !!}
@empty

@endforelse
@forelse ($blogs as $blog)
    <x-cards.blog-card :blog="$blog" />
    {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
@empty
    <div
        class="py-4 px-5 rounded-lg text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        {{ $user->username }} has not published any blog.
    </div>
@endforelse

@if ($pins->count() < 1 && $blogs->count() < 1)
    <div
        class="py-4 px-5 rounded-lg text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        {{ $user->username }} has not published any blog.
    </div>
@endif
