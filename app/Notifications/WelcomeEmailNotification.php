<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class WelcomeEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to our site!')
            ->greeting('Hello ' . $this->user->name . ',')
            ->line('Welcome to Thoughts! We are excited to have you as a member of our community.')
            ->action('Visit our website', url('/'))
            ->line('Thank you for joining us!');
    }

        public function toArray($notifiable)
    {
        return [

            'title' => "hey ". $this->user->name,
            'message' =>   ' Thank you for becomming a part of our community ',
            'url' => '/author/' . $this->user->uuid,
        ];
    }
}
