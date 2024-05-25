<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view ('admin.posts.index')->with('posts', $posts);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if($categories->isEmpty()) {
            return to_route('categories.create')->with('error', 'Need to have at least one category before creating post');
        }

        $tags = Tag::all();
        return view("admin.posts.create")->with(['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
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

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Post $post)
    {
       $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function update(Request $request, Post $post)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
        'category_id' => 'required|exists:categories,id',
        'tags' => 'required|array',
        'tags.*' => 'required|exists:tags,id',
    ]);

    $post->name = $request->name;
    $post->uuid = Str::uuid();
    $post->description = $request->description;
    $post->category_id = $request->category_id;

    if ($request->hasFile('image')) {
        $oldImagePath = public_path('images/' . $post->image);
        if (is_file($oldImagePath)) {
            unlink($oldImagePath);
        }

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('images');
        $image->move($destinationPath, $name);
        $post->image = $name;
    }

    $post->save();
    $post->tags()->sync($request->tags);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully');
}



    public function toggleFeatured(Post $post)
    {
        $post->featured = !$post->featured;
        $post->save();
        if($post->featured == 1) {
            return redirect()->route('posts.index')->with('success', 'Post updated successfully, sucessfully marked as featured');
        } else {
            return redirect()->route('posts.index')->with('error', 'Post updated successfully, sucessfully removed as featured');
        }
        return redirect()->back();
    }

    public function togglePicked(Post $post) {
        $post->is_editor_pick = !$post->is_editor_pick;
        $post->save();
        if($post->is_editor_pick == 1) {
            return redirect()->route('posts.index')->with('success', 'Post updated successfully, sucessfully marked as picked');
        } else {
            return redirect()->route('posts.index')->with('error', 'Post updated successfully, sucessfully removed as picked');
        }
        return redirect()->back();
    }

    public function increasePopularity(Post $post)
    {
        $post->increment('views_count');
         return redirect()->route('posts.index')->with('success', 'View increased');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('error', 'Post has been successfully moved to trash...');
    }
}
