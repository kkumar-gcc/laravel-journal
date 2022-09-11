<x-base-layout>
    <?php
    function nice_number($n)
    {
        // $n = 0 + str_replace(',', '', $n);
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 1000000000000) {
            return round($n / 1000000000000, 1) + 't ';
        } elseif ($n > 1000000000) {
            return round($n / 1000000000, 1) + 'b ';
        } elseif ($n > 1000000) {
            return round($n / 1000000, 1) + 'm ';
        } elseif ($n > 1000) {
            return round($n / 1000, 1) + 'k ';
        }

        return number_format($n);
    }
    ?>
    <main
        class="relative prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl dark:prose-invert prose-a:text-rose-600 dark:prose-a:text-rose-500">
        <div id="toast-info">

        </div>
        <section>
            <x-cards.blog-card :blog=$blog class="not-prose sm:border-gray-200" />
        </section>
        <div class="relative flex flex-col w-full mt-3 lg:flex-row ">
            <aside class="basis-1/4 not-prose" aria-label="Sidebar">
                <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                    <ul class="space-y-2">
                        <li>
                            <a href="/blogs/edit/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Edit</span>
                            </a>
                        </li>
                        <li>
                            <a href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <span class="flex-1 ml-3 whitespace-nowrap">Manage</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="/blogs/manage/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}#delete"
                                class="flex items-center p-2 text-base font-normal transition duration-75 rounded-lg text-rose-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                                <span class="ml-4">Delete Blog</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </aside>

            <div class="flex-1 py-4 my-2 basis-3/4 lg:pl-8 not-prose">
                <section id="delete">
                    <x-cards.primary-card :default=false>
                        <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
                            <h3>Blog Stats</h3>
                        </header>
                        <div class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl">
                            <div role="status" class="max-w-sm animate-pulse">
                                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
                                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
                                <span class="sr-only">coming soon ......</span>
                            </div>
                        </div>
                    </x-cards.primary-card>
                </section>
            </div>
        </div>
    </main>
</x-base-layout>
