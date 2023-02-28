<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{

    // public function comments(Post $post) {
    //     $userComment = auth()->user()->comments()->where('post_id', $post)->first();
    //     dd($userComment->id);
    // }
}
