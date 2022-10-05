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
                        <a href="/blogs/stats/{{ $blog->slug}}"
                            class="flex items-center p-2 text-base font-normal text-gray-900  dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap">Stats</span>
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
            <section id="general">
                <div class="relative mt-3 w-full  text-base text-left  rounded-xl font-normal">
                    <header class="py-3 px-4 text-2xl font-bold tracking-wide text-gray-700 dark:text-white">
                        <h3>General</h3>
                    </header>
                    <div class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl">

                        <form method="POST" id="blog_manage_form" data-blog-id="{{ $blog->id }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <input type="hidden" name="user_id" value="{{ $blog->user->id }}">
                            <div class="mb-4">
                                <label for="seo_title"
                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">
                                    Title</label>
                                <input type="text" id="seo_title" aria-describedby="helper-text-explanation"
                                    class="border border-gray-300 text-gray-600 text-sm focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                                    name="seo_title" autocomplete="off" @disabled(true)
                                    value="{{ $blog->title }}">
                            </div>
                            <div class="mb-6">
                                <label for="general_comment"
                                    class="block mb-5 text-base font-medium text-gray-900 dark:text-white">Who
                                    Can
                                    Comment ?</label>
                                <ul id="general_comment" class="grid w-full gap-6 md:grid-cols-3">
                                    <li class="relative">
                                        <input type="radio" id="comment-anyone" name="comment_access" value="enable"
                                            class="hidden peer" {{ $blog->comment_access == 'enable' ? 'checked' : '' }}
                                            required="">
                                        <label for="comment-anyone"
                                            class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200  cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-sm">Anyone</div>
                                            </div>
                                        </label>
                                        <div
                                            class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600">
                                            {{-- @svg('heroicon-o-check', 'w-4 h-4 ml-2') --}}
                                        </div>
                                    </li>
                                    <li class="relative">
                                        <input type="radio" id="comment-none" name="comment_access" value="disable"
                                            class="hidden peer"
                                            {{ $blog->comment_access == 'disable' ? 'checked' : '' }}>
                                        <label for="comment-none"
                                            class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200  cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-sm">Comment Off</div>
                                            </div>
                                        </label>
                                        <div
                                            class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600">
                                            {{-- @svg('heroicon-o-check', 'w-4 h-4 ml-2') --}}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="px-5 py-16 min-h-[20rem] flex items-center justify-center">
                                <!-- Copying this code is against the product license. Just buy the dang thing and save yourself the effort. -->

                                <div x-data="{ value: false }" class="flex items-center justify-center"
                                    x-id="['toggle-label']">
                                    <!-- Copying this code is against the product license. Just buy the dang thing and save yourself the effort. -->
                                    <input type="hidden" name="sendNotifications" :value="value"
                                        value="false">
                                    <!-- Copying this code is against the product license. Just buy the dang thing and save yourself the effort. -->
                                    <label @click="$refs.toggle.click(); $refs.toggle.focus()" :id="$id('toggle-label')"
                                        class="text-gray-900" id="toggle-label-1">
                                        Send notification
                                        <!-- Copying this code is against the product license. Just buy the dang thing and save yourself the effort. -->s
                                    </label>
                                    <!-- Copying this code is against the product license. Just buy the dang thing and save yourself the effort. -->
                                    <button x-ref="toggle" type="button" role="switch" @click="value=!value"
                                        class="relative ml-4 inline-flex w-14 rounded-full py-1 px-0"
                                        :class="value ? 'bg-gray-900 border-2 border-white' :
                                            'bg-white border-2 border-gray-900'">
                                        <!-- Copying this code is against the product license. Just buy the dang thing and save yourself the effort. -->
                                        <span :class="value ? 'bg-white translate-x-6' : 'bg-gray-900 translate-x-1'"
                                            class="h-6 w-6 rounded-full transition bg-gray-900 translate-x-1"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div x-data="{ value: false }" x-id="['toggle-label']" tabindex="0" class="group">
                                <input type="hidden" name="sendNotifications" :value="value" value="false">
                                <label @click="value=!value" @click="$refs.toggle.click(); $refs.toggle.focus()"
                                    :id="$id('toggle-label')" class="cursor-pointer select-none">
                                    Send notification
                                </label>
                                <div tabindex="0" class="relative cursor-pointer select-none" x-ref="toggle" role="switch" @click="value=!value">
                                    <div
                                        class="relative w-12 h-4 bg-gray-200 shadow-gray-400 rounded-full shadow-inner">
                                        <div class="
                                      dot
                                      absolute
                                      w-6
                                      h-6
                                      rounded-full
                                      drop-shadow-2xl
                                      shadow-md
                                      -top-[5px]
                                      transition
                                      flex
                                      items-center
                                      justify-center
                                      my-auto
                                      group-hover:ring-[20px]
                                      group-hover:ring-gray-500/[0.50]
                                      "
                                            :class="value ? 'right-0 bg-teal-600 shadow-teal-500' :
                                                'left-0 bg-black shadow-black '">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="general_comment"
                                    class="block mb-5 text-base font-medium text-gray-900 dark:text-white">Reader
                                    Access </label>
                                <ul id="general_comment" class="grid w-full gap-6 md:grid-cols-3">
                                    <li class="relative">
                                        <input type="radio" id="reader-anyone" name="blog_access" value="public"
                                            class="hidden peer" {{ $blog->access == 'public' ? 'checked' : '' }}
                                            required="">
                                        <label for="reader-anyone"
                                            class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200  cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-sm">Public</div>
                                            </div>
                                        </label>
                                        <div
                                            class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600">
                                            {{-- @svg('heroicon-o-check', 'w-4 h-4 ml-2') --}}
                                        </div>
                                    </li>
                                    <li class="relative">
                                        <input type="radio" id="reader-follower" name="blog_access"
                                            value="follower" class="hidden peer"
                                            {{ $blog->access == 'follower' ? 'checked' : '' }}>
                                        <label for="reader-follower"
                                            class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200  cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-sm">Only Follower</div>
                                            </div>
                                        </label>
                                        <div
                                            class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600">
                                            {{-- @svg('heroicon-o-check', 'w-4 h-4 ml-2') --}}
                                        </div>
                                    </li>
                                    <li class="relative">
                                        <input type="radio" id="reader-none" name="blog_access" value="private"
                                            class="hidden peer" {{ $blog->access == 'private' ? 'checked' : '' }}>
                                        <label for="reader-none"
                                            class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200  cursor-pointer peer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-sm">Private</div>
                                            </div>
                                        </label>
                                        <div
                                            class="absolute hidden w-5 h-5 peer-checked:block top-4 right-5 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600">
                                            {{-- @svg('heroicon-o-check', 'w-4 h-4 ml-2') --}}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-5 text-base font-medium text-gray-900 dark:text-white">Adult
                                    Content</label>
                                <ul class="grid w-full gap-6 md:grid-cols-2">
                                    <li>
                                        <input type="checkbox" id="adult_warning" @checked($blog->adult_warning)
                                            class="hidden peer" required="" name="adult_warning">
                                        <label for="adult_warning"
                                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200  cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:text-teal-600 peer-checked:border-teal-600 hover:text-gray-600 dark:peer-checked:text-teal-500 peer-checked:hover:bg-white hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-sm">Show warning to blog readers</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="age_confirmation" @checked($blog->age_confirmation)
                                            name="age_confirmation" class="hidden peer">
                                        <label for="age_confirmation"
                                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200  cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-teal-600 hover:text-gray-600 dark:peer-checked:text-teal-500 peer-checked:text-teal-600 hover:bg-gray-50 peer-checked:hover:bg-white dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">

                                                <div class="w-full text-sm">Require age confirmation</div>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <x-buttons.secondary type="submit">Save</x-buttons.secondary>
                        </form>
                    </div>
                </div>
            </section>
            <section id="seo-settings" class="mt-8">
                <x-cards.primary-card :default=false>
                    <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
                        <h3>Seo Settings</h3>
                    </header>
                    <div class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl ">

                        <form method="POST" id="blog_seo_form" data-blog-id="{{ $blog->id }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <input type="hidden" name="user_id" value="{{ $blog->user->id }}">
                            <div class="mb-4">
                                <label for="seo_title"
                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Seo
                                    Title</label>
                                <input type="text" id="seo_title" aria-describedby="helper-text-explanation"
                                    class="border border-gray-300 text-gray-600 text-sm focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                                    name="seo_title" autocomplete="off"
                                    value="{{ old('seo_title', $blog->meta_title ?? '') }}">
                            </div>
                            <div class="mb-4">
                                <label for="seo_description"
                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Seo
                                    Description</label>
                                <textarea id="seo_description"
                                    class="border border-gray-300 text-gray-600 text-sm focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                                    name="seo_description" data-mdb-showcounter="true" maxlength="200" rows="4">{{ old('seo_description', $blog->meta_description ?? '') }}</textarea>
                            </div>
                            <x-buttons.secondary type="submit">Save</x-buttons.secondary>

                        </form>
                    </div>
                </x-cards.primary-card>
            </section>
            <section id="delete" class="mt-8">
                <x-cards.primary-card :default=false class="border-rose-500">
                    <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
                        <h3>Delete Blog</h3>
                    </header>
                    <div
                        class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl dark:hover:text-white dark:border-gray-700 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

                        <form method="POST" id="profile_update">
                            <p>Once you delete your account, there is no going back. Please be certain.</p>

                            <x-buttons.secondary type="submit" :default="false"
                                class="mt-3 bg-rose-500 border-rose-500 text-white">Delete
                                Blog</x-buttons.secondary>
                        </form>
                    </div>
                </x-cards.primary-card>
            </section>

        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('ehczlyothi', () => ({
                value: false
            }))
            Alpine.bind('ehczlyothi', () => ({
                ['@click']() {
                    return this.value = !this.value
                },
                [':class']() {
                    return this.value ? 'bg-gray-900 border-2 border-white' :
                        'bg-white border-2 border-gray-900'
                },
            }))
        })
    </script>
</x-app-layout>
