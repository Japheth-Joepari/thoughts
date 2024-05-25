<?php

namespace App\Http\Controllers\pages;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
     public function home() {
        // fetch only 4 post ->with pagination
        $posts = Post::paginate(8);

        // fetches latest 4 post
        $latestPosts = Post::latest()->take(4)->get();

        // fetches the most popular 4 post by ascending order
        // $mostPopularAsc = Post::orderBy('views_count', 'asc')->limit(4)->get();

        // fetches the most popular 4 post by descending order
        $mostPopularDesc = Post::orderBy('views_count', 'desc')->limit(4)->get();

        // fetches aother posts that have less than 5 views
        $otherPosts = Post::where('views_count', '<', 5)->orderBy('views_count', 'asc')->get();

        // fetches the first featured post
        $featuredpost = Post::where('featured', true)->first();

        // fetches the first editor picked post
        $firstPick = Post::where('is_editor_pick', true)->first();

        // fetches 4 editor picked post
       $editorPicks = Post::where('is_editor_pick', true)->limit(4)->get();
        // dd($editorPicks);

        // fetches all the tags
        $tags = Tag::all();

        // fetches the number of post associated with a category
        $categories = Category::withCount('post')->get();

                $userId = Auth::id();
        $unreadNotifications = DB::table('users')
            ->join('notifications', 'users.id', '=', 'notifications.user_id')
            ->whereNull('notifications.read_at')
            ->where('users.id', $userId)
            ->get();


        return view('pages.home', [
        'post' => $featuredpost,
        'tags' => $tags,
        'categories' => $categories,
        'mostPopularDesc' => $mostPopularDesc,
        'featuredpost' => $featuredpost,
        'latestPosts' => $latestPosts,
        'firstPick' => $firstPick,
        'editorPicks' => $editorPicks,
        'posts' => $posts,
        'unreadNotifications' => $unreadNotifications
    ]);
    }
}
