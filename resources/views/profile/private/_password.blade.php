<div>
    <x-cards.primary-card>
        <header class="py-4 px-5 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Set New Password</h3>
        </header>
        <div class="border-t py-4 px-5 last:rounded-b-xl border-gray-200 ">

            <form method="POST" id="password_update">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="old_password"
                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Current Password</label>
                    <x-form.input-field type="password" id="old_password" aria-describedby="helper-text-explanation"
                        name="old_password" autocomplete="off" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class="mb-4">
                    <label for="new_password" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">New
                        Password</label>

                    <x-form.input-field type="password" id="new_password" aria-describedby="helper-text-explanation"
                        name="new_password" autocomplete="off" />
                    <div class="input-error" id="newPasswordError"></div>
                </div>
                <div class="mb-4">
                    <label for="confirm_new_password"
                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Confirm New
                        Password</label>
                    <x-form.input-field type="password" id="confirm_new_password"
                        aria-describedby="helper-text-explanation" name="confirm_new_password" autocomplete="off" />
                    <div class="input-error" id="cNewPasswordError"></div>
                </div>
                <x-buttons.secondary type="submit" fullWidth={true}>set password</x-buttons.secondary>

            </form>
        </div>
    </x-cards.primary-card>

    <x-cards.primary-card :default=false class="border-rose-500">
        <header class="px-5 py-4 text-2xl font-semibold text-gray-700 dark:text-white">
            <h3>Delete Account</h3>
        </header>
        <div
            class="px-5 py-4 border-t border-gray-200 last:rounded-b-xl dark:hover:text-white dark:border-gray-700 hover:shadow-md dark:bg-gray-800 dark:hover:bg-gray-700">

            <form method="POST" id="profile_update">
                <p>Once you delete your account, there is no going back. Please be certain.</p>

                <x-buttons.secondary type="submit" :default="false"
                    class="mt-3 bg-rose-500 border-rose-500 text-white">Delete
                    account</x-buttons.secondary>
            </form>
        </div>
    </x-cards.primary-card>
</div>
