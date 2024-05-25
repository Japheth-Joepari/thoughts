<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class SearchController extends Controller
{
      public function search(Request $request)
{
    $request->validate([
        'query' => 'required',
    ]);
     $searchQuery = $request->input('query');
    $query = '%' . $request->input('query') . '%';


    $posts = Post::where('name', 'like', $query)->get();

    $categories = Category::where('name', 'like', $query)->get();
    $tags = Tag::where('name', 'like', $query)->get();
    $users = User::where('name', 'like', $query)->get();


    return view('admin.search.index', compact('posts', 'searchQuery', 'categories', 'tags', 'users'));
}
}
