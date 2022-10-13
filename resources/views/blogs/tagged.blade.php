<x-app-layout >
    <x-slot name="sidebar">
        <x-sidebar />
    </x-slot>

    <div class="w-full px-2 md:px-12  my-4 relative">
        <x-cards.primary-card :default=false class="mt-0 p-4">
            <header class="px-4 py-3 text-2xl font-semibold text-gray-700 dark:text-white">
                <x-tag :tag=$searchTag id="tag-{{ $searchTag->id }}" class="not-prose" />
            </header>
            <div class="px-4 py-3 text-gray-700 last:rounded-b-lg ">
                <p class="mb-3">{{$searchTag->description}}</p>
            </div>
        </x-cards.primary-card>
        <livewire:blogs.tagged :tag="$searchTag->title" />
    </div>

</x-app-layout>
