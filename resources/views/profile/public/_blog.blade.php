@if ($pins->isNotEmpty())
    <div class="relative p-3 sm:p-6 border-2 border-skin-500 rounded-lg ">
        <div class="absolute top-0 -left-0  text-white capatalize py-2 px-4 leading-6  inline-flex flex-row justify-center items-center no-underline rounded-br-lg font-semibold cursor-pointer transition duration-200 ease-in-out shadow-skin-100 bg-skin-500">
            Pinned
         </div>
        <div class="my-10">
        @foreach ($pins as $pin)
            <x-cards.blog-card :blog="$pin->blog" />
        @endforeach
    </div>
        <div class="absolute bottom-0 right-0  text-white capatalize py-2 px-4 leading-6  inline-flex flex-row justify-center items-center no-underline rounded-tl-lg font-semibold cursor-pointer transition duration-200 ease-in-out shadow-skin-100 bg-skin-500">
            Pinned
         </div>
    </div>
@endif
@if ($blogs->isNotEmpty())
    @foreach ($blogs as $blog)
        <x-cards.blog-card :blog="$blog" />
    @endforeach
    {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
@endif
@if ($pins->count() < 1 && $blogs->count() < 1)
    <div
        class="py-4 px-5 rounded-lg text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        {{ $user->username }} has not published any blog.
    </div>
@endif
