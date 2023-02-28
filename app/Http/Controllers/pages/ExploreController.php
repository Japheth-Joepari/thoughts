<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;
use App\Models\Post;

class ExploreController extends Controller
{
        public function explore() {
        // fetches editor picked
        $editorPicks = Post::where('is_editor_pick', true,)->limit(6)->get();;

        return view('pages.explore', compact('editorPicks'));
    }

}
