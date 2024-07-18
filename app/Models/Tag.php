<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts () {
        return $this->belongsToMany(Post::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
