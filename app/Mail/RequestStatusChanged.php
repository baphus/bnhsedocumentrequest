<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Add this
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestStatusChanged extends Mailable implements ShouldQueue // Add this
{
    use Queueable, SerializesModels;

    public function __construct(
        public Request $request
    ) {}

    public function envelope(): Envelope
    {
        $statusTitle = ucfirst($this->request->status);
        return new Envelope(
            subject: "Your Document Request is Now {$statusTitle} - " . $this->request->tracking_id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.request-status-changed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}