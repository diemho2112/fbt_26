<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return bool
     */
    public function matchUser(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }

    public function bookingUpdate(User $user, Booking $booking)
    {
        $updateBookingDate = strtotime(now());
        $checkinDate = strtotime($booking->tour->start_date);
        $remaining = ($checkinDate - $updateBookingDate) / config('setting.dateTransfer');

        return $remaining >= config('setting.min_of_daysBeforeCheckin');
    }
}
