<?php

namespace App\Http\Livewire;
use App\Models\Post;
use App\Models\Clap;
use Illuminate\Http\Request;


use Livewire\Component;

class ClapButton extends Component
{
   public $post;
   public $cacheEnabled = false;
public $cacheTimeout = 0;


    public function toggleClap(Post $post, Request $request)
    {
               $clap = auth()->user()->claps()->where('post_id', $this->post->id)->first();

            if ($clap) {
                $clap->delete();
            } else {
                auth()->user()->claps()->create([
                    'post_id' => $this->post->id,
                ]);
            }

    }

   public function render()
{
    $post = Post::find($this->post->id);
    $clapCount = $post->claps()->count();
    return view('livewire.clap-button', compact('clapCount'));
}

}
