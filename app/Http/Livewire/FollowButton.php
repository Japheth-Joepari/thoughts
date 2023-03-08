<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class FollowButton extends Component

{
    public $user;
    public $isFollowing;
    public $buttonClass = 'btn btn-light mt-2'; // default button class

    public function mount(User $user) {
        $this->user = $user;
        if(auth()->user()) {

        $this->isFollowing = auth()->user()->following->contains($user);
        }
    }

    public function toggle()
    {
        if (auth()->user()) {
            if ($this->isFollowing) {
            auth()->user()->following()->detach($this->user);
            } else {
                auth()->user()->following()->attach($this->user);
            }

        $this->isFollowing = !$this->isFollowing;
        }else {
            return to_route('login')->with('success', 'pls login to follow');
        }
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}


