<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInviteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($link, $name)
    {
        $this->link = $link;
        $this->name = $name;
        $this->subject('Fitmatch Invite');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.invite_email')
            ->with([
                'link' => $this->link,
                'name' => $this->name,
            ]);
    }
}
