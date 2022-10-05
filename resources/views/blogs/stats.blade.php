<x-app-layout>
    <?php
    $tab = 'all';
    ?>
    <x-slot name="sidebar">
        <x-sidebar :topTags="false" :topUsers="false">
            <div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
                <ul class="space-y-2">
                    <li>
                        <a href="#general"
                            class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white }} hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">General</span>
                        </a>
                    </li>
                    <li>
                        <a href="/blogs/edit/{{ $blog->slug}}"
                            class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Edit</span>
                        </a>
                    </li>
                    <li>
                        <a href="/blogs/manage/{{ $blog->slug}}"
                            class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Manage</span>
                        </a>
                    </li>

                    <li>
                        <a href="#seo-settings"
                            class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Seo Settings</span>
                        </a>
                    </li>
                </ul>
                <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                    <li>
                        <a href="#delete"
                            class="flex items-center p-2 text-base font-normal transition duration-75  text-rose-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                            <span class="ml-4">Delete Blog</span>
                        </a>
                    </li>

                </ul>
            </div>
        </x-sidebar>
    </x-slot>
    <div class="w-full px-2 md:px-12  my-4 relative">
        <section>
            <x-cards.blog-card :blog=$blog class="not-prose sm:border-gray-200" />
        </section>
        <div class="relative w-full mt-3">
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

    </x-base-layout>
