<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Clap;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Notification;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role,'
    // ];

    protected $guarded = [];

    public function post () {
        return $this->hasMany(Post::class);
    }

     public function claps() {
        return $this->hasMany(Clap::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function category() {
        return $this->hasMany(Category::class);
    }

    public function tag() {
        return $this->hasMany(Tag::class);
    }

    public function setRoleAttribute ($value) {

        $this->attributes['role'] = $value;
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_photo' => 'string',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
