<div class="not-prose">
    <x-cards.primary-card :default=false class="p-0">
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Social Links</h3>
        </header>
        <div
            class="border-t py-4 px-5 last:rounded-b-xl border-gray-200">
            <form method="POST" id="profile_update" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                {{-- <input type="hidden" name="MAX_FILE_SIZE" value="30000000" /> --}}

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="first_name">Profile Picture</label>
                        <div class="drop-zone" id="profile_image-child">
                            <p class="drop-zone__prompt">Drop file here or click to upload</p>
                            <input type="file" name="profile_image" class="drop-zone__input"
                                accept="image/*,.jpg,.png">
                        </div>
                        <div class="input-error" id="profileImageError"></div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="last_name">Background Image</label>
                        <div class="drop-zone" id="background_image-child">
                            <span class="drop-zone__prompt">Drop file here or click to upload</span>
                            <input type="file" name="background_image" class="drop-zone__input">
                        </div>
                        <div class="input-error" id="backgroundImageError"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="username">Username</label>
                    <input type="text" id="username"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4  dark:focus:border-rose-500"
                        name="username" value="{{ old('username', $user->username ?? '') }}" />
                    <div class="input-error" id="usernameError"></div>
                </div>
                <div class=" mb-4"> <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="name">Name</label>
                    {{-- <i class="fas fa-exclamation-circle trailing" data-mdb-toggle="popover"
                        data-mdb-content="And here's some amazing content. It's very engaging. Right?"></i> --}}
                    <input type="text" id="name"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="name" value="{{ old('title', $user->name ?? '') }}" />
                    <div class="input-error" id="nameError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="location">location</label>
                    <input type="text" id="location"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="location" value="{{ old('location', $user->location ?? '') }}" />
                    <div class="input-error" id="locationError"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="first_name">First Name</label>
                        <input type="text" id="first_name"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                            name="first_name" value="{{ old('first_name', $user->first_name ?? '') }}" />
                        <div class="input-error" id="firstNameError"></div>
                    </div>
                    <div class="">
                        <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                            for="last_name">Last Name</label>
                        <input type="text" id="last_name"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                            name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" />
                        <div class="input-error" id="LastNameError"></div>
                    </div>
                </div>
                <div class=" mb-5">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white" for="short_bio">Short
                        Bio</label>
                    <div class="form-outline">
                        <textarea id="short_bio"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                            name="short_bio" data-mdb-showcounter="true" maxlength="200" rows="4">{{ old('short_bio', $user->short_bio ?? '') }}</textarea>
                        <div class="form-helper"></div>
                    </div>
                    <div class="input-error" id="shortBioError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white" for="editor2">About
                        Me</label>
                    <textarea type="text"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500 text-editor"
                        name="about_me" id="editor2">{{ old('about_me', $user->about_me ?? '') }}</textarea>
                    <div class="input-error" id="aboutMeError"></div>
                </div>
                <div class=" mb-4">
                    <label class="block mb-2 text-base font-medium text-gray-900 dark:text-white"
                        for="website_url">Website Url</label>
                    <input type="url" id="website_url"
                        class="border border-gray-300 text-gray-900 text-sm1 rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="website_url" placeholder="https://website.com"
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
