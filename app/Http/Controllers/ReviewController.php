<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReview;
use App\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Tour\TourRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    protected $tourRepository;
    protected $reviewRepository;

    public function __construct(TourRepositoryInterface $tourRepository, ReviewRepositoryInterface $reviewRepository)
    {
        $this->tourRepository = $tourRepository;
        $this->reviewRepository = $reviewRepository;
        $this->middleware('auth')->only('like');
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        //
    }

    public function store(StoreReview $request)
    {
        try {
            if ($request->ajax()) {
                $tour_id = $request->tour_id;
                $tour = $this->tourRepository->find($tour_id);
                if (Gate::allows('assess', $tour)) {
                    $oldReview = $this->reviewRepository->findOldReview($tour_id);
                    if (!$oldReview) {
                        $review = $request->only([
                            'title',
                            'content',
                        ]);
                        $this->tourRepository->review($request->user(), $tour_id, $review);

                        $response = array(
                            'message' => trans('message.review-success'),
                            'title' => $request->title,
                            'content' => $request->content,
                            'reviewer' => Auth::user()->name,
                        );
                    } else {
                        $response = array(
                            'message' => trans('message.already-review'),
                        );
                    }
                } else {
                    $response = array(
                        'message' => trans('message.must-book-to-review'),
                    );
                }
                return response()->json($response);
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function like(Request $request)
    {
        try {
            if ($request->ajax()) {
                $review_id = $request->review_id;
                $like = $this->reviewRepository->findOldLike($review_id);
                if (!isset($like)) {
                    $this->reviewRepository->like(Auth::id(), $review_id);
                    $message = trans('message.like');
                    $like_count = 1;
                } else {
                    if ($like->is_disliked) {
                        $this->reviewRepository->reLike($like);
                        $message = trans('message.relike');
                        $like_count = 1;
                    } else {
                        $this->reviewRepository->unlike($like);
                        $message = trans('message.unlike');
                        $like_count = -1;
                    }
                }
            }

            return response()->json(array(
                'message'=> $message,
                'like_count' => $like_count
            ));
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }
}
