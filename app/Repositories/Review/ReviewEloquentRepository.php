<?php
/**
 * Created by PhpStorm.
 * User: diemho
 * Date: 27/07/2018
 * Time: 04:58
 */

namespace App\Repositories\Review;

use App\Models\Like;
use App\Models\Review;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;

class ReviewEloquentRepository extends EloquentRepository implements ReviewRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Review::class;
    }

    public function find($id)
    {
        return parent::find($id);
    }

    public function findOldReview($tour_id)
    {
        return Review::where('user_id', Auth::id())
            ->where('tour_id', $tour_id)
            ->first();
    }

    public function findOldLike($review_id)
    {
        return Like::where('user_id', Auth::id())
            ->where('review_id', $review_id)
            ->first();
    }

    public function like($user, $review)
    {
        return Like::create([
            'user_id' => $user,
            'review_id' => $review,
            'is_disliked' => config('setting.no')
        ]);
    }

    public function reLike(Like $like)
    {
        $like->is_disliked = config('setting.no');
        return $like->save();
    }

    public function unlike(Like $like)
    {
        $like->is_disliked = config('setting.yes');
        return $like->save();
    }
}
