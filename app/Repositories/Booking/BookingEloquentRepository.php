<?php

namespace App\Repositories\Booking;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;

class BookingEloquentRepository extends EloquentRepository implements BookingRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Booking::class;
    }

    public function find($id)
    {
        return parent::find($id);
    }

    public function update($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function destroy(Booking $booking)
    {
        return $booking->forceDelete($booking->id);
    }

    public function cancel($id)
    {
        try {
            $booking = $this->find($id);
            $booking->is_canceled = config('setting.yes');
            $booking->save();

            return $booking->delete($id);
        } catch (\Exception $exception) {
            return response()->view('errors.404');
        }
    }

    public function getBookingForUser(User $user)
    {
        return $user->bookings()->latest()->get();
    }

    public function getPackageList(Tour $tour)
    {
        return $tour->packages->pluck('name', 'discount');
    }

    public function showCancelForUser(User $user)
    {
        return Booking::onlyTrashed()
            ->where('user_id', $user->id)
            ->get();
    }

    public function restorecCancel($id)
    {
        try {
            $booking = $this->find($id);
            $booking->is_canceled = config('setting.no');
            $booking->save();

            return Booking::withTrashed()->findOrFail($id)->restore();
        } catch (\Exception $exception) {
            return response()->view('errors.404');
        }
    }

    public function storeBooking($id, $booking)
    {
        $booking['tour_id'] = $id;

        return Auth::user()->bookings()->create($booking);
    }

    public function getAll()
    {
        return Booking::with(['user', 'tour'])->paginate(config('setting.perpage'));
    }

    public function accept($booking)
    {
        $booking['is_accepted'] = config('setting.yes');

        return $booking->save();
    }
}
