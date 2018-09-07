<?php

namespace App\Jobs;

use App\Mail\SendBookingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;

class SendRejectBookingMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function handle()
    {
        $bookingUser = $this->booking->user;

        Mail::to($bookingUser)->send(new SendBookingMail($this->booking, config('setting.booking.reject')));
    }
}
