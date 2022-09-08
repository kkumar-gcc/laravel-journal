<div class="relative mt-3 w-full text-left  rounded-xl font-normal">
    <header class="py-3 px-4 text-2xl font-bold tracking-wide text-gray-700 dark:text-white">
        <h3> Top Tags</h3>
    </header>
    <ul class="p-0 list-none">
        @foreach ($topTags as $topTag)
            <li
                class="py-3 px-4  dark:hover:text-white hover:bg-gray-50 hover:shadow-sm dark:bg-gray-800 dark:hover:bg-gray-700">
                <div data-name="{{ $topTag->title }}">
                    <a href="/blogs/tagged/{{ $topTag->title }}" class="tag-popover" id="sidebarTag-{{ $topTag->id }}">
                        <span
                            class="inline-flex py-1 px-2 mx-[5px] text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600">
                            #{{ $topTag->title }}
                        </span>
                    </a>
                    <span class="item-multiplier text-sm font-medium">
                        <span class="item-multiplier-x">×</span>&nbsp;
                        <span class="item-multiplier-count">{{ $topTag->blogs_count }}</span>
                    </span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
