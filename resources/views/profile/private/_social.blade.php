<div>
    <div
        class="relative  w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Social Links</h3>
        </header>
        <div
            class="border-t py-4 px-5 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700  hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

            @if (session()->has('success'))
                <div class="response-message response-success">
                    <p>{{ session()->get('success') }}</p>
                </div>
            @endif
            <form method="POST" action="/settings/social-links">
                @csrf
                @method('PUT')
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="twitter_username">Twitter</label>
                    <input type="url" id="twitter_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4  dark:focus:border-rose-500"
                        name="twitter_username" value="{{ old('twitter_username', $user->twitter_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="facebook_username">Facebook</label>
                    <input type="url" id="facebook_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="facebook_username" value="{{ old('facebook_username', $user->facebook_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="instagram_username">Instagram</label>
                    <input type="url" id="instagram_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="instagram_username" value="{{ old('instagram_username', $user->instagram_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="linkedin_username">LinkedIn</label>
                    <input type="url" id="linkedin_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="linkedin_username" value="{{ old('linkedin_username', $user->linkedin_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="github_username">GitHub</label>
                    <input type="url" id="github_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="github_username" value="{{ old('github_username', $user->github_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="stackoverflow_username">Stack Overflow</label>
                    <input type="url" id="stackoverflow_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="stackoverflow_username"
                        value="{{ old('stackoverflow_username', $user->stackoverflow_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="medium_username">Medium</label>
                    <input type="url" id="medium_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-200 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-1 dark:focus:ring-rose-500 dark:focus:border-rose-500"
                        name="medium_username" value="{{ old('medium_username', $user->medium_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="quora_username">Quora</label>
                    <input type="url" id="quora_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-200 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-1 dark:focus:ring-rose-500 dark:focus:border-rose-500"
                        name="quora_username" value="{{ old('quora_username', $user->quora_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="reddit_username">Reddit</label>
                    <input type="url" id="reddit_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-200 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-1 dark:focus:ring-rose-500 dark:focus:border-rose-500"
                        name="reddit_username" value="{{ old('reddit_username', $user->reddit_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="youtube_channel">Youtube</label>
                    <input type="url" id="youtube_channel"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-200 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-1 dark:focus:ring-rose-500 dark:focus:border-rose-500"
                        name="youtube_channel" value="{{ old('youtube_channel', $user->youtube_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="codepen_username">CodePen</label>
                    <input type="url" id="codepen_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-200 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-1 dark:focus:ring-rose-500 dark:focus:border-rose-500"
                        name="codepen_username" value="{{ old('codepen_username', $user->codepen_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="laracasts_username">Laracasts</label>
                    <input type="url" id="laracasts_username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-200 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-1 dark:focus:ring-rose-500 dark:focus:border-rose-500"
                        name="laracasts_username" value="{{ old('laracasts_username', $user->laracasts_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <input type="submit" class="sticky bottom-1 w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800" value="Update Social Links" />

            </form>
        </div>
    </div>
