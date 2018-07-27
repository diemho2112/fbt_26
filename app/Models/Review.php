<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'content',
        'title'
    ];

    public function tour()
    {
        return $this->belongsTo('App\Models\Tour');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commented');
    }

    public function getLikedByAuthUserAttribute()
    {
        $user_id = Auth::id();
        $like = Like::where('user_id', $user_id)
            ->where('review_id', $this->id)
            ->first();
        if ($like) {
            if ($like->is_disliked) {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

    public function getReviewedByAuthUserAttribute()
    {
        return $this->user->id === Auth::id();
    }
}
