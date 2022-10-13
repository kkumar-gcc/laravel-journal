<div class="relative mt-3 w-full text-left  rounded-xl font-normal">
    <header class="py-3 px-4 text-2xl font-bold tracking-wide text-gray-700 dark:text-white">
        <h3> Top Tags</h3>
    </header>
    <ul class="p-0 list-none">
        @foreach ($topTags as $topTag)
            <li
                class="py-3 px-4  dark:hover:text-white hover:bg-gray-50 hover:shadow-sm">

                    <x-tag :tag=$topTag id="tag-{{ $topTag->id }}" />
                    <span class="item-multiplier text-sm font-medium">
                        <span class="item-multiplier-x">×</span>&nbsp;
                        <span class="item-multiplier-count">{{ $topTag->blogs_count }}</span>
                    </span>
            </li>
        @endforeach
    </ul>
</div>
