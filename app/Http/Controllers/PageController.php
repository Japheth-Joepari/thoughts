<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;

class PageController extends Controller
{
     public function home() {
        // fetch only 4 post ->with pagination
        $posts = Post::paginate(8);

        // fetches latest 4 post
        $latestPosts = Post::latest()->take(4)->get();

        // fetches the most popular 4 post by ascending order
        $mostPopularAsc = Post::orderBy('views_count', 'asc')->limit(4)->get();

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



        return view('pages.home', [
        'post' => $featuredpost,
        'tags' => $tags,
        'categories' => $categories,
        'mostPopularAsc' => $mostPopularAsc,
        'mostPopularDesc' => $mostPopularDesc,
        'featuredpost' => $featuredpost,
        'latestPosts' => $latestPosts,
        'firstPick' => $firstPick,
        'editorPicks' => $editorPicks,
        'posts' => $posts,
    ]);
    }

    public function explore() {
        // fetches editor picked
        $editorPicks = Post::where('is_editor_pick', true,)->limit(6)->get();;

        return view('pages.explore', compact('editorPicks'));
    }

    public function topics() {
        // fetches latest posts ...
        $latestPosts =  Post::latest()->paginate(10);

        // fetches the most popular 4 post by ascending order
        $mostPopularDesc = Post::orderBy('views_count', 'desc')->limit(4)->get();

        $tags = Tag::all();
        return view('pages.topics', compact('latestPosts', 'tags', 'mostPopularDesc'));
    }

    public function write() {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.write', compact('posts', 'tags', 'categories'));
    }

    public function storeArticle(Request $request) {
            $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required|image',
        'category_id' => 'required|exists:categories,id',
        'tags' => 'required|array',
        'tags.*' => 'required|exists:tags,id',
    ]);

    $post = Post::create([
        'user_id' => Auth::id(),
        'uuid' => Str::uuid(),
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        'category_id' => $validatedData['category_id'],
    ]);

    if($request->hasFile('image')) {
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);
        $post->image = $name;
    }

    $post->save();
    $post->tags()->attach($validatedData['tags']);

    return redirect()->route('pages.topics')->with('success', 'Post created successfully.');
    }

    public function viewArticle(Post $post) {
          // fetches the most popular 4 post by descending order
        $tags = Tag::all();
        $categories = Category::withCount('post')->get();
        $mostPopularDesc = Post::orderBy('views_count', 'desc')->limit(4)->get();
        return view('pages.viewArticle', compact('post', 'mostPopularDesc', 'tags', 'categories'));
    }

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

    public function authors() {
        $users = User::all();
        return view('pages.authors', compact('users'));
    }

    public function author(User $user) {

        // fetches the most popular 4 post by ascending order
        $mostPopularDesc = Post::orderBy('views_count', 'desc')->limit(4)->get();

        // gets the id of the user
        $userId = $user->id;

        // Finds the user
        $user = User::findOrFail($userId );

        // Paginates the user
        $usersPost = $user->post()->paginate(5);
        // dd($usersPost);


        // dd($userId);

        // fetches all the tags
        $tags = Tag::all();

        // paginate user

        // fetches the number of post associated with a category
        $categories = Category::withCount('post')->get();
        // dd($user->name);
        return view('pages.author', compact('user',  'mostPopularDesc',  'tags', 'usersPost'));
    }

    public function editProfile(User $user) {
        return view('pages.editProfile', compact('user'));
    }

    public function updateProfile(User $user, Request $request) {
        // dd($user->name);

        // Get the input values from the request
        $input = $request->only(['name', 'about', 'email', 'facebook', 'instagram', 'twitter', 'website']);

        // Loop through the input values and update them if they exist
        foreach ($input as $key => $value) {
            if (!empty($value)) {
                $user->{$key} = $value;
            }
        }

        // Update the password if it exists
        if (!empty($request->input('password'))) {
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');

            if ($password === $confirm_password) {
                $user->password = bcrypt($password);
            } else {
                return redirect()->back()->with('error', 'Password and confirm password do not match');
            }
        }

        // Update the profile photo if it exists
        if ($request->hasFile('profile_photo')) {
                $old_photo = public_path('images/' . $user->profile_photo);
                if (File::exists($old_photo)) {
                    File::delete($old_photo);
                }
                $image = $request->file('profile_photo');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $user->profile_photo = $new_name;
            } else {
                $user->profile_photo = $user->profile_photo;
            }

        // Save the changes to the user object
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function toggleClap(Post $post, Request $request) {
        $clap = auth()->user()->claps()->where('post_id', $post->id)->first();
        if ($clap) {
            $clap->delete();
        } else {
            auth()->user()->claps()->create([
                'post_id' => $post->id,
            ]);
        }

    return back();
    }
}
