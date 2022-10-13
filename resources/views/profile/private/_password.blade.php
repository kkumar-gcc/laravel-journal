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
                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700">Current Password</label>
                    <x-form.input-field type="password" id="old_password" aria-describedby="helper-text-explanation"
                        name="old_password" autocomplete="off" />
                    <div class="input-error" id="oldPasswordError"></div>
                </div>
                <div class="mb-4">
                    <label for="new_password" class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700">New
                        Password</label>

                    <x-form.input-field type="password" id="new_password" aria-describedby="helper-text-explanation"
                        name="new_password" autocomplete="off" />
                    <div class="input-error" id="newPasswordError"></div>
                </div>
                <div class="mb-4">
                    <label for="confirm_new_password"
                        class="text-base font-semibold line-clamp-3  tracking-wide  block mb-2  text-gray-700">Confirm New
                        Password</label>
                    <x-form.input-field type="password" id="confirm_new_password"
                        aria-describedby="helper-text-explanation" name="confirm_new_password" autocomplete="off" />
                    <div class="input-error" id="cNewPasswordError"></div>
                </div>
                <x-buttons.secondary type="submit" fullWidth={true}>set password</x-buttons.secondary>

            </form>
        </div>
    </x-cards.primary-card>
</div>
