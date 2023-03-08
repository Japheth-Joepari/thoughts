<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

// noofication
use App\Events\CommentAdded;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentNotification;

use Livewire\Component;

class Comments extends Component
{
    public $post;
    public $body;
    public $replyBody;

    protected $listeners = ['commentAdded' => '$refresh'];

public function addComment()
{
    $this->validate([
        'body' => 'required|string|min:5',
    ]);

    $comment = new Comment([
        'body' => $this->body,
        'user_id' => Auth::id(),
    ]);
    $this->post->comments()->save($comment);
    $this->body = '';

    // Create the notification instance
    $notification = new CommentNotification($comment);
    Notification::send($this->post->user, $notification);
    Notification::send($this->post->user, new CommentNotification($comment)); // Add this line

    $this->emit('commentAdded');
    }


    public function addReply(Comment $comment)
    {
        $this->validate([
            'replyBody' => 'required|string|min:5',
        ]);

        $reply = new Reply([
            'user_id' => Auth::id(),
            'replyBody' => $this->replyBody,
            'post_id' => $comment->post_id,

        ]);

        $comment->replies()->save($reply);
        $this->replyBody = '';
        $this->emit('commentAdded');

        // Fire the CommentAdded event
        // event(new CommentAdded($comment, $this->post));

    }

    public function deleteComment(Comment $comment)
    {
        if ($comment->user_id === Auth::id()) {
            $comment->delete();
        }
    }

    public function deleteReply(Reply $reply)
    {
        if ($reply->user_id === Auth::id()) {
            $reply->delete();
        }
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $comments = $this->post->comments()->with('replies')->latest()->simplePaginate(3);

        return view('livewire.comments', compact('comments'));
    }

    public function notify($notification)
    {
        $this->user->notify($notification);
    }
}
