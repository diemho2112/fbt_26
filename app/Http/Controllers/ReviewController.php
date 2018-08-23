<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReview;
use App\Models\Comment;
use App\Models\Review;
use App\Repositories\Review\ReviewRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Tour\TourRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class ReviewController extends Controller
{
    protected $tourRepository;
    protected $reviewRepository;

    public function __construct(TourRepositoryInterface $tourRepository, ReviewRepositoryInterface $reviewRepository)
    {
        $this->tourRepository = $tourRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function index(Request $request)
    {
        $reviews = $this->reviewRepository->reviewForUser($request->user());

        return view('reviews.myreview', compact('reviews'));
    }

    public function store(StoreReview $request)
    {
        if ($request->ajax()) {
            $tourId = $request->tourId;
            $tour = $this->tourRepository->find($tourId);
            $time = Carbon::now()->toDateTimeString();
            if (Gate::allows('assess', $tour)) {
                $oldReview = $this->reviewRepository->findOldReview($tourId);
                if (!$oldReview) {
                    $review = $request->only([
                        'title',
                        'content',
                    ]);
                    $review['created_at'] = $time;
                    $this->tourRepository->review($request->user(), $tourId, $review);

                    $response = [
                        'title' => $request->title,
                        'content' => $request->content,
                        'reviewer' => Auth::user()->name,
                        'message' => trans('message.review-success'),
                        'time' => $time
                    ];
                } else {
                    $response = [
                        'message' => trans('message.already-review'),
                    ];
                }
            } else {
                $response = [
                    'message' => trans('message.must-book-to-review'),
                ];
            }

            return Response::json($response);
        }
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $this->reviewRepository->update($id, $request->all());

        return Redirect::route('review.index');
    }

    public function destroy($id)
    {
        $this->reviewRepository->delete($id);

        return Redirect::back();
    }

    public function like(Request $request)
    {
        if ($request->ajax()) {
            $reviewId = $request->reviewId;
            $like = $this->reviewRepository->findOldLike($reviewId);
            if (!isset($like)) {
                $this->reviewRepository->like(Auth::id(), $reviewId);
                $message = trans('message.like');
                $likeCount = config('setting.increase');
            } else {
                if ($like->is_disliked) {
                    $this->reviewRepository->reLike($like);
                    $message = trans('message.relike');
                    $likeCount = config('setting.increase');
                } else {
                    $this->reviewRepository->unlike($like);
                    $message = trans('message.unlike');
                    $likeCount = config('setting.decrease');
                }
            }

            return Response::json([
                'message' => $message,
                'likeCount' => $likeCount
            ]);
        }
    }

    public function comment(Request $request)
    {
        if ($request->ajax()) {
            $comment = $request->only([
                'content',
                'commentable_type',
                'commentable_id'
            ]);
            $time = Carbon::now()->toDateTimeString();
            $this->reviewRepository->comment(Auth::user(), $comment);
            $response = [
                'content' => $request->content,
                'username' => Auth::user()->name,
                'message' => trans('message.comment-success'),
                'time' => $time,
            ];

            return Response::json($response);
        }
    }
}
