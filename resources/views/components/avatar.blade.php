@props(['user', 'unlinked' => false])
@unless($unlinked)
    <a href="/users/{{ $user->username }}">
@endunless
@if ($user->profile_image)
        <img src="{{ asset($user->profile_image) }}" alt="{{ $user->name }}"
            {{ $attributes->merge(['class' => 'bg-gray-50 rounded-full']) }} />
@else
        <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name}}"
            {{ $attributes->merge(['class' => 'bg-gray-50 rounded-full']) }} />
@endif

@unless($unlinked)
</a>
@endunless
