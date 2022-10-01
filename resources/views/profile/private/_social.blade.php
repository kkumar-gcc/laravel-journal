<div>
    <x-cards.primary-card>
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Social Links</h3>
        </header>
        <div class="border-t py-4 px-5 last:rounded-b-xl border-gray-200 ">
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
                    <x-form.input-field type="url" id="twitter_username" name="twitter_username"
                        value="{{ old('twitter_username', $user->twitter_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="facebook_username">Facebook</label>
                    <x-form.input-field type="url" id="facebook_username" name="facebook_username"
                        value="{{ old('facebook_username', $user->facebook_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="instagram_username">Instagram</label>
                    <x-form.input-field type="url" id="instagram_username" name="instagram_username"
                        value="{{ old('instagram_username', $user->instagram_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="linkedin_username">LinkedIn</label>
                    <x-form.input-field type="url" id="linkedin_username" name="linkedin_username"
                        value="{{ old('linkedin_username', $user->linkedin_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="github_username">GitHub</label>
                    <x-form.input-field type="url" id="github_username" name="github_username"
                        value="{{ old('github_username', $user->github_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="stackoverflow_username">Stack Overflow</label>
                    <x-form.input-field type="url" id="stackoverflow_username" name="stackoverflow_username"
                        value="{{ old('stackoverflow_username', $user->stackoverflow_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="medium_username">Medium</label>
                    <x-form.input-field type="url" id="medium_username" <div class="input-error"
                        id="oldPasswordError">
                </div>

                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="quora_username">Quora</label>
                    <x-form.input-field type="url" id="quora_username" name="quora_username"
                        value="{{ old('quora_username', $user->quora_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="reddit_username">Reddit</label>
                    <x-form.input-field type="url" id="reddit_username" name="reddit_username"
                        value="{{ old('reddit_username', $user->reddit_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="youtube_channel">Youtube</label>
                    <x-form.input-field type="url" id="youtube_channel" name="youtube_channel"
                        value="{{ old('youtube_channel', $user->youtube_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="codepen_username">CodePen</label>
                    <x-form.input-field type="url" id="codepen_username" name="codepen_username"
                        value="{{ old('codepen_username', $user->codepen_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="laracasts_username">Laracasts</label>
                    <x-form.input-field type="url" id="laracasts_username" name="laracasts_username"
                        value="{{ old('laracasts_username', $user->laracasts_url) }}" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <x-buttons.secondary type="submit" :fullWidth="true">{{ __('Update Social Links') }}
                </x-buttons.secondary>
            </form>

    </x-cards.primary-card>
</div>
