<div x-data="{ tags: [], newTag: '' }">
    <label class="text-xl font-bold line-clamp-3  tracking-wide  block mb-2  text-gray-700" for="name">Tags</label>
    <template x-for="tag in tags">
        <input type="hidden" :value="tag" name="tags">
    </template>
    <div class="tags-input">
        <template x-for="tag in tags" class="my-4" :key="tag" wire:ignore>
            <span
                class="inline-flex py-1 px-2 mb-2 mx-[5px] text-[10px] leading-4 first:ml-0 font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600 before:content-['#'] before:mr-0.5 ">
                <span x-text="tag"></span>
                <button type="button" class="ml-2 border-l " @click="tags = tags.filter(i => i !== tag)">
                    &times;
                </button>
            </span>
        </template>
        {{-- @keydown.enter.prevent="if (newTag.trim() !== '') tags.push(newTag.trim()); newTag = ''"
            @keydown.backspace="if (newTag.trim() === '') tags.pop()" x-model="newTag" placeholder="Add tags . . ."
             --}}
        <input type="text" wire:model="search" @keydown.enter.prevent
            x-bind:placeholder="(tags.length < 5) ? 'Add tags . . .' : 'you can only choose 5 tags.'"
            x-bind:disabled="(tags.length < 5) ? false: true"
            class="border border-gray-300 text-gray-600 text-base font-bold focus:shadow-md focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500" />

        <div :class="(tags.length < 5) ? '' : 'hidden'">
            <div class="z-50 mt-2 w-full origin-top-left left-0">
                @forelse($searchTags as $tag)
                    <button
                        class="shadow-md last:rounded-b-lg w-full ring-1 px-4 py-3.5 ring-black ring-opacity-5  bg-white hover:cursor-pointer"
                        @click.prevent="if (tags.length<5 && !tags.includes('{{ $tag->title }}')) tags.push('{{ $tag->title }}')">

                        <span
                            class="inline-flex py-1 px-2 mb-2 mx-[5px] text-[10px] leading-4 first:ml-0 font-bold tracking-wide border rounded-[4px] shadow-sm border-rose-200 uppercase  bg-rose-100 text-rose-600 before:content-['#'] before:mr-0.5 ">
                            {{ $tag->title() }}
                        </span>
                    </button>
                @empty
                    no result
                @endforelse
            </div>
        </div>
    </div>
</div>
