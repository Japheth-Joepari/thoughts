<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
        public function topics() {
        // fetches latest posts ...
        $latestPosts =  Post::latest()->paginate(10);

        // fetches the most popular 4 post by ascending order
        $mostPopularDesc = Post::orderBy('views_count', 'desc')->limit(4)->get();

        $tags = Tag::all();
        return view('pages.topics', compact('latestPosts', 'tags', 'mostPopularDesc'));
    }
}
