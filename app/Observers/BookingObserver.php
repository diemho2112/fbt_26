<?php

namespace App\Observers;

use App\Jobs\SendBookingRequestMailJob;
use App\Mail\SendBookingMail;
use App\Models\Booking;
use App\Notifications\NewBookingRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class BookingObserver
{
    public function created(Booking $booking)
    {
        $admins = User::where('is_admin', config('setting.yes'))->get();
        Mail::to($admins)->send(new SendBookingMail($booking, 'newBooking'));
        $booker = $booking->user;
        $booker->notify(new NewBookingRequest($booking));
    }
}
