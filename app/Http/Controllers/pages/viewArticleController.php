<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;

class viewArticleController extends Controller
{
        public function viewArticle(Post $post) {
          // fetches the most popular 4 post by descending order
        $tags = Tag::all();
        $comments = Comment::all();
        $categories = Category::withCount('post')->get();
        $mostPopularDesc = Post::orderBy('views_count', 'desc')->limit(4)->get();
        return view('pages.viewArticle', compact('post', 'mostPopularDesc', 'tags', 'categories', 'comments'));
    }
}
