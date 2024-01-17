<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailContent;

    /**
     * Create a new message instance.
     */
    public function __construct($emailContent)
    {
        $this->emailContent = $emailContent;
        $this->subject('Fitmatch Registration');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.sendemail')
            ->with([
                'message' => $this->emailContent,
            ]);
    }
}
