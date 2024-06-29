<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use File;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function author(User $user)
    {
        // foreach($user->following as $user) {
        // dd($user->following);

        // }

        $followings = $user->following()->latest()->simplePaginate(3);
        $followers = $user->followers()->latest()->simplePaginate(3);

        // dd($following);
        // fetches the most popular 4 post by ascending order
        $mostPopularDesc = Post::orderBy('views_count', 'desc')->limit(4)->get();

        // gets the id of the user
        $userId = $user->id;

        // Finds the user
        $user = User::findOrFail($userId);

        // Paginates the user
        $usersPost = $user->post()->latest()->simplePaginate(5);
        // dd($usersPost);


        // dd($userId);

        // fetches all the tags
        $tags = Tag::all();

        // paginate user

        // fetches the number of post associated with a category
        $categories = Category::withCount('post')->get();
        // dd($user->name);
        return view('pages.author', compact('followers', 'followings', 'user',  'mostPopularDesc',  'tags', 'usersPost'));
    }

    public function editProfile(User $user)
    {
        if ($user->id != Auth::id()) {
            return abort(403);
        }
        return view('pages.editProfile', compact('user'));
    }

    public function updateProfile(User $user, Request $request)
    {
        if ($user->id != Auth::id()) {
            return abort(403);
        }
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


        if ($request->hasFile('profile_photo')) {
            if ($user->image_public_id) {
                Cloudinary::destroy($user->image_public_id);
            }

            $uploadedFileUrl = $request->file('profile_photo')->storeOnCloudinary('thoughts/profile');
            $user->profile_photo = $uploadedFileUrl->getSecurePath();
            $user->image_public_id = $uploadedFileUrl->getPublicId();
        }

        // Save the changes to the user object
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
