<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailSidebar extends Mailable
{
    use Queueable, SerializesModels;

    
    public $messageBody;
    public $subjectText;

    public function __construct($messageBody, $subjectText)
    {
        $this->messageBody = $messageBody;
        $this->subjectText = $subjectText;
    }

    public function build()
    {
        return $this->subject($this->subjectText)
                    ->view('mail.sidebarMail')
                    ->with(['messageBody' => $this->messageBody]);
    }
}
