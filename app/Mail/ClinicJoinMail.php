<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

use App\Models\Clinic;

class ClinicJoinMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $clinic;
    protected $token;

    /**
     * Create a new message instance.
     */
    public function __construct(Clinic $clinic, string $token)
    {
        $this->clinic = $clinic;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('translate.clinic_join'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        /*
        return new Content(
            view: 'emails.clinic-join',
            with: [
                'clinic' => $this->clinic,
                'token' => $this->token,
            ],
        );
*/
        return new Content(
            markdown: 'emails.clinic-join',
            with: [
                'clinic' => $this->clinic,
                'token' => $this->token,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
