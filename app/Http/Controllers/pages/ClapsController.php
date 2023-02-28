<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;
use App\Models\Post;

class ClapsController extends Controller
{
        public function toggleClap(Post $post) {
        $clap = auth()->user()->claps()->where('post_id', $post->id)->first();
        if ($clap) {
            $clap->delete();
        } else {
            auth()->user()->claps()->create([
                'post_id' => $post->id,
            ]);
        }

    return back();
    }

}
