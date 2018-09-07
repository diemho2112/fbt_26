<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    protected $type;

    public function __construct(Booking $booking, $type)
    {
        $this->booking = $booking;
        $this->type = $type;
    }

    public function build()
    {
        $tour = $this->booking->tour;
        if (!$tour) {
            return $this->view('email.tour.notbe');
        }

        switch ($this->type) {
            case 'newBooking':
                return $this->view('emails.booking.request', compact('tour'));
            case config('setting.booking.accept'):
                return $this->view('emails.booking.accept', compact('tour'));
            case config('setting.booking.reject'):
                return $this->view('emails.booking.reject', compact('tour'));
            default:
                break;
        }
    }
}
