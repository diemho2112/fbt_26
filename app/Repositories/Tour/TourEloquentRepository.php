<?php
namespace App\Repositories\Tour;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Tour;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Redirect;
use App\Models\Review;

class TourEloquentRepository extends EloquentRepository implements TourRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Tour::class;
    }

    public function paginate($limit)
    {
        return parent::paginate($limit);
    }

    public function getPackageList(Tour $tour)
    {
        return $tour->packages->pluck('name', 'discount');
    }

    public function find($id)
    {
        return parent::find($id);
    }

    public function getActivities(Tour $tour)
    {
        return $tour->activities;
    }

    public function getPackages(Tour $tour)
    {
        return $tour->packages;
    }

    public function getRatingAverage(Tour $tour)
    {
        return $tour->ratings->avg('value');
    }

    public function getReviewTotal(Tour $tour)
    {
        return $tour->reviews->count('id');
    }

    public function getReviews(Tour $tour)
    {
        return $tour->reviews()->latest('created_at')->get();
    }

    public function rate(User $user, $id, $arrtribute)
    {
        return $user->ratings()->create([
            'value' => $arrtribute,
            'tour_id' => $id,
        ]);
    }

    public function review(User $user, $id, $review)
    {
        $review['tour_id'] = $id;
        return $user->reviews()->create($review);
    }

    public function showLatestTour()
    {
        return Tour::latest('start_date')
            ->paginate(config('setting.perpage'));
    }

    public function showBestTour()
    {
        return Tour::join('ratings', 'ratings.tour_id', '=', 'tours.id')
            ->select(DB::raw('avg(value) as average, tours.*'))
            ->groupBy('tours.id')
            ->orderBy('average', 'desc')
            ->paginate(config('setting.perpage'));
    }

    public function showPopularTour()
    {
        return Tour::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->paginate(config('setting.perpage'));
    }

    public function search($filters, $name_itinerary)
    {
        return Tour::search($filters, '>=')
            ->search('name', 'like', '%' . $name_itinerary . '%')
            ->orSearch('itinerary', 'like', '%' . $name_itinerary . '%')
            ->paginate(config('setting.perpage'));
    }

    public function storeTour($image, $tour)
    {
        $fileExtension = $image->getClientOriginalExtension();
        $fileName = time() . '.' . $fileExtension;
        $image->move(public_path(config('setting.image-folder')), $fileName);
        $tour['image'] = $fileName;

        return Tour::create($tour);
    }

    public function update($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function updateTour($image, $tour, $id)
    {
        $fileExtension = $image->getClientOriginalExtension();
        $fileName = time() . '.' . $fileExtension;
        $image->move(public_path(config('setting.image-folder')), $fileName);
        $tour['image'] = $fileName;

        return $this->update($id, $tour);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }

    public function revenue($month, $year)
    {
        return Tour::join('bookings', 'bookings.tour_id', '=', 'tours.id')
            ->select(DB::raw('sum(grand_total) as income, tours.name, tours.id'))
            ->groupBy('tours.id')
            ->whereMonth('start_date', $month)
            ->whereYear('start_date', $year)
            ->get();
    }

    public function searchName($name)
    {
        return Tour::search('name', 'like', '%' . $name . '%')->paginate(config('setting.perpage'));
    }
}
