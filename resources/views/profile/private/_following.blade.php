@if (count($followings) > 0)
    @foreach ($followings as $following)
        <div
            class="mt-3 max-w-full text-base w-full border  border-gray-200 rounded-xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">
            <div class="py-3 px-4 rounded-xl not-prose dark:bg-gray-800 ">
                <header class="flex flex-col md:flex-row">
                    <div class="flex-1 flex items-center ">
                        <img class="w-10 h-10 rounded-full" src="{{ asset($following->profile_image) }}"
                            onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $following->username }}.svg`"
                            alt="">
                        <div class="ml-2 font-medium ">
                            <div class="dark:text-white">
                                <a href="/users/{{ $following->username }}">{{ $following->username }} </a>
                            </div>
                            <div class="text-sm ">Joined in
                                {{ \Carbon\Carbon::parse($following->created_at)->format('F Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mb-3 md:hidden">
                            {!! $following->short_bio !!}
                        </div>
                        <livewire:subscribe :user_id="$following->id" />
                    </div>

                </header>
                <div class="mt-3 hidden md:block">
                    {!! $following->short_bio !!}
                </div>

            </div>
        </div>
    @endforeach

    {!! $followings->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
@else
    <x-cards.primary-card class="mt-0">
        <div class="py-4 px-5">
            You don't follow anyone.
        </div>
    </x-cards.primary-card>
@endif
