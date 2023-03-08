<div>
    <button id="" class="{{ $buttonClass }}" wire:click="toggle">
        @if ($isFollowing)
            Unfollow
        @else
            Follow
        @endif
    </button>
</div>
