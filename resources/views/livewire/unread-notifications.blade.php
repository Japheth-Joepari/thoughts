<div class="dropdown  icon-button2" id="notification-button">
    <button class="" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false" style="border:transparent; background: transparent; color:#6e72fc;">
        <i class="fas fa-bell"></i>
        @auth
            @if ($unreadNotifications->count() > 0)
                <span id="notification-count"
                    class="badge rounded-pill badge-notification bg-danger position-absolute top-0 end-0">{{ $unreadNotifications->count() }}</span>
            @endif
        @endauth
    </button>


    <div class="dropdown-menu shadow-lg"
        style="max-height: 300px; overflow-y: auto; width: 200px; scrollbar-width: thin; margin-top: 0.6rem;  overflow-x: hidden;"
        aria-labelledby="notificationDropdown">
        @forelse($unreadNotifications->reverse() as $notification)
            <div class="dropdown-item text-wrap lh-1">
                <a wire:click.prevent="markAsRead({{ $notification->id }})"
                    href="{{ json_decode($notification->data)->url }}">
                    <p style="color: #79889e;">
                        {{ json_decode($notification->data)->message }}
                    </p>
                    @if (isset(json_decode($notification->data)->title))
                        <p style="color: #79889e; font-weight: 700;">
                            {{ Str::limit(json_decode($notification->data)->title, 23) }}
                        </p>
                    @endif
                </a>
            </div>
            <div class="dropdown-divider"></div>
        @empty
            <a class="dropdown-item" href="#">
                No new notifications
            </a>
        @endforelse
        <div class="dropdown-fixed">
            @if ($unreadNotifications->count() > 0)
                <a wire:click.prevent="markAllAsRead" class="dropdown-item bg-primary text-white"
                    style="font-weight: 700;">
                    ✓ Mark all as read
                </a>
            @endif
        </div>
    </div>
</div>
<script>
    const nbutton = document.getElementById('notification-button');
    const ncount = document.getElementById('notification-count');
    nbutton.addEventListener('click', function() {
        // console.log('Clicked');
        ncount.style.display = 'none'
    });
</script>
