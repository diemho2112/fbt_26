<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Repositories\Booking\BookingRepositoryInterface;
use Exception;
use App\Jobs\SendAcceptBookingMailJob;
use App\Jobs\SendRejectBookingMailJob;
use App\Notifications\BookingAccepted;
use App\Notifications\BookingRejected;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    protected $bookingRespository;

    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRespository = $bookingRepository;
    }

    public function index()
    {
        $bookings = $this->bookingRespository->getAll();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function destroy(Booking $booking)
    {
        $this->bookingRespository->destroy($booking);

        return Redirect::back();
    }

    public function acceptBooking($bookingId)
    {
        try {
            $booking = $this->bookingRespository->find($bookingId);

            if (!$booking['is_accepted']) {
                $this->bookingRespository->accept($booking);
                dispatch(new SendAcceptBookingMailJob($booking));
                $booking->user->notify(new BookingAccepted($booking));

                return redirect()->route('booking.list')
                    ->withSuccess(trans('message.after-accept-successful'));
            }

            return redirect()->route('booking.list')
                ->withSuccess(trans('message.after-accepted-already'));
        } catch (Exception $exception) {
            return response()->view('errors.404');
        }
    }

    public function rejectBooking($bookingId)
    {
        try {
            $booking = $this->bookingRespository->find($bookingId);

            if (!$booking['is_accepted']) {
                dispatch(new SendRejectBookingMailJob($booking));
                $booking->user->notify(new BookingRejected($booking));

                return redirect()->route('booking.list')
                    ->withSuccess(trans('message.after-reject-successful'));
            }

            return redirect()->route('booking.list')
                ->withSuccess(trans('message.after-rejected-already'));
        } catch (Exception $exception) {
            return response()->view('errors.404');
        }
    }
}
