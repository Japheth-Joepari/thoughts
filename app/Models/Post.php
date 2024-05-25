<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Clap;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\CommentNotification;
use App\Notifications\NewPostNotification;


class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id', 'name', 'description', 'image', 'category_id', 'tags', 'uuid', 'featured', 'views_count'
    // ];

    protected $guarded = [];

    use SoftDeletes;

    public function user() {
        return $this->belongsTo(User::class);
    }

   public function claps() {
        return $this->hasMany(Clap::class);
    }

     public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function tags () {
        return $this->belongsToMany(Tag::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function notifyPostOwner(Comment $comment)
    {
        $postOwner = $this->user;

        if ($postOwner) {
            $postOwner->notify(new CommentNotification($comment));
        }
    }

    public function sendNewPostNotification()
    {
        $followers = $this->user->followers;

        foreach ($followers as $follower) {
            $follower->notify(new NewPostNotification($this));
        }
    }

        public function sendPostNotifications()
        {
            $users = User::all();

            foreach ($users as $user) {
                $user->notify(new NewPostNotification($this));
            }
        }

}
