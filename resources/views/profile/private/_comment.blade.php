<div>
    @if ($comments->count() > 0)
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg border">
                    <table class="min-w-full divide-y divide-gray-200 sm:rounded-lg">
                        <thead class="bg-gray-50 font-medium text-left">
                            <tr>
                                <th scope="col" class="px-6 py-4 uppercase tracking-wider hidden md:block">
                                    #</th>
                                <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                    Comment</th>
                                <th scope="col" class="relative px-6 py-4 hidden md:block">
                                    <span class="sr-only">Like</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-skin-base divide-y divide-gray-200 text-gray-600">
                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <td class="px-6 py-5 hidden md:block">
                                        {{ $key + 1 }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center ">
                                            <div class="font-medium ">
                                                <div class="font-semibold text-base text-gray-700">
                                                    <a href="/blogs/{{ $comment->blog->slug }}">{{ $comment->blog->title }}
                                                    </a>
                                                </div>
                                                <div class="text-sm ">
                                                    <span>{{ \Illuminate\Support\Str::limit($comment->body(), 50) }}<span>
                                                            {{ \Carbon\Carbon::parse($comment->created_at)->format('M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap hidden md:block">
                                        <livewire:like-comment :comment_id="$comment->id" :likes_count="$comment->commentlikes->where('status', 1)->count()"
                                            :wire:key="$comment->id" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        {!! $comments->withQueryString()->links('pagination::tailwind') !!}
    @else
        <div
            class="py-4 px-5 rounded-xl text-base border   text-gray-700 dark:text-gray-300  dark:border-gray-700 dark:bg-gray-800 ">
            You haven't written any comment.
        </div>
    @endif

</div>
