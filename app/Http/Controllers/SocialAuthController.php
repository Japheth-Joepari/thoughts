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
    try {
        // For debugging purposes, use stateless mode to bypass state verification
        // Note: Remove stateless() in production to enable state verification
        $user = Socialite::driver('google')->user();

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
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error($e);

        // Redirect to the login page with an error message
        return redirect('/login')->with('error', $e);
    }
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

public function handleGitHubCallback()
{
    try {
        // For debugging purposes, use stateless mode to bypass state verification
        // Note: Remove stateless() in production to enable state verification
        $user = Socialite::driver('github')->user();

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
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error($e);

        // Redirect to the login page with an error message
        return redirect('/login')->with('error', 'Unable to login using GitHub. Please try again.');
    }
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
