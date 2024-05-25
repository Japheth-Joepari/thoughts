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
use App\Notifications\ReplyNotification;

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

    $comment = $this->post->comments()->create([
        'body' => $this->body,
        'user_id' => auth()->id(),
    ]);

        $postOwner = $this->post->user;
        if(Auth::user() != $postOwner) {
            $notification = new CommentNotification($comment, $postOwner);
            Notification::send($postOwner, $notification);
        }

    $this->body = '';
    $this->emit('commentAdded');
}


public function addReply(Comment $comment)
{
    $this->validate([
        'replyBody' => 'required|string|min:5',
    ]);

    // dd($comment->user->name);
    $reply = $comment->replies()->create([
        'user_id' => auth()->id(),
        'replyBody' => $this->replyBody,
        'post_id' => $comment->post_id,
    ]);

      $commentOwner = $comment->user;
        if(Auth::user() != $commentOwner) {
            $notification = new ReplyNotification($reply, $commentOwner);
            Notification::send($commentOwner, $notification);
        }

    $this->replyBody = '';
    $this->emit('commentAdded');
}

    public function deleteComment(Comment $comment)
    {
        if ($comment->user_id === Auth::id()) {
            $comment->delete();
        }
        $this->emit('commentAdded');
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
