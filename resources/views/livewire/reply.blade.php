<div wire:poll.visible.500s>
    @foreach ($replies as $reply)
        <x-cards.primary-card class="p-3 md:p-6 group" :default=false :wire:key="$reply->id" x-data="{ editReply: false }">
            <header class="flex flex-row not-prose">
                <div class="flex-1">
                    <div class="flex items-center space-x-4 user-popover">
                        <x-avatar search="{{ $reply->user->emailAddress() }}" :src="$reply->user->profile_image = ''"
                            class="h-12 w-12 bg-gray-50 rounded-full" provider="gravatar" />
                        <div class="font-medium">
                            <a class="user-popover dark:text-white" href="/users/{{ $reply->user->username }}"
                                id="user{{ $reply->id }}-{{ $reply->user_id }}">{{ $reply->user->username() }}
                                {{-- @if ($reply->user_id == $blog->user_id)
                            <span
                                class="modern-badge modern-badge-warning">auther</span>
                        @endif --}}
                            </a>
                            <div class="text-sm ">
                                <x-carbon :date="$reply->created_at" human />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden group-hover:flex items-center justify-end ">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-buttons.simple>@svg('go-kebab-horizontal-16', 'h-5 w-5')</x-buttons.simple>
                        </x-slot>
                        <x-slot name="content">
                            <ul>
                                <li>
                                    <x-dropdown-link href="/dashboard">
                                        {{ __(' Report') }}
                                    </x-dropdown-link>
                                </li>
                                @can('update', $reply)
                                    <li>
                                        <x-dropdown-link @click="editReply = ! editReply">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                    </li>
                                @endcan
                                @can('update', $reply)
                                    <li>
                                        <x-dropdown-link wire:click="delete({{ $reply->id }})" class="text-rose-500">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </li>
                                @endcan
                            </ul>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>
            <div class="my-3">
                <x-markdown flavor="github" :anchors="true" theme="github-dark">
                    {!! $reply->body() !!}
                </x-markdown>
            </div>
            <footer class="mt-2" x-data="{ open: false }">
                <div class="flex flew-row">
                    <livewire:like-reply :reply_id="$reply->id" :likes_count="$reply->replylikes->where('status', 1)->count()" :wire:key="$reply->id" />
                    <div class="flex-1 hidden group-hover:flex  items-center justify-end">
                        @guest
                            <button type="button"
                                class="flex justify-end items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                                data-modal-toggle="loginMessageModal">
                                Reply
                            </button>
                        @else
                            @if ($canReply)
                                <button type="button" @click="open = ! open"
                                    class="reply-toggle flex justify-end items-center hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                    <span x-text="open ? 'Hide ':' Reply'"></span>
                                </button>
                            @endif
                        @endguest
                    </div>
                </div>
                @auth
                    <div x-show="open" x-transition x-transition.top.duration.500ms x-cloak>
                        <form wire:submit.prevent="reply" class="mt-4">
                            @csrf

                            <div class="mb-5">
                                {{-- <textarea id="editor2" wire:model="message"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-600 block w-full p-2.5 focus:placeholder:placeholder-teal-600 focus:text-teal-600"
                                    name="description" maxlength="200" rows="4"></textarea> --}}
                                <x-milkdown>
                                    <div class="hidden">
                                        <x-markdown flavor="github" anchors theme="github-dark">
                                            {!! $body !!}
                                        </x-markdown>
                                    </div>
                                </x-milkdown>
                            </div>
                            <x-buttons.secondary type="submit">{{ __('Reply') }}
                            </x-buttons.secondary>
                            <x-buttons.primary class="ml-4" @click="open = ! open">{{ __('Cancel') }}
                            </x-buttons.primary>
                        </form>
                    </div>
                    @can('update', $reply)
                        <div x-show="editReply" x-transition x-transition.top.duration.500ms x-cloak>
                            <livewire:edit-reply :body="$reply->body()" :reply_id="$reply->id" wire:key="edit-{{ $reply->id }}" />
                        </div>
                    @endcan
                @endauth
            </footer>
        </x-cards.primary-card>
    @endforeach
</div>
