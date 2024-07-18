<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reply;

class ReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $reply;
    protected $commentOwner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply, $commentOwner)
    {
        $this->reply = $reply;
        $this->commentOwner = $commentOwner;
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
            ->line($this->reply->user->name . ' has replied to your comment:')
            ->line('In this post: ' . $this->reply->post->name)
            ->line($this->reply->replyBody)
            ->action('View Post', url('/topics/' . $this->reply->comment->post->uuid));
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
            'reply_id' => $this->reply->id,
            'reply_body' => $this->reply->replyBody,
            'reply_user_name' => $this->reply->user->name,
            'post_name' => $this->reply->comment->post->name,
            'title' => $this->reply->comment->body,
            'message' =>  $this->reply->user->name. ' replied to your comment ',
            'url' => '/topics/' . $this->reply->comment->post->uuid,
        ];
    }

}
