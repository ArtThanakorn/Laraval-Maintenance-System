<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailTechnician extends Mailable
{
    use Queueable, SerializesModels;

    public $Urepai;
    public  $responsible;

    /**
     * Create a new message instance.
     */
    public function __construct($Urepai, $responsible)
    {
        $this->Urepai = $Urepai;
        $this->responsible =  $responsible;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Technician Status ID : '. $this->Urepai->id_repair,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.formemail_technician',
            with: [
                'repairDetails' => $this->Urepai->tag_repair,
                'Informer' => $this->Urepai->name,
                'Userresponsible'=> $this->responsible->name,
                'linkReset' => env('APP_URL', '') .'/user/followup/repair',
            ]);
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
