<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name = '';
    public $email = '';
    public $phone = '';
    public $msg = '';

    public function __construct($name,$email,$msg,$phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Email From Best Tour Info Website Contact')->view('mail.send_two');
    }
}
