<?php $tab = 'all'; ?>
<div id="sticky-sidebar" class="hidden py-4 overflow-y-auto rounded lg:block">
    <ul class="space-y-2">
        <li>
            <x-side-link :href="route('admin.')" :active="request()->routeIs('admin.')">
                {{ __('Home') }}
            </x-side-link>
        </li>
        @if (auth()->user()->can('access roles'))
            <li>
                <x-side-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">
                    {{ __('Roles') }}
                </x-side-link>
            </li>
        @endif
        @if (auth()->user()->can('access permissions'))
            <li>
                <x-side-link :href="route('admin.permissions.index')" :active="request()->routeIs('admin.permissions.index')">
                    {{ __('Permissions') }}
                </x-side-link>
            </li>
        @endif
        @if (auth()->user()->can('access users'))
            <li>
                <x-side-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                    {{ __('Users') }}
                </x-side-link>
            </li>
        @endif
        @if (auth()->user()->can('access tags'))
            <li>
                <x-side-link :href="route('admin.tags.index')" :active="request()->routeIs('admin.tags.index')">
                    {{ __('Tags') }}
                </x-side-link>
            </li>
        @endif
    </ul>
</div>
