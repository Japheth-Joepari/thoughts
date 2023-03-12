<?php

namespace App\Http\Livewire;
use App\Models\Post;
use App\Models\Clap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// noofication
use App\Events\CommentAdded;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ClapNotification;
use Livewire\Component;

class ClapButton extends Component
{
   public $post;
   public $cacheEnabled = false;
   public $cacheTimeout = 0;


    public function toggleClap()
    {
        if(!Auth::user()) {
            return to_route('login')->with('success', 'pls login first ');
        } else {
            $clap = auth()->user()->claps()->where('post_id', $this->post->id)->first();

        if ($clap) {
            $clap->delete();
        } else {
            $clap = auth()->user()->claps()->create([
                'post_id' => $this->post->id,
            ]);
            $postOwner = $this->post->user;
                if(Auth::user() != $postOwner) {
                    $notifyClap = new ClapNotification($clap, $postOwner);
                    Notification::send($postOwner, $notifyClap);
            }
        }
        }

    }

   public function render()
{
    $post = Post::find($this->post->id);
    $clapCount = $post->claps()->count();
    return view('livewire.clap-button', compact('clapCount'));
}

}
