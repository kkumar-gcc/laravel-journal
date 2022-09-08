@if (count($followers) > 0)
    @foreach ($followers as $follower)
        <div
            class="mt-3 max-w-full text-base w-full border  border-gray-200 rounded-xl font-normal  dark:border-gray-700 dark:bg-gray-800 ">
            <div class="py-3 px-4 rounded-xl not-prose dark:bg-gray-800 ">
                <header class="flex flex-col md:flex-row">
                    <div class="flex-1 flex items-center ">
                        <img class="w-10 h-10 rounded-full"
                            src="{{ asset($follower->profile_image)}}" onerror="this.onerror=null;this.src=`https://avatars.dicebear.com/api/bottts/:{{ $follower->username }}.svg`"
                            alt="">
                        <div class="ml-2 font-medium ">
                            <div class="dark:text-white">
                                <a href="/users/{{ $follower->username }}">{{ $follower->username }} </a>
                            </div>
                            <div class="text-sm ">Joined in
                                {{ \Carbon\Carbon::parse($follower->created_at)->format('F Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mb-3 md:hidden">
                            {!! $follower->short_bio !!}
                        </div>
                        <livewire:subscribe :user_id="$follower->id" />
                    </div>

                </header>
                <div class="mt-3 hidden md:block">
                    {!! $follower->short_bio !!}
                </div>

            </div>
        </div>
    @endforeach
    {!! $followers->withQueryString()->links('pagination::tailwind') !!}
@else
    <div
        class="py-4 px-5 rounded-xl text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
        You don't have any follower.
    </div>
@endif
