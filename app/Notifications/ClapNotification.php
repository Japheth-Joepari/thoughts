<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

use App\Models\Clap;

class ClapNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $clap;
    protected $postOwner;
    public function __construct(Clap $clap, $postOwner)
    {
        $this->clap = $clap;
        $this->postOwner = $postOwner;
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
            ->line($this->clap->user->name . ' just clapped on your post ')
            ->line($this->clap->post->name)
            ->action('View Post', url('/clap/' . $this->clap->post->uuid));
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
            'type' => 'App\Notifications\ClapNotification',
            'clap_Id' => $this->clap->id,
            'clap_user_name' => $this->clap->user->name,
            'post_id' => $this->clap->post->id,
            'title' => $this->clap->post->name,
            'message' => $this->clap->user->name. ' just clapped on your post ',
            'url' => '/topics/' . $this->clap->post->uuid,
        ];
    }
}
