<?php
/**
 * Created by PhpStorm.
 * User: diemho
 * Date: 27/07/2018
 * Time: 04:58
 */

namespace App\Repositories\Review;

use App\Models\Like;
use App\Models\User;

interface ReviewRepositoryInterface
{
    public function findOldReview($tour_id);

    public function like($user, $review);

    public function reLike(Like $like);

    public function unlike(Like $like);

    public function findOldLike($review_id);

    public function reviewForUser(User $user);

    public function comment(User $user, array $comment);
}
