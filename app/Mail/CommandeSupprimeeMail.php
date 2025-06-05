<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandeSupprimeeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    public function __construct($commande)
    {
        $this->commande = $commande;
    }

    public function build()
    {
        return $this->subject('Votre commande a été supprimée')
                    ->view('emails.commande.commande_supprimee');
    }
}
