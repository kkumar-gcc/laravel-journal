<div>
    <div wire:loading class="fixed bg-white bottom-3 left-3 mb-2 flex justify-center">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </div>
    <div class="tabs mb-4  mt-4 dark:border-gray-700 overflow-y-hidden">
        <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-sm font-medium text-center -primary "
            role="tablist">
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg  cursor-pointer border-b-4  {{ $tab == 'recent' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    wire:click="sortBy('recent')" role="tab">Recent</a>
            </li>
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg cursor-pointer border-b-4 {{ $tab == 'popular' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    wire:click="sortBy('popular')" role="tab">Popular</a>
            </li>
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg  cursor-pointer border-b-4 {{ $tab == 'view' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    wire:click="sortBy('view')" role="tab">Top Viewed</a>
            </li>
        </ul>
    </div>
    @if ($blogs->count() > 0)
        @foreach ($blogs as $blog)
            <x-cards.blog-card :blog=$blog />
        @endforeach
        {!! $blogs->withQueryString()->links('livewire::tailwind') !!}
    @else
        <div class="e-card e-card-hover ">
            <div class="card-body text-center">
                There is no blog related to <a href="/blogs/tagged/{{ $searchTag->title }}" class="tag-popover"
                    id="tagError-{{ $searchTag->id }}"><span class="modern-badge  modern-badge-{{ $searchTag->color }}">
                        #{{ $searchTag->title }} </a>. Please try our <a href="/tags?tab=popular">popular tags</a>.
                </span>
                </a>
            </div>
        </div>
    @endif
</div>
