<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $mailSubject, public string $mailBody, public ?string $attachmentPath = null)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->mailSubject);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.generic', with: ['body' => $this->mailBody]);
    }

    public function attachments(): array
    {
        return $this->attachmentPath ? [\Illuminate\Mail\Mailables\Attachment::fromPath(storage_path('app/public/'.$this->attachmentPath))] : [];
    }
}
