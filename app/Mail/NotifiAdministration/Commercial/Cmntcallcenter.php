<?php

namespace App\Mail\NotifiAdministration\Commercial;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Cmntcallcenter extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    

    public function __construct(array $emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Nouveau Client Online Store Renault.'
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.notifAdministration.Commercial.newClient',
            with: [
                'CommercialName' => $this->emailData['CommercialName'],
                'name' => $this->emailData['name'],
                'prenom' => $this->emailData['prenom'],
                'nommodele' => $this->emailData['nommodele'],
                'nomversion' => $this->emailData['nomversion'],
                'financement' => $this->emailData['financement'],
                'CC_status' => $this->emailData['CC_status'],
                'Date_status' => $this->emailData['Date_status'],
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
