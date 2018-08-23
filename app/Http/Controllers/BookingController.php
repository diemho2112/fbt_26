<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Booking;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Tour\TourRepositoryInterface;

class BookingController extends Controller
{
    protected $bookingRepository;
    protected $tourRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository, TourRepositoryInterface $tourRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->tourRepository = $tourRepository;
    }

    public function index(Request $request)
    {
        $bookings = $this->bookingRepository->getBookingForUser($request->user());

        return view('bookings.index', compact('bookings'));
    }

    public function edit(Booking $booking)
    {
        try {
            $this->authorize('bookingUpdate', $booking);
            $this->authorize('matchUser', $booking);
            $tour = $this->tourRepository->find($booking->tour_id);
            $packagesList = $this->tourRepository->getPackageList($tour);

            return view('bookings.edit', compact('booking', 'tour', 'packagesList'));
        } catch (AuthorizationException $exception) {
            echo $exception->getMessage();
        }
    }

    public function update(Request $request, Booking $booking)
    {
        $this->bookingRepository->update($booking->id, $request->all());

        return redirect()->route('booking.index');
    }

    public function destroy(Booking $booking)
    {
        try {
            $this->authorize('bookingUpdate', $booking);
            $this->authorize('matchUser', $booking);
            $this->bookingRepository->destroy($booking->id);

            return redirect()->route('booking.index');
        } catch (AuthorizationException $exception) {
            echo $exception->getMessage();
        }
    }

    public function cancel(Request $request, $id)
    {
        $booking = $this->bookingRepository->find($id);
        try {
            $this->authorize('bookingUpdate', $booking);
            $this->authorize('matchUser', $booking);
            $this->bookingRepository->cancel($id);

            return redirect()->route('booking.index');
        } catch (AuthorizationException $exception) {
            echo $exception->getMessage();
        }
    }

    public function canceledList(Request $request)
    {
        $canceledList = $this->bookingRepository->showCancelForUser($request->user());

        return view('bookings.cancel', compact('canceledList'));
    }

    public function restore(Request $request, $id)
    {
        $this->bookingRepository->restorecCancel($id);

        return redirect()->route('booking.index');
    }
}
