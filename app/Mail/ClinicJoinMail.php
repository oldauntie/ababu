<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClinicJoinMail extends Mailable
{
    use Queueable, SerializesModels;

    private $clinic;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clinic)
    {
        $this->clinic = $clinic;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.clinic-join')->with('clinic', $this->clinic);
    }
}
