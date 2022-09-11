<div class="not-prose">
    <x-cards.primary-card :default=false class="p-0">
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Social Links</h3>
        </header>
        <div class="border-t py-4 px-5 last:rounded-b-xl border-gray-200">
            <form method="POST" id="profile_update" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                {{-- <input type="hidden" name="MAX_FILE_SIZE" value="30000000" /> --}}

                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="first_name">Profile Picture</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col w-full h-32 border-4 border-teal-400 border-dashed hover:bg-gray-100 hover:border-gray-300">
                            <div class="flex flex-col items-center justify-center pt-7">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                    Attach a file</p>
                            </div>
                            <input type="file" class="opacity-0" />
                        </label>
                    </div>
                    <div class="input-error" id="profileImageError"></div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="last_name">Background Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col w-full h-32 border-4 border-teal-400 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                <div class="flex flex-col items-center justify-center pt-7">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                        Attach a file</p>
                                </div>
                                <input type="file" class="opacity-0" />
                            </label>
                        </div>
                    <div class="input-error" id="backgroundImageError"></div>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="username">Username</label>
                    <x-form.input-field type="text" id="username" name="username"
                        value="{{ old('username', $user->username ?? '') }}" />
                    <div class="input-error" id="usernameError"></div>
                </div>
                <div class=" mb-4"> <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="name">Name</label>
                    {{-- <i class="fas fa-exclamation-circle trailing" data-mdb-toggle="popover"
                        data-mdb-content="And here's some amazing content. It's very engaging. Right?"></i> --}}
                    <x-form.input-field type="text" id="name" name="name"
                        value="{{ old('title', $user->name ?? '') }}" />
                    <div class="input-error" id="nameError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="location">location</label>
                    <x-form.input-field type="text" id="location" name="location"
                        value="{{ old('location', $user->location ?? '') }}" />
                    <div class="input-error" id="locationError"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="first_name">First Name</label>
                        <x-form.input-field type="text" id="first_name" name="first_name"
                            value="{{ old('first_name', $user->first_name ?? '') }}" />
                        <div class="input-error" id="firstNameError"></div>
                    </div>
                    <div class="">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="last_name">Last Name</label>
                        <x-form.input-field type="text" id="last_name" name="last_name"
                            value="{{ old('last_name', $user->last_name ?? '') }}" />
                        <div class="input-error" id="LastNameError"></div>
                    </div>
                </div>
                <div class=" mb-5">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white" for="short_bio">Short
                        Bio</label>
                    <div class="form-outline">
                        <textarea id="short_bio"
                            class="border border-gray-300 text-gray-600 text-sm focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                            name="short_bio" data-mdb-showcounter="true" maxlength="200" rows="4">{{ old('short_bio', $user->short_bio ?? '') }}</textarea>
                        <div class="form-helper"></div>
                    </div>
                    <div class="input-error" id="shortBioError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white" for="editor2">About
                        Me</label>
                    <textarea type="text"
                        class="border border-gray-300 text-gray-600 text-sm focus:ring-4 focus:shadow-md focus:ring-teal-500/20 focus:border-teal-600 block w-full p-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-teal-500"
                        name="about_me" id="editor2">{{ old('about_me', $user->about_me ?? '') }}</textarea>
                    <div class="input-error" id="aboutMeError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="website_url">Website Url</label>
                    <x-form.input-field type="url" id="website_url" name="website_url"
                        placeholder="https://website.com"
                        value="{{ old('website_url', $user->website_url ?? '') }}" />
                    <div class="input-error" id="websiteUrlError"></div>
                </div>
                <div id="response_message">
                </div>
                <x-buttons.secondary type="submit" fullWidth={true}>save profile info</x-buttons.secondary>
            </form>

        </div>

    </x-cards.primary-card>
</div>
