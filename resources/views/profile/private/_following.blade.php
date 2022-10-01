@if (count($followings) > 0)
    @foreach ($followings as $following)
       <x-cards.user-card :user="$following" />
    @endforeach

    {!! $followings->withQueryString()->onEachSide(3)->links('pagination::tailwind') !!}
@else
    <x-cards.primary-card class="mt-0">
        <div class="py-4 px-5">
            You don't follow anyone.
        </div>
    </x-cards.primary-card>
@endif
