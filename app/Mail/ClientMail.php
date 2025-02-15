<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class clientMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $clientName = '';
    public $clientEmail = '';
    public $clientPhone = '';
    public $subTotal = '';
    public $adult = '';
    public $child = '';
    public $booking_date = '';
    public $inDate = '';
    public $outDate = '';
    public $payment_type = '';
    public $transction_no = '';
    public $allHotel = '';
    public $tarns = '';

    public function __construct($tarns,$clientName, $clientEmail, $clientPhone, $subTotal, $adult, $child, $booking_date, $inDate, $outDate, $payment_type,$transction_no,$allHotel)
    {
        $this->clientName = $clientName;
        $this->clientEmail = $clientEmail;
        $this->clientPhone = $clientPhone;
        $this->subTotal = $subTotal;
        $this->adult = $adult;
        $this->child = $child;
        $this->booking_date = $booking_date;
        $this->inDate = $inDate;
        $this->outDate = $outDate;
        $this->payment_type = $payment_type;
        $this->transction_no = $transction_no;
        $this->allHotel = $allHotel;
        $this->tarns = $tarns;

        //dd($allHotel);
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(' [Booking Status] email from BestTourInfo.com ' )->view('mail.clientMail');
    }
}
