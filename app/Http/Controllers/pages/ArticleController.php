<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ArticleController extends Controller
{
    public function write()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.write', compact('posts', 'tags', 'categories'));
    }

    public function storeArticle(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:100',
            'description' => 'required|min:70',
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

        if ($request->hasFile('image')) {
            $uploadedFileUrl = $request->file('image')->storeOnCloudinary('thoughts/posts');
            $post->image = $uploadedFileUrl->getSecurePath();
            $post->image_public_id = $uploadedFileUrl->getPublicId();
        }


        // Send notifications to the user's followers

        $post->save();
        $post->tags()->attach($validatedData['tags']);

        return to_route('topics')->with('success', 'Article Published successfully.');
        $post->sendNewPostNotification();
    }

    public function editArticle(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return abort(403);
        }
        $tags = Tag::all();
        $categories = Category::all();
        return view('pages.write', compact('post', 'categories', 'tags'));
    }

    public function updateArticle(Post $post, Request $request)
    {
        if ($post->user_id != Auth::id()) {
            return abort(403);
        }
        $request->validate([
            'name' => 'required|min:5|max:100',
            'description' => 'required|min:70',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'required|exists:tags,id',
        ]);

        $post->name = $request->name;
        $post->uuid = Str::uuid();
        $post->description = $request->description;
        $post->category_id = $request->category_id;

        // if ($request->hasFile('image')) {
        //     // Delete old image file, if it exists
        //     $oldImagePath = public_path('/images/' . $post->image);
        //     if (file_exists($oldImagePath) && is_file($oldImagePath)) {
        //         unlink($oldImagePath);
        //     }

        //     // Upload new image file
        //     $image = $request->file('image');
        //     $name = time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $image->move($destinationPath, $name);
        //     $post->image = $name;
        // }
        if ($request->hasFile('image')) {
            // Delete the old image from Cloudinary
            if ($post->image_public_id) {
                Cloudinary::destroy($post->image_public_id);
            }

            // Upload the new image to Cloudinary
            $uploadedFileUrl = $request->file('image')->storeOnCloudinary('thoughts/posts');
            $post->image = $uploadedFileUrl->getSecurePath();
            $post->image_public_id = $uploadedFileUrl->getPublicId();
        }

        $post->save();
        $post->tags()->sync($request->tags);

        return redirect()->route('topics')->with('success', 'Post updated successfully');
    }

    public function deleteArticle(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return abort(403);
        }
        $post->delete();
        return redirect('topics')->with('error', 'post deleted successfully');
    }
}
