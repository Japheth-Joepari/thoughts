<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
    public $post;
    public $userId;
    public $body;
    public $comments;

    public function addComment()
    {
        Comment::create([
            'body' => $this->body,
            'user_id' => Auth::id(),
            'post_id' => $this->post->id,
        ]);

        $this->body = ''; // Reset the comment body after submission
        $this->comments = Comment::where('post_id', $this->post->id)->get();
    }

    public $showReply = [];

     public function showReplyInput($commentId)
    {
        $this->showReply[$commentId] = true;
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id === Auth::id()) {
            $comment->delete();
            $this->refreshComments();
        }
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->comments = $post->comments;
        $this->refreshComments();
    }

     public function refreshComments()
    {
        $this->comments = Comment::where('post_id', $this->post->id)->get();
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => $this->comments,
        ]);
    }
}
