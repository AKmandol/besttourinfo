<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CarOrderAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
     public $pick_up = '';
     public $drop_off = '';
     public $booking = '';
     public $trans = '';

     public function __construct($pick_up, $drop_off, $booking, $trans)
     {
         $this->pick_up = $pick_up;
         $this->drop_off = $drop_off;
         $this->booking = $booking;
         $this->trans = $trans;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Car Booking Order Recived')->view('mail.carOrderAdmin');
    }
}
