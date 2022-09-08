<div>
    <div class="max-w-3xl mx-auto mb-2">
        <div class="bg-white rounded-lg">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                        Using TinyMCE with Laravel Livewire
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto mb-2">
        <div class="bg-white rounded-lg p-5">

            <div class="flex flex-col space-y-10">
                <div wire:ignore>
                    <textarea wire:model="message" class="min-h-fit h-48 " name="message" id="message"></textarea>
                </div>

                <div>
                    <span class="text-lg">You typed:</span>
                    <div class="w-full min-h-fit h-48 border border-gray-200 p-4">{{ $message }}</div>
                </div>
            </div>


        </div>
    </div>

</div>



@push('scripts')
    <script>
        tinymce.init({
            selector: '#message',
            forced_root_block: false,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('message', editor.getContent());
                });
            }
        });
    </script>
@endpush
