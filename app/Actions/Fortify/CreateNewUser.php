<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use App\Notifications\NewUserNotification;
use App\Notifications\WelcomeEmailNotification;



class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
     public function create(array $input): User
    {
        // Validate input ...

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'uuid' => Str::uuid(),
            'password' => Hash::make($input['password']),
        ]);

        // Send notification to user with id=4
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->notify(new NewUserNotification($user));
        }


        // Send welcome email to user
        $user->notify(new WelcomeEmailNotification($user));
        return $user;
    }
}
