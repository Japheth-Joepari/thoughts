<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class SearchController extends Controller
{
      public function search(Request $request)
{
    $query = '%' . $request->input('query') . '%';


    $posts = Post::where('name', 'like', $query)
                 ->orWhere('description', 'like', $query)
                 ->get();

    $categories = Category::where('name', 'like', $query)->get();
    $tags = Tag::where('name', 'like', $query)->get();
    $users = User::where('name', 'like', $query)->get();

    return view('search.index', compact('posts', 'categories', 'tags', 'users'));
}
}
