@props(['share'])
<x-modals.full modal="shareModal" class="h-auto">
    <x-slot:header>
        Share
    </x-slot:header>
    <x-slot:title>
        <button type="button"
            class=" flex flex-row items-center mr-1 md:mr-1 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
            x-on:click="shareModal = true">
            {{ svg('iconsax-bul-share', 'h-6 w-6') }}
            <span class="ml-2">share</span>
        </button>
    </x-slot:title>
    <div
        class="relative my-10 prose max-w-none lg:max-w-full xl:max-w-none prose-img:rounded-xl prose-img:w-full mx-auto  prose-a:no-underline  dark:prose-invert prose-a:text-skin-600 dark:prose-a:text-skin-500 min-h-fit h-auto">

        <div class="blog-share-wrap social-wrap">

            <a class="social-link link-icon-facebook" href="{{ $share['facebook'] }}"
                id="">{{ svg('bi-facebook') }}
            </a>
            <a class="social-link link-icon-twitter" href="{{ $share['twitter'] }}"
                id="">{{ svg('bi-twitter') }}
            </a>
            <a class="social-link link-icon-linkedin" href="{{ $share['linkedin'] }}"
                id="">{{ svg('bi-linkedin') }}
            </a>
            <a class="social-link link-icon-reddit" href="{{ $share['reddit'] }}" id="">{{ svg('bi-reddit') }}
            </a>
            <a class="social-link link-icon-whatsapp" href="{{ $share['whatsapp'] }}"
                id="">{{ svg('bi-whatsapp') }}
            </a>
            <a class="social-link link-icon-telegram" href="{{ $share['telegram'] }}"
                id="">{{ svg('bi-telegram') }}
            </a>
        </div>
        <div
            class="mt-3 w-full text-base text-left  border  border-gray-200 rounded-2xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">

            <div
                class="flex flex-row py-3 px-4 rounded-2xl  text-gray-700 dark:text-gray-400 dark:hover:text-white  dark:bg-gray-800 ">
                <div class="flex-1">
                    {{ url()->full() }}
                </div>
                <button type="button" x-clipboard.raw="{{ url()->full() }}"
                    class="text-gray-500 flex flex-row items-center mr-2 md:mr-3 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    {{-- {{ svg('fluentui-copy-20-o', 'h-4 w-4') }} --}}
                    <span class="ml-2">copy</span>
                </button>
            </div>
        </div>

    </div>
</x-modals.full>
