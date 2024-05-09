<?php

namespace App\Mail\NotifiAdministration\Commercial;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class reglementApport extends Mailable
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
            subject: 'Règlement Acompte client Online store'
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
            view: 'emails.notifAdministration.Commercial.newApport',
            with: [
                'CommercialName' => $this->emailData['CommercialName'],
                'name' => $this->emailData['name'],
                'prenom' => $this->emailData['prenom'],
                'nommodele' => $this->emailData['nommodele'],
                'nomversion' => $this->emailData['nomversion'],
                'financement' => $this->emailData['financement'],
                'Montant' => $this->emailData['Montant'],
                'DateCreation' => $this->emailData['DateCreation'],
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
