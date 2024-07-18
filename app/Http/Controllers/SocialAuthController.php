<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // User already exists, so log them in
            auth()->login($existingUser);
        } else {
            // User doesn't exist, so create a new user and log them in
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt(Str::random(16)),
                'uuid' => Str::uuid(),
            ]);

            auth()->login($newUser);
        }

        // Redirect the user to the home page
        return redirect()->route('home');
    }

    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }



    /**
     * Handle the callback from the github authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // User already exists, so log them in
            auth()->login($existingUser);
        } else {
            // User doesn't exist, so create a new user and log them in
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt(Str::random(16)),
                'uuid' => Str::uuid(),
            ]);

            auth()->login($newUser);
        }

        // Redirect the user to the home page
        return redirect()->route('home');
    }

    // public function redirectToFacebook()
    //     {
    //         return Socialite::driver('facebook')->redirect();
    //     }



    //     /**
    //      * Handle the callback from the facebook authentication page.
    //      *
    //      * @return \Illuminate\Http\Response
    //      */
    // public function handleFacebookCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();

    //     $existingUser = User::where('email', $user->email)->first();

    //     if ($existingUser) {
    //         // User already exists, so log them in
    //         auth()->login($existingUser);
    //     } else {
    //         // User doesn't exist, so create a new user and log them in
    //         $newUser = User::create([
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'password' => bcrypt(Str::random(16)),
    //             'uuid' => Str::uuid(),
    //         ]);

    //         auth()->login($newUser);
    //     }

    //     // Redirect the user to the home page
    //     return redirect()->route('home');
    // }

}
