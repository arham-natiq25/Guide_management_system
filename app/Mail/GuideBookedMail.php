<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuideBookedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $guideBody;
    public $emailTemplet;
    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation, $guideBody , $emailTemplet)
    {
        $this->reservation = $reservation;
        $this->guideBody = $guideBody;
        $this->emailTemplet=$emailTemplet;
    }
    public function build()
    {
        return $this
            ->subject($this->emailTemplet->subject) // Set the email subject
            ->html($this->guideBody); // Set the email body as HTML
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(

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
