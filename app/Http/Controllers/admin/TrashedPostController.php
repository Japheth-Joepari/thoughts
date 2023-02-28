<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
class TrashedPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trashedPosts = Post::onlyTrashed()->get();
        return view('admin.trashed.index', compact('trashedPosts'));
    }


    public function update(Post $post)
    {
         $post->withTrashed()->restore();
        return to_route('posts.index')->with('success', 'Post has been successfully restored');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($trashed)
    {
        $post = Post::withTrashed()->where('uuid', $trashed)->first();
          $imagePath = public_path('/images/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        $post->tags()->detach();
        $post->forceDelete();
        return to_route('trashed.index')->with('success', 'Post have been permanently deleted');
    }
}




