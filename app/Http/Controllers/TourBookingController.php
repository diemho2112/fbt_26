<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBooking;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Tour\TourRepositoryInterface;
use Exception;

class TourBookingController extends Controller
{
    protected $bookingRepository;
    protected $tourRespository;

    public function __construct(BookingRepositoryInterface $bookingRepository, TourRepositoryInterface $tourRespository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->tourRespository = $tourRespository;
    }

    public function store(StoreBooking $request, $tourId)
    {
        $booking = $request->only([
            'booking_date',
            'number_of_passengers',
            'grand_total'
        ]);

        try {
            $tour = $this->tourRespository->find($tourId);
            if ($request->number_of_passengers <= $tour->empty_seats) {
                $this->bookingRepository->storeBooking($tourId, $booking);

                return redirect()->back()
                    ->with('status', trans('email.after-user-booking'));
            }

            return redirect()->back()
                ->with('status', trans('email.seats-is-over'));
        } catch (Exception $exception) {
            return response()->view('errors.404');
        }
    }
}
