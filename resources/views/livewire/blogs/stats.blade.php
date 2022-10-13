<div class="relative w-full mt-3">
    <div class="tabs mb-4  mt-4 dark:border-gray-700 overflow-y-hidden">
        <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-base font-semibold text-center -primary "
            role="tablist">
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg  cursor-pointer border-b-4  {{ $tab == 'manage' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    href="/blogs/manage/{{ $blog->slug }}" >Settings</a>
            </li>
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg cursor-pointer border-b-4 {{ $tab == 'edit' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    href="/blogs/edit/{{ $blog->slug }}" role="tab">Edit</a>
            </li>
            <li class="mr-2" role="presentation">
                <a class="inline-block p-4 rounded-t-lg  cursor-pointer border-b-4  {{ $tab == 'stats' ? 'text-skin-600  dark:text-skin-500  border-skin-600 dark:border-skin-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                    role="tab">Stats</a>
            </li>
        </ul>
    </div>
    <section>
        <div class="relative my-5 w-full">
            <h3 class="py-3 px-4 text-3xl font-bold tracking-wide text-gray-600">Stats</h3>
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
        </div>
    </section>

</div>
