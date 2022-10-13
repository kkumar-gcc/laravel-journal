<div class="not-prose ">
    <x-cards.primary-card :default=false class="p-0">
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Profile</h3>
        </header>
        <div class="border-t py-4 px-5 last:rounded-b-xl border-gray-200">
            <div class="fixed top-3 right-3 p-3 mt-4 z-20 bg-skin-base shadow flex flex-shrink-0 rounded-md"
                x-data="{ show: false }" x-show="show" x-transition.origin.bottom.duration.500ms x-init="@this.on('changed', () => {
                    show = true;
                    setTimeout(() => show = false, 10000)
                })"
                x-cloack style="display:none">
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
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/notification_1-svg4.svg" alt="icon">
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="update" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label
                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-4  text-gray-700">Profile
                        image</label>
                    <div class="flex flex-row mb-8 items-center">
                        <div class="">
                            @if ($profileImage)
                                <img src="{{ $profileImage->temporaryUrl() }}"
                                    class="h-16 w-16 bg-gray-50 rounded-full" />
                            @else
                                <x-avatar search="{{ auth()->user()->emailAddress() }}" :src="auth()
                                    ->user()
                                    ->avatarUrl()"
                                    class="h-16 w-16 bg-gray-50 rounded-full" provider="gravatar"
                                    alt="Avatar of {{ auth()->user()->username }}" />
                            @endif
                        </div>
                        <div x-data="{ isUploading: false, progress: 0 }" class="flex-1 ml-8" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <!-- File Input -->
                            <input type="file" wire:model="profileImage" id="profile_image" class="sr-only" />
                            <label
                                class="bg-skin-base  capatalize py-2 px-4 leading-6  border inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-sm shadow-gray-100"
                                for="profile_image">
                                change
                            </label>

                            <x-error class="text-red-500" field="profileImage" />
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-4  text-gray-700">Background
                        image</label>
                    <div class="flex flex-row mb-8 items-center">
                        <div class="">
                            @if ($backgroundImage)
                                <img src="{{ $backgroundImage->temporaryUrl() }}"
                                    class="max-h-56 max-w-[224px] bg-gray-50 " provider="gravatar"
                                    alt="Avatar of {{ auth()->user()->username }}" />
                            @else
                                <img src="{{ auth()->user()->backgroundImage() }}"
                                    class="max-h-56 max-w-[224px] bg-gray-50 " provider="gravatar"
                                    alt="Avatar of {{ auth()->user()->username }}" />
                            @endif
                        </div>
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress" class="flex-1 ml-8">
                            <!-- File Input -->
                            <input type="file" wire:model="backgroundImage" id="background_image" class="sr-only" />
                            <label
                                class="bg-skin-base  capatalize py-2 px-4 leading-6  border inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-sm shadow-gray-100"
                                for="background_image">
                                change
                            </label>
                            <div x-show="isUploading" class="mb-2">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                            <x-error class="text-red-500" field="backgroundImage" />
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="username">Username</label>
                    <x-form.input-field type="text" id="username" wire:model="username" />
                    <x-error field="username" />
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="name">Name</label>
                    <x-form.input-field type="text" id="name" wire:model="name" />
                    <x-error field="name" />
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="location">location</label>
                    <x-form.input-field type="text" id="location" wire:model="location" />
                    <x-error field="location" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="">
                        <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                            for="first_name">First Name</label>
                        <x-form.input-field type="text" id="first_name" wire:model="firstName" />
                        <x-error field="firstName" />
                    </div>
                    <div class="">
                        <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                            for="last_name">Last Name</label>
                        <x-form.input-field type="text" id="last_name" wire:model="lastName" />
                        <x-error field="lastName" />
                    </div>
                </div>
                <div class=" mb-5">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="short_bio">Short
                        Bio</label>
                    <textarea id="short_bio"
                        class="border border-gray-300 text-gray-600 text-base font-semibold focus:shadow-md focus:ring-4 focus:ring-skin-500/20 focus:border-skin-600 block w-full p-3.5
                        maxlength="200"
                        rows="4" wire:model="shortBio">{{ old('short_bio', $user->short_bio ?? '') }}</textarea>
                    <x-error field="shortBio" />
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="editor2">About
                        Me</label>
                    <div class="my-5">
                        <x-milkdown :model="'aboutMe'">
                            <div class="hidden">
                                <x-markdown flavor="github" anchors>
                                    {!! $aboutMe !!}
                                </x-markdown>
                            </div>
                        </x-milkdown>
                    </div>
                    <x-error field="aboutMe" />
                </div>
                <div class=" mb-4">
                    <label class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700"
                        for="website_url">Website Url</label>
                    <x-form.input-field type="url" id="website_url" placeholder="https://website.com"
                        wire:model="websiteUrl" />
                    <x-error field="websiteUrl" />
                </div>
                <x-buttons.secondary type="submit" fullWidth={true}>save profile info</x-buttons.secondary>
            </form>
        </div>
    </x-cards.primary-card>
</div>
