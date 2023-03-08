<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchResultController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $searchQuery = $request->input('query');

        $query = '%' . $request->input('query') . '%';
        $posts = Post::where('name', 'like', $query)->get();

        return view('pages.SearchResults', compact('posts', 'searchQuery'));
    }
}
