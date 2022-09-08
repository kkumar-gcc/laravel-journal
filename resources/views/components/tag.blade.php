@props(['tag'])
<a href="/blogs/tagged/{{ $tag->title }}" {{ $attributes->merge(['class' => 'text-[10px] no-underline tag-popover']) }}  {{ $attributes['id']}}>
    <span
        class="inline-flex py-1 px-2 mb-2 mx-[5px] text-[10px] leading-4 first:ml-0 font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600">
        #{{ $tag->title }}
    </span>
</a>
