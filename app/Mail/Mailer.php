<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $mailMessage;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param string $mailMessage
     */
    public function __construct($mailMessage , $subject)
    {
        $this->mailMessage = $mailMessage;
        
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mailer',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.contact_us_template') // Blade view for email template
                    ->with('mailMessage', $this->mailMessage);
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
