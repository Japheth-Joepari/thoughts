<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class Replies extends Component
{
    public $comment;
    public $replyBody;

    public function addReply()
    {
        $reply= new Reply();
        $reply->user_id = Auth::id();
        $reply->comment_id = $this->comment->id;
        $reply->replyBody = $this->replyBody;
        $reply->post_id = $this->comment->post_id;
        $reply->save();
        $this->replyBody = '';
    }


    public function render()
    {
        return view('livewire.replies', [
            'allReplies' => $this->comment->replies()->get(),
        ]);
    }
}

