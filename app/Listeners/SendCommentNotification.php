<?php

namespace App\Listeners;

use App\Events\CommentAdded;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentNotification;


class SendCommentNotification
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentAdded $event)
    {
        // Get the users who should receive the notification
        $users = User::whereHas('subscriptions', function ($query) use ($event) {
            $query->where('post_id', $event->post->id);
        })->get();

        // Send the notification to each user
        Notification::send($users, new CommentNotification($event->comment, $event->post));
    }
}
