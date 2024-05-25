<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;

class FollowNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $followOwner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $followOwner, User $user)
    {
        $this->followOwner = $followOwner;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Hey, ' . $this->followOwner->name)
            ->line($this->user->name . ' started following you')
            ->action('View Profile ', url('/author/' . $this->user->uuid));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'App\Notifications\FollowNotification',
            'follower_id' => $this->user->id,
            'message' => $this->user->name. ' started following you',
            'url' => '/author/' . $this->user->uuid,
        ];
    }
}
