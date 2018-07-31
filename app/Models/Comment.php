<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'commentable_type',
        'commentable_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
