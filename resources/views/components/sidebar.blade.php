@props(['topBlogs' => false, 'topUsers' => true, 'topTags' => true])
<article>
    @if ($topBlogs)
    @endif
    @if ($topUsers)
        <livewire:top-users />
    @endif
    @if ($topTags)
        <livewire:top-tags />
    @endif

</article>
