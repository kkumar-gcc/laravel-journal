<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar :topBlogs="true" :topTags="false" />
    </x-slot>
    <div class="p-2 md:p-5 lg:p-7">
        <div class="">
            <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white"> All
                Tags</h1>
        </div>
        {{-- <div class=" my-3 flex flex-row justify-between items-center">
            <div class="flex-1 mr-4">
                <input id="search-input" autocomplete="off" type="search"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-2.5  "
                    placeholder="Search by tag name" name="search">
                </div>

            <button id="tagShortDropdownButton" data-dropdown-toggle="tagShortDropdown"
                data-dropdown-placement="bottom-end"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 font-medium text-center inline-flex items-center rounded-lg text-sm px-5 py-2.5  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button">Sort By <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="tagShortDropdown"
                class="hidden z-10  bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom-end">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="tagShortDropdownButton">
                    <li>
                        <a class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            href="/tags?tab=newest">Newest</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            href="/tags?tab=name">Name</a></ </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            href="/tags?tab=popular">Popular</a>
                    </li>
                </ul>
            </div>

        </div> --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-4 pt-4" id="tag-show">

            @foreach ($tags as $tag)
                <x-cards.primary-card :default=false class="mt-0">
                    <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
                        <x-tag :tag=$tag id="tag-{{ $tag->id }}" class="not-prose" />
                    </header>
                    <div class="px-4 py-3 text-gray-700 last:rounded-b-lg ">
                        @if ($tag->description())
                            <p class="mb-3">{{ $tag->description() }}</p>
                        @endif
                        <span class="text-muted">{{ $tag->blogs_count }} blogs</span>
                    </div>
                </x-cards.primary-card>
            @endforeach

        </div>
        <div class="row" id="new-tag-show"></div>
        <div id="tag-paginator">
            {!! $tags->withQueryString()->links('pagination::tailwind') !!}
        </div>
    </div>
</x-app-layout>
{{-- <div class="p-8">
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm  uppercase ">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-gray-200 uppercase  bg-gray-100 text-gray-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-red-200 uppercase  bg-red-100 text-red-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-orange-200 uppercase  bg-orange-100 text-orange-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-amber-200 uppercase  bg-amber-100 text-amber-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-yellow-200 uppercase  bg-yellow-100 text-yellow-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-lime-200 uppercase  bg-lime-100 text-lime-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-green-200 uppercase  bg-green-100 text-green-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-emerald-200 uppercase  bg-emerald-100 text-emerald-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-teal-200 uppercase  bg-teal-100 text-teal-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-cyan-200 uppercase  bg-cyan-100 text-cyan-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-sky-200 uppercase  bg-sky-100 text-sky-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-blue-200 uppercase  bg-blue-100 text-blue-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-indigo-200 uppercase  bg-indigo-100 text-indigo-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-violet-200 uppercase  bg-violet-100 text-violet-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-purple-200 uppercase  bg-purple-100 text-purple-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-fuchsia-200 uppercase  bg-fuchsia-100 text-fuchsia-600">
        #friends</span>
    <span
        class="inline-flex py-1 px-2 mx-[5px] mt-3 text-[10px] font-bold tracking-wide border rounded-[4px] shadow-sm border-pink-200 uppercase  bg-pink-100 text-pink-600">
        #friends</span>
</div> --}}
