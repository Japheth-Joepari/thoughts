<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;

      protected $dates = [
        'read_at',
    ];

    protected $fillable = [ 'type', 'notifiable_id', 'notifiable_type', 'data', 'read_at', 'created_at', 'updated_at', ];

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = json_encode($data);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
{
    return $this->hasMany(Notification::class);
}
}
