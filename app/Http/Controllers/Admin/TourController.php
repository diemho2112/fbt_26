<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Repositories\Tour\TourRepositoryInterface;
use App\Http\Requests\StoreTour;
use Illuminate\Support\Facades\Redirect;

class TourController extends Controller
{
    protected $tourRepository;

    public function __construct(TourRepositoryInterface $tourRepository)
    {
        $this->tourRepository = $tourRepository;
    }

    public function index()
    {
        $tours = $this->tourRepository->showLatestTour();

        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(StoreTour $request)
    {
        try {
            $image = $request->file('image');
            $tour = $request->only([
                'name',
                'duration',
                'itinerary',
                'start_date',
                'price',
                'description',
            ]);
            if ($image->isValid()) {
                $this->tourRepository->storeTour($image, $tour);

                return Redirect::route('tour.list');
            } else {
                return Redirect::back()->with('error', trans('message.store-unsuccessful'));
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function edit(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(StoreTour $request, $id)
    {
        try {
            $image = $request->file('image');
            $updateTour = $request->only([
                'name',
                'duration',
                'itinerary',
                'start_date',
                'price',
                'description',
            ]);
            if ($image->isValid()) {
                $this->tourRepository->updateTour($image, $updateTour, $id);

                return Redirect::route('tour.list');
            } else {
                return Redirect::back()->with('error', trans('message.update-unsuccessful'));
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function destroy($id)
    {
        $this->tourRepository->delete($id);

        return Redirect::back();
    }

    public function showRevenue()
    {
        $nowMonth = Carbon::now()->month;
        $nowYear = Carbon::now()->year;
        $tours = $this->tourRepository->revenue($nowMonth, $nowYear);

        return view('admin.revenue', compact('tours', 'nowMonth', 'nowYear'));
    }

    public function revenueByMonth(Request $request)
    {
        $tours = $this->tourRepository->revenue($request->month, $request->year);

        return view('admin.revenue', compact('tours'));
    }

    public function searchName(Request $request)
    {
        $tours = $this->tourRepository->searchName($request->name);

        return view('admin.tours.index', compact('tours'));
    }
}
