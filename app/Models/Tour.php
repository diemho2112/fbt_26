<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tour extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'itinerary',
        'start_date',
        'price',
        'description',
        'image',
    ];

    public function packages()
    {
        return $this->hasMany('App\Models\Package');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function likes()
    {
        return $this->hasManyThrough('App\Models\Like', 'App\Models\Review');
    }

    public function comments()
    {
        return $this->hasManyThrough('App\Models\Comment', 'App\Models\Review');
    }

    public function scopeSearch($query, $column, $operator = '=', $value = null, $boolean = 'and')
    {
        if (is_array($column)) {
            $query->where(function ($q) use ($column, $operator, $boolean) {
                foreach ($column as $col => $value) {
                    if (!is_null($value)) {
                        $q->where($col, $operator, $value, $boolean);
                    }
                }
            });
        } elseif (!is_null($value)) {
            $query->where($column, $operator, $value, $boolean);
        }
    }

    public function scopeOrSearch($query, $column, $operator = '=', $value = null)
    {
        $query->search($column, $operator, $value, 'or');
    }

    public function getIsUploadImageAttribute()
    {
        return file_exists(public_path().'/upload/' . $this->image);
    }

    public function getReviewedByAuthUserAttribute()
    {
        $review = Review::where('user_id', Auth::id())
            ->where('tour_id', $this->id)
            ->first();
        if ($review) {
            return true;
        }

        return false;
    }

    public function getPriceAttribute($value)
    {
        $this->attributes['price'] = number_format($value, 2);
    }
}
