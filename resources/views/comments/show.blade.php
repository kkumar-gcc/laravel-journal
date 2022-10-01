<x-app-layout>
<x-slot name="sidebar">
    <x-sidebar :topTags="true" />
</x-slot>
{{-- <livewire:blogs.index /> --}}
<div class="w-full px-2 md:px-12  my-4 relative">
    <x-cards.blog-card :blog='$comment->blog' />

</div>
</x-app-layout>
