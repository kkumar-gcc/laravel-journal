
<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar :topTags="true"/>
    </x-slot>
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
    <div class="w-full px-2 md:px-12  my-4 relative">
        @if (session()->has('deleteSuccess'))
            <section class=" d-flex justify-content-center my-4 w-100">
                <div class="container">
                    <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning"
                        id="customxD">
                        <strong>Success!</strong> {{ session()->get('deleteSuccess') }}
                        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </section>
        @endif
        <div class="tabs mb-4  mt-4 dark:border-gray-700 overflow-y-hidden">
            <ul class="flex flex-nowrap  whitespace-nowrap  -mb-px text-sm font-medium text-center -primary "
                role="tablist">
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'newest' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=newest" role="tab">Recent</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4 {{ $tab == 'likes' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-600' }}"
                        href="/blogs?tab=likes" role="tab">Popular</a>
                </li>
                <li class="mr-2" role="presentation">
                    <a class="inline-block p-4 rounded-t-lg border-b-4  {{ $tab == 'views' ? 'text-teal-600  dark:text-teal-500  border-teal-600 dark:border-teal-500' : 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700' }}"
                        href="/blogs?tab=views" role="tab">Top Viewed</a>
                </li>
            </ul>
        </div>
        @foreach ($blogs as $blog)
            <x-cards.blog-card :blog=$blog />
        @endforeach
        {!! $blogs->withQueryString()->links('pagination::tailwind') !!}
    </div>

</x-app-layout>
