<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Tag;

class CategoryTagController extends Controller
{
        public function categoryPost(Category $category) {
        // paginateing post that belongs to a category
        $posts = $category->post()->with('category')->paginate(5);

        // dd($posts);
        return view('pages.categoryPost', compact('category', 'posts'));
    }

     public function tagPost (Tag $tag) {
        $posts = $tag->posts()->with('tags')->paginate(5);
        // dd($posts);
        return view('pages.tagPost', compact('tag', 'posts'));
    }
}
