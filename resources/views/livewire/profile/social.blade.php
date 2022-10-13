<div>
    <x-cards.primary-card>
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Social Links</h3>
        </header>
        <div class="border-t py-4 px-5 last:rounded-b-xl border-gray-200 ">

            <div>
                <div class="fixed top-3 right-3 p-3 mt-4 z-20 bg-skin-base shadow flex flex-shrink-0 rounded-md"
                    x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms
                    x-init="@this.on('changed', () => {
                        show = true;
                        setTimeout(() => show = false, 10000)
                    })" x-cloack style="display:none">
                    <div tabindex="0" aria-label="group icon" role="img"
                        class="focus:outline-none w-8 h-8 flex flex-shrink-0 items-center justify-center">
                        {{ svg('iconsax-bul-tick-circle', 'h-6 w-6 text-skin-500') }}

                    </div>
                    <div class="pl-3 w-full flex items-center justify-center">
                        @if (session()->has('message'))
                            {{ session('message') }}
                        @endif
                        <div aria-label="close icon" @click="show=false" role="button"
                            class="ml-3 focus:outline-none cursor-pointer">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg"
                                alt="icon">
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="social" id="social_info">
                @csrf
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="twitter_username">Twitter</label>
                    <x-form.input-field type="url" id="twitter_username" wire:model="twitterUrl" />
                    @error('twitterUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="facebook_username">Facebook</label>
                    <x-form.input-field type="url" id="facebook_username" wire:model="facebookUrl" />
                    @error('facebookUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="instagram_username">Instagram</label>
                    <x-form.input-field type="url" id="instagram_username" wire:model="instagramUrl" />
                    @error('instagramUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="linkedin_username">LinkedIn</label>
                    <x-form.input-field type="url" id="linkedin_username" wire:model="linkedinUrl" />
                    @error('linkedinUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="github_username">GitHub</label>
                    <x-form.input-field type="url" id="github_username" wire:model="githubUrl" />
                    @error('githubUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="stackoverflow_username">Stack Overflow</label>
                    <x-form.input-field type="url" id="stackoverflow_username" wire:model="stackoverflowUrl" />
                    @error('stackoverflowUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="medium_username">Medium</label>
                    <x-form.input-field type="url" id="medium_username" wire:model="mediumUrl" />
                    @error('mediumUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="quora_username">Quora</label>
                    <x-form.input-field type="url" id="quora_username" wire:model="quoraUrl" />
                    @error('quoraUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="reddit_username">Reddit</label>
                    <x-form.input-field type="url" id="reddit_username" wire:model="redditUrl" />
                    @error('reditUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="youtube_channel">Youtube</label>
                    <x-form.input-field type="url" id="youtube_channel" wire:model="youtubeUrl" />
                    @error('youtubeUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="codepen_username">CodePen</label>
                    <x-form.input-field type="url" id="codepen_username" wire:model="codepenUrl" />
                    @error('codepenUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="laracasts_username">Laracasts</label>
                    <x-form.input-field type="url" id="laracasts_username" wire:model="laracastsUrl" />
                    @error('laracastsUrl')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <x-buttons.secondary type="submit" :fullWidth="true">{{ __('Update Social Links') }}
                </x-buttons.secondary>
            </form>
    </x-cards.primary-card>
</div>
