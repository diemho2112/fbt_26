<?php

namespace App\Jobs;

use App\Mail\SendBookingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Booking;
use App\Models\User;

class SendBookingRequestMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function handle()
    {
        $admins = User::where('is_admin', config('setting.yes'))->get();

        Mail::to($admins)->send(new SendBookingMail($this->booking, config('setting.booking.new')));
    }
}
