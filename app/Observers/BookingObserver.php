<?php

namespace App\Observers;

use App\Jobs\SendBookingRequestMailJob;
use App\Mail\SendBookingMail;
use App\Models\Booking;
use App\Notifications\NewBookingRequest;
use Illuminate\Support\Facades\Mail;

class BookingObserver
{
    public function created(Booking $booking)
    {
        dispatch(new SendBookingRequestMailJob($booking));
        $booker = $booking->user;
        $booker->notify(new NewBookingRequest($booking));
    }
}
