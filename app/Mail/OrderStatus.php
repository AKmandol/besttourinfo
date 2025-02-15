<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $clientEmail = '';
    public $orderId = '';
    public $status = '';

    public function __construct($clientEmail,$orderId,$status)
    {
        $this->clientEmail = $clientEmail;
        $this->orderId = $orderId;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(' [Booking Confirmation] email from BestTourInfo.com ' )->view('mail.send');
    }
}
