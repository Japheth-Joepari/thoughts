<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Notifications\FollowNotification;

class FollowButton extends Component
{
    public $user;
    public $isFollowing;
    public $buttonClass = 'btn btn-light mt-2'; // default button class

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowing = auth()->user() ? auth()->user()->following->contains($user) : false;
    }

    public function toggle()
    {
        if (!auth()->user()) {
            return redirect()->route('login')->with('success', 'Please login to follow');
        }

        if ($this->isFollowing) {
            auth()->user()->following()->detach($this->user);
        } else {
            auth()->user()->following()->attach($this->user);

            $followOwner = $this->user;
            $user = auth()->user();

            // dd('folowner: ', $followOwner->name, 'user', $user->name);
            if ($user != $followOwner) {
                $notification = new FollowNotification($followOwner, $user);
                $followOwner->notify($notification);
            }
        }

        $this->isFollowing = !$this->isFollowing;
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
