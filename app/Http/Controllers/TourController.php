<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Repositories\Tour\TourRepositoryInterface;

class TourController extends Controller
{
    protected $tourRepository;

    public function __construct(TourRepositoryInterface $tourRepository)
    {
        $this->tourRepository = $tourRepository;
    }

    public function index(Request $request)
    {
        $tours = $this->tourRepository->paginate(config('setting.perpage'));

        if ($request->ajax()) {
            return view('home', compact('tours'));
        }

        return view('home', compact('tours'));
    }

    public function show(Tour $tour)
    {
        $activities = $this->tourRepository->getActivities($tour);
        $packages = $this->tourRepository->getPackages($tour);
        $packagesList = $this->tourRepository->getPackageList($tour);
        $average_rating = $this->tourRepository->getRatingAverage($tour);
        $total_reviews = $this->tourRepository->getReviewTotal($tour);
        $reviews = $this->tourRepository->getReviews($tour);

        return view('tours.show', compact('tour', 'activities', 'packages', 'packagesList', 'average_rating', 'total_reviews', 'reviews'));
    }

    public function rate(Request $request)
    {
        if ($request->ajax()) {
            $tourId = $request->tourId;
            $tour = $this->tourRepository->find($tourId);
            if (Gate::allows('assess', $tour)) {
                $oldRate = Rating::where('user_id', Auth::id())
                    ->where('tour_id', $tourId)->first();
                if (!$oldRate) {
                    $this->tourRepository->rate($request->user(), $tourId, $request->rate);
                    $message = trans('message.rate-success');
                } else {
                    $message = trans('message.already-rate');
                }
            } else {
                $message = trans('message.must-book-to-rate');
            }

            return Response::json([
                'message' => $message
            ]);
        }
    }

    public function showLatestTours(Request $request)
    {
        $tours = $this->tourRepository->showLatestTour();

        return view('home', compact('tours'));
    }

    public function showBestTours(Request $request)
    {
        $tours = $this->tourRepository->showBestTour();

        return view('home', compact('tours'));
    }

    public function showPopularTours(Request$request)
    {
        $tours = $this->tourRepository->showPopularTour();

        return view('home', compact('tours'));
    }

    public function search(Request $request)
    {
        $filters = $request->only([
            'duration',
            'start_date',
            'price'
        ]);
        $tours = $this->tourRepository->search($filters, $request->name_itinerary);
        if (!$tours) {
            Session::flash('no_tours', trans('message.no-results'));
        }

        return view('home', compact('tours'));
    }
}
