<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;



class DashboardController extends Controller
{

    public function index() {

        // fetches the number of count for each Model
        $tagsCount = Tag::count();
        $categoriesCount = Category::count();
        $postsCount = Post::count();
        $usersCount = User::count();

        return view('dashboard.dashboard', [
            'tagsCount' => $tagsCount,
            'categoriesCount' => $categoriesCount,
            'postsCount' => $postsCount,
            'usersCount' => $usersCount,
        ]);
    }
}
