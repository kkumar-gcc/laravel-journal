<form wire:submit.prevent="update()" class="mt-4">
    @csrf
    <div class=" mb-5">
        <div class="form-outline">
            <textarea id="editor2" wire:model="description"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-2.5 focus:placeholder:placeholder-teal-600 focus:text-teal-600"
                name="description" maxlength="200" rows="4"></textarea>
            <div class="form-helper"></div>
        </div>
    </div>
    <x-buttons.secondary class="inline-flex mr-4" type="submit">{{ __('Edit') }}
    </x-buttons.secondary>
    <x-buttons.primary @click="editComment = ! editComment">{{ __('Cancel') }}
    </x-buttons.primary>
    <div class="inline-flex ml-4" x-data="{ show: false }" x-show="show"
        x-transition.origin.bottom.duration.500ms x-init="@this.on('edited', () => {
            show = true;
            setTimeout(() => show = false, 10000)
        })" x-cloack style="display:none">
        <div class="bg-white  capatalize py-2 px-4 leading-6 inline-flex flex-row justify-center items-center no-underline rounded-md font-semibold cursor-pointer transition duration-200 ease-in-out shadow-sm shadow-gray-100">
            edited
        </div>
    </div>
</form>
