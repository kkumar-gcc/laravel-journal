<x-base-layout>
    <div class="w-full px-2 md:px-12  my-4 relative">
        <section>
            <x-cards.blog-card :blog=$blog class="not-prose sm:border-gray-200" />
        </section>
        <livewire:blogs.manage :blog="$blog" />
    </div>
</x-base-layout>
