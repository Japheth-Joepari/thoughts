<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class UnreadNotifications extends Component
{
    public $notifications;

    public function mount()
    {
        $this->getUnreadNotifications();
    }

    public function getUnreadNotifications()
    {
        $userId = Auth::id();

        $this->notifications = DB::table('users')
            ->join('notifications', 'users.id', '=', 'notifications.user_id')
            ->whereNull('notifications.read_at')
            ->where('users.id', $userId)
            ->get();
    }

       public function markAsRead($notificationId)
        {
            $notification = DB::table('notifications')->find($notificationId);
            DB::table('notifications')
                ->where('id', $notificationId)
                ->update(['read_at' => Carbon::now()]);

            $this->getUnreadNotifications();
            return redirect(json_decode($notification->data)->url);
        }

    public function markAllAsRead()
    {
        $userId = Auth::id();

        DB::table('notifications')
            ->whereNull('read_at')
            ->where('user_id', $userId)
            ->update(['read_at' => Carbon::now()]);

        $this->getUnreadNotifications();
    }


    public function render()
    {
        $this->getUnreadNotifications();

        return view('livewire.unread-notifications', [
            'unreadNotifications' => $this->notifications,
        ]);
    }

}
