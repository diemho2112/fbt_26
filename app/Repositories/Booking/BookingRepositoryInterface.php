<?php
namespace App\Repositories\Booking;

use App\Models\Booking;
use App\Models\User;
use App\Models\Tour;

interface BookingRepositoryInterface
{
    public function getBookingForUser(User $user);

    public function getPackageList(Tour $tour);

    public function destroy(Booking $booking);

    public function cancel($id);

    public function showCancelForUser(User $user);

    public function restorecCancel($id);

    public function storeBooking($id, $booking);

    public function accept($booking);
}
