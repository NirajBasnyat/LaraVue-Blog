<?php

namespace App;

use App\Like;
use App\User;
use App\Question;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;

class Reply extends Model
{
    // use Notifiable;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reply) {
            $reply->user_id = auth()->id();
        });

        static::updating(function ($reply) {
            $reply->user_id = auth()->id();
        });
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
