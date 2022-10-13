<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
            class="flex items-center justify-between my-4 not-prose">
            <div class="flex justify-between flex-1 md:hidden not-prose">
                @if ($paginator->onFirstPage())
                    <span
                        class="relative  inline-flex items-center py-2 px-4 mr-3 text-sm font-medium text-gray-500 bg-skin-base rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Previous
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                        class="relative  inline-flex items-center py-2 px-4 mr-3 text-sm font-medium text-gray-500 bg-skin-base rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white transition ease-in-out duration-150">
                        <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Previous
                    </button>
                @endif

                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                        class="relative inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-skin-base rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white transition ease-in-out duration-150">
                        Next
                        <svg aria-hidden="true" class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </button>
                @else
                    <span
                        class="relative inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-skin-base rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next
                        <svg aria-hidden="true" class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </span>
                @endif
            </div>

            <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">
                <div>
                    <p class="font-normal text-gray-700 dark:text-gray-400 leading-5">
                        {!! __('Showing') !!}
                        @if ($paginator->firstItem())
                            <span class="font-medium">{{ $paginator->firstItem() }}</span>
                            {!! __('to') !!}
                            <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        @else
                            {{ $paginator->count() }}
                        @endif
                        {!! __('of') !!}
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        {!! __('results') !!}
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span
                                    class="relative inline-flex items-center px-3 py-2 ml-0 leading-tight  text-gray-500 bg-skin-base border rounded-l-lg border-gray-300 cursor-pointer  hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white "
                                    aria-hidden="true">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        @else
                            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                                class="relative inline-flex items-center px-3 py-2 ml-0 leading-tight  text-gray-500 bg-skin-base border rounded-l-lg border-gray-300 cursor-pointer  hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white  transition ease-in-out duration-150"
                                aria-label="{{ __('pagination.previous') }}">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </button>
                        @endif

                        @if ($paginator->currentPage() > 3)
                            @if ($paginator->currentPage() > 3)
                                <button wire:click="gotoPage(1)"
                                    class="relative inline-flex items-center py-2 px-3 leading-tight text-gray-500 bg-skin-base border border-gray-300 cursor-pointer hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                    aria-label="{{ __('Go to page :page', ['page' => 1]) }}">
                                    1
                                </button>
                            @endif
                        @endif
                        @if ($paginator->currentPage() > 4)
                            <span aria-disabled="true"
                                class="py-2 px-3 leading-tight text-gray-500 bg-skin-base border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</span>
                        @endif
                        @foreach (range(1, $paginator->lastPage()) as $i)
                            @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                                @if ($i == $paginator->currentPage())
                                    <span aria-current="page"
                                        class="relative inline-flex items-center py-2 px-3 leading-tight text-skin-600 bg-skin-50 border border-skin-300 cursor-pointer hover:bg-skin-100 hover:text-skin-600 dark:border-gray-700 dark:bg-gray-700 dark:text-white ">{{ $i }}</span>
                                @else
                                    <button wire:click="gotoPage({{ $i }})"
                                        class="relative inline-flex items-center py-2 px-3 leading-tight text-gray-500 bg-skin-base border border-gray-300 cursor-pointer hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        aria-label="{{ __('Go to page :page', ['page' => $i]) }}">
                                        {{ $i }}
                                    </button>
                                @endif
                            @endif
                        @endforeach
                        @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                            <span aria-disabled="true"
                                class="py-2 px-3 leading-tight text-gray-500 bg-skin-base border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</span>
                        @endif
                        @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                            <button wire:click="gotoPage({{ $paginator->lastPage() }})"
                                class="relative inline-flex items-center py-2 px-3 leading-tight text-gray-500 bg-skin-base border border-gray-300 cursor-pointer hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                aria-label="{{ __('Go to page :page', ['page' => $paginator->lastPage()]) }}">
                                {{ $paginator->lastPage() }}
                            </button>
                        @endif


                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                                class="relative inline-flex items-center px-3 py-2 ml-0 leading-tight  text-gray-500 bg-skin-base border rounded-r-lg border-gray-300 cursor-pointer  hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white  transition ease-in-out duration-150"
                                aria-label="{{ __('pagination.next') }}">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </button>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span
                                    class="relative inline-flex items-center px-3 py-2 ml-0 leading-tight  text-gray-500 bg-skin-base border rounded-r-lg border-gray-300 cursor-pointer  hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white "
                                    aria-hidden="true">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
