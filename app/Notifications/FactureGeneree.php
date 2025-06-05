<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class FactureGeneree extends Notification
{
    use Queueable;

    protected $commande;
    protected $pdf;

    public function __construct($commande, $pdf)
    {
        $this->commande = $commande;
        $this->pdf = $pdf;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $fileName = 'facture-' . $this->commande->id . '.pdf';

        return (new MailMessage)
            ->subject('Votre facture est disponible')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Vous avez généré une facture pour votre commande.')
            ->line('Vous trouverez votre facture en pièce jointe.')
            ->attachData($this->pdf->output(), $fileName, [
                'mime' => 'application/pdf',
            ])
            ->line('Merci pour votre commande !');
    }
}
