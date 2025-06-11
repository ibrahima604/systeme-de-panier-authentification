<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Commande;

class CommandeStatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

     public $commande;
    public $total;

    public function __construct(Commande $commande,mixed $total)
    {
        $this->commande = $commande;
        $this->total=$total;
    }

    public function build()
    {
        return $this->subject('Mise à jour de votre commande #' . $this->commande->id)
                    ->markdown('emails.commande.status_changed');
    }
}
