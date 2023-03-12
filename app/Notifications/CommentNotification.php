<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

use App\Models\Comment;

class CommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;
    protected $postOwner;

    public function __construct(Comment $comment, $postOwner)
    {
        $this->comment = $comment;
        $this->postOwner = $postOwner;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->comment->user->name . ' has commented on your post:')
            ->line($this->comment->post->name)
            ->line($this->comment->body)
            ->action('View Post', url('/topics/' . $this->comment->post->uuid));
    }

        public function toArray($notifiable)
    {
        return [
            'type' => 'App\Notifications\CommentNotification',
            'comment_id' => $this->comment->id,
            'comment_body' => $this->comment->body,
            'comment_user_name' => $this->comment->user->name,
            'post_id' => $this->comment->post->id,
            'title' => $this->comment->post->name,
            'message' => $this->comment->user->name. ' Replied to your article ',
            'url' => '/topics/' . $this->comment->post->uuid,
        ];
    }


    public function toSendinblue($notifiable)
    {
        // Sendinblue code here
    }
}
