<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSupprimeeCommandeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $total;

    /**
     * Create a new message instance.
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
        $this->total = $commande->lignes->sum(function ($ligne) {
            return $ligne->quantite_commande * $ligne->prix;
        });
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Votre commande a été supprimée')
                    ->markdown('emails.commande.AdminSupprimeCommande');
    }
}
