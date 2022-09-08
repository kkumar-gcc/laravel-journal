<div>
    <div
        class="relative mt-3 w-full  text-base text-left  border  border-gray-200 rounded-xl font-normal   hover:shadow-md dark:border-gray-700 dark:bg-gray-800 ">
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Set New Password</h3>
        </header>
        <div
            class="border-t py-4 px-5 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700  hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

            <form method="POST" id="password_update">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="old_password"
                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Current Password</label>
                    <input type="password" id="old_password" aria-describedby="helper-text-explanation"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="old_password" autocomplete="off">
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class="mb-4">
                    <label for="new_password" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">New
                        Password</label>
                    <input type="password" id="new_password" aria-describedby="helper-text-explanation"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="new_password" autocomplete="off">
                    <div class="input-error" id="newPasswordError"></div>
                </div>
                <div class="mb-4">
                    <label for="confirm_new_password"
                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                    <input type="password" id="confirm_new_password" aria-describedby="helper-text-explanation"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-rose-500/20 focus:border-rose-600 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-4 dark:focus:border-rose-500"
                        name="confirm_new_password" autocomplete="off">
                    <div class="input-error" id="cNewPasswordError"></div>
                </div>
                <div id="response_message"></div>
                <input type="submit" class="w-full inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800" value="set password" />

            </form>
        </div>
    </div>
    <div
        class="relative mt-5 w-full  text-base text-left  border  border-rose-600 rounded-xl font-normal   hover:shadow-md dark:border-rose-500 dark:bg-gray-800 ">
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Delete Account</h3>
        </header>
        <div
            class="border-t py-4 px-5 last:rounded-b-xl border-gray-200  dark:hover:text-white dark:border-gray-700  hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

            <form method="POST" id="profile_update">
                <p>Once you delete your account, there is no going back. Please be certain.</p>
                <button class="mt-3 inline-flex justify-center items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center no-underline cursor-pointer whitespace-nowrap text-white bg-gradient-to-br from-rose-600 to-pink-500 hover:bg-gradient-to-bl  focus:outline-none">Delete account</button>
            </form>
        </div>
    </div>
</div>
