<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{

    public function index() {

        // fetches the number of count for each Model
        $tagsCount = Tag::count();
        $categoriesCount = Category::count();
        $postsCount = Post::count();
        $usersCount = User::count();

         $usersData = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->orderBy('id','ASC')
                    ->pluck('count', 'month_name');

        $labels = $usersData->keys();
        $data = $usersData->values();
        // dd($usersData, $data, $labels);


        return view('admin.dashboard.dashboard', [
            'tagsCount' => $tagsCount,
            'categoriesCount' => $categoriesCount,
            'postsCount' => $postsCount,
            'usersCount' => $usersCount,
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
