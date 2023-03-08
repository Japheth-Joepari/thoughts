<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Comment;

use SendinBlue\Client\Api\SMTPApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;

class CommentNotification extends Notification
{
    use Queueable;

    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

      public function via($notifiable)
    {
        return ['mail', 'database', 'sendinblue'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->comment->user->name . ' has commented on your post:')
                    ->line($this->comment->body)
                    ->action('View Post', url('/posts/' . $this->comment->post_id));
    }

    public function toArray($notifiable)
    {
        return [
            'data' => [
                'comment_body' => $this->comment->body,
                'comment_created_at' => $this->comment->created_at->toDateTimeString(),
                'post_id' => $this->comment->post->id,
                'post_title' => $this->comment->post->title,
                'post_url' => route('posts.show', $this->comment->post),
            ]
        ];
    }

        public function toSendinblue($notifiable)
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));
        $apiInstance = new SMTPApi(null, $config);

        $sendSmtpEmail = new SendSmtpEmail([
            'to' => [['email' => $notifiable->email]],
            'subject' => $this->comment->user->name . ' has commented on your post',
            'htmlContent' => $this->comment->body,
            'sender' => ['email' => 'your-email@example.com', 'name' => 'Your Name'],
            'replyTo' => ['email' => 'your-email@example.com', 'name' => 'Your Name']
        ]);

        $sendSmtpEmail->setTemplateId(1); // Replace 1 with your Sendinblue template ID

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo 'Exception when calling SMTPApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}
